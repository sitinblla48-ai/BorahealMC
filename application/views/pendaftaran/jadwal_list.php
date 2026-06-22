<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Jadwal Pendaftaran Pasien</h2>
        <p class="text-muted">Kelola jadwal kunjungan konsultasi dokter dan persetujuan pendaftaran.</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h5 class="fw-bold m-0"><i class="fa-solid fa-calendar-days text-primary-custom me-2"></i>Jadwal Antrean Kunjungan</h5>
                    <span class="badge bg-primary-light text-primary-custom px-3 py-2 fw-semibold">Diurutkan Berdasarkan Tanggal</span>
                </div>
                
                <div class="table-responsive p-0 border-0">
                    <table class="table table-hover align-middle datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th>ID Daftar</th>
                                <th>Nama Pasien</th>
                                <th>Dokter / Spesialis</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Jam Kunjungan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($schedules)): ?>
                                <?php foreach ($schedules as $sched): ?>
                                    <?php 
                                    $reg_id_formatted = sprintf('REG-%s-%04d', str_replace('-', '', $sched['tanggal_kunjungan']), $sched['id_pendaftaran']);
                                    
                                    // Badge class based on status
                                    $badge_class = 'badge-pending';
                                    $status_label = 'Menunggu';
                                    if ($sched['status_pendaftaran'] == 'Disetujui') {
                                        $badge_class = 'badge-approved';
                                        $status_label = 'Disetujui';
                                    } elseif ($sched['status_pendaftaran'] == 'Ditolak') {
                                        $badge_class = 'badge-rejected';
                                        $status_label = 'Ditolak';
                                    }
                                    ?>
                                    <tr>
                                        <td class="fw-bold text-primary-custom"><?php echo $reg_id_formatted; ?></td>
                                        <td class="fw-semibold"><?php echo html_escape($sched['nama_pasien']); ?></td>
                                        <td><?php echo html_escape($sched['nama_dokter']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($sched['tanggal_kunjungan'])); ?></td>
                                        <td><?php echo date('H:i', strtotime($sched['jam_kunjungan'])); ?></td>
                                        <td>
                                            <span class="badge px-3 py-2 rounded-pill <?php echo $badge_class; ?>">
                                                <?php echo $status_label; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($sched['status_pendaftaran'] == 'Pending'): ?>
                                                <div class="d-inline-flex gap-2">
                                                    <a href="<?php echo base_url('admin/setujui_pendaftaran/' . $sched['id_pendaftaran']); ?>" class="btn btn-sm btn-success btn-approve-confirm" title="Setujui Pendaftaran">
                                                        <i class="fa-solid fa-check me-1"></i> Setujui
                                                    </a>
                                                    <a href="<?php echo base_url('admin/tolak_pendaftaran/' . $sched['id_pendaftaran']); ?>" class="btn btn-sm btn-danger btn-reject-confirm" title="Tolak Pendaftaran">
                                                        <i class="fa-solid fa-xmark me-1"></i> Tolak
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted small"><i class="fa-solid fa-lock me-1"></i> Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
