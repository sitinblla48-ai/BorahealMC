<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Ubah Data Pasien</h2>
        <p class="text-muted">Perbarui data profil pribadi atau kredensial login pasien.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary">
                        <i class="fa-solid fa-user-pen fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Ubah Data Pasien ID #<?php echo $pasien->id_pasien; ?></h5>
                        <small class="text-muted">Sesuaikan kolom yang ingin Anda ubah</small>
                    </div>
                </div>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger" role="alert" style="font-size: 0.875rem;">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('admin/pasien_edit/' . $pasien->id_pasien); ?>" method="POST">
                    
                    <h6 class="fw-bold text-primary mb-3">1. Profil Pribadi</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo set_value('nama_lengkap', $pasien->nama_lengkap); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo set_value('tanggal_lahir', $pasien->tanggal_lahir); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="no_telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo set_value('no_telepon', $pasien->no_telepon); ?>" required>
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo set_value('alamat', $pasien->alamat); ?></textarea>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary mb-3">2. Kredensial Login</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', $pasien->username); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password <small class="text-muted">(Opsional)</small></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end border-top pt-3">
                        <a href="<?php echo base_url('admin/pasien'); ?>" class="btn btn-light px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Perbarui Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
