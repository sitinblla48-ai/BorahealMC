<div class="row mb-4 align-items-center">
    <div class="col-sm-6">
        <h2 class="fw-bold">Kelola Data Pasien</h2>
        <p class="text-muted">Lihat, cari, tambah, ubah, atau hapus rekam data pasien.</p>
    </div>
    <div class="col-sm-6 text-sm-end">
        <a href="<?php echo base_url('admin/pasien_create'); ?>" class="btn btn-primary fw-bold"><i class="fa-solid fa-plus me-1"></i> Tambah Pasien</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body">
                <div class="table-responsive p-0 border-0">
                    <table class="table table-hover align-middle datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Username</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pasien)): ?>
                                <?php foreach ($pasien as $p): ?>
                                    <tr>
                                        <td class="fw-bold text-muted">#<?php echo $p['id_pasien']; ?></td>
                                        <td class="fw-semibold"><?php echo html_escape($p['nama_lengkap']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($p['tanggal_lahir'])); ?></td>
                                        <td><?php echo html_escape($p['alamat']); ?></td>
                                        <td><?php echo html_escape($p['no_telepon']); ?></td>
                                        <td><span class="badge bg-light text-dark">@<?php echo html_escape($p['username']); ?></span></td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-2">
                                                <a href="<?php echo base_url('admin/pasien_edit/' . $p['id_pasien']); ?>" class="btn btn-outline-secondary btn-sm" title="Ubah Data Pasien">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="<?php echo base_url('admin/pasien_delete/' . $p['id_pasien']); ?>" method="POST" class="d-inline">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-delete" data-name="<?php echo html_escape($p['nama_lengkap']); ?>" title="Hapus Pasien">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
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
