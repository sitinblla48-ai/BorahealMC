<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Portal Pasien</h2>
        <p class="text-muted">Kelola data profil Anda dan pantau status janji temu dokter secara langsung.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Profil Pasien -->
    <div class="col-lg-4">
        <div class="card card-stat h-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary-custom">
                        <i class="fa-solid fa-address-card fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Profil Pribadi</h5>
                        <small class="text-muted">Biodata terdaftar Anda</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small d-block">Nama Lengkap</label>
                    <span class="fw-semibold text-dark"><?php echo html_escape($pasien->nama_lengkap); ?></span>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small d-block">Tanggal Lahir</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-cake-candles me-1 text-muted"></i> <?php echo date('d M Y', strtotime($pasien->tanggal_lahir)); ?></span>
                </div>

                <div class="mb-3">
                    <label class="text-muted small d-block">Nomor Telepon</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-phone me-1 text-muted"></i> <?php echo html_escape($pasien->no_telepon); ?></span>
                </div>

                <div class="mb-3">
                    <label class="text-muted small d-block">Alamat Lengkap</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-map-location-dot me-1 text-muted"></i> <?php echo nl2br(html_escape($pasien->alamat)); ?></span>
                </div>

                <div class="mb-0">
                    <label class="text-muted small d-block">Username</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-user-tag me-1 text-muted"></i> @<?php echo html_escape($pasien->username); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pendaftaran -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0"><i class="fa-solid fa-clock-rotate-left me-2 text-secondary"></i>Riwayat Pendaftaran</h5>
                    <a href="<?php echo base_url('pasien/daftar'); ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i> Daftar Baru</a>
                </div>
                
                <div class="table-responsive p-0 border-0">
                    <table class="table table-hover align-middle datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th>ID Daftar</th>
                                <th>Dokter / Spesialis</th>
                                <th>Tgl Kunjungan</th>
                                <th>Jam Kunjungan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($registrations)): ?>
                                <?php foreach ($registrations as $reg): ?>
                                    <?php 
                                    $reg_id_formatted = sprintf('REG-%s-%04d', str_replace('-', '', $reg['tanggal_kunjungan']), $reg['id_pendaftaran']);
                                    
                                    // Badge class based on status
                                    $badge_class = 'badge-pending';
                                    $status_label = 'Menunggu';
                                    if ($reg['status_pendaftaran'] == 'Disetujui') {
                                        $badge_class = 'badge-approved';
                                        $status_label = 'Disetujui';
                                    } elseif ($reg['status_pendaftaran'] == 'Ditolak') {
                                        $badge_class = 'badge-rejected';
                                        $status_label = 'Ditolak';
                                    }
                                    ?>
                                    <tr>
                                        <td class="fw-bold text-primary-custom"><?php echo $reg_id_formatted; ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?php echo html_escape($reg['nama_dokter']); ?></div>
                                            <small class="text-muted"><?php echo html_escape($reg['spesialis']); ?></small>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($reg['tanggal_kunjungan'])); ?></td>
                                        <td><?php echo date('H:i', strtotime($reg['jam_kunjungan'])); ?></td>
                                        <td>
                                            <span class="badge px-3 py-2 rounded-pill <?php echo $badge_class; ?>">
                                                <?php echo $status_label; ?>
                                            </span>
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
