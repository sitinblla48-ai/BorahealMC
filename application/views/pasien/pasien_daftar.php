<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Pendaftaran Konsultasi Online</h2>
        <p class="text-muted">Kirim permintaan pendaftaran kunjungan konsultasi dokter baru.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary">
                        <i class="fa-solid fa-file-medical fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Formulir Pendaftaran</h5>
                        <small class="text-muted">Lengkapi kolom janji temu dokter di bawah ini</small>
                    </div>
                </div>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger" role="alert" style="font-size: 0.875rem;">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('pasien/daftar'); ?>" method="POST">
                    
                    <h6 class="fw-bold text-primary mb-3">1. Data Profil Pasien (Otomatis)</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label text-muted small">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light" id="nama_lengkap" name="nama_lengkap" value="<?php echo html_escape($pasien->nama_lengkap); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label text-muted small">Tanggal Lahir</label>
                            <input type="date" class="form-control bg-light" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo html_escape($pasien->tanggal_lahir); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="no_telepon" class="form-label text-muted small">Nomor Telepon</label>
                            <input type="text" class="form-control bg-light" id="no_telepon" name="no_telepon" value="<?php echo html_escape($pasien->no_telepon); ?>" readonly>
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label text-muted small">Alamat Lengkap</label>
                            <textarea class="form-control bg-light" id="alamat" name="alamat" rows="2" readonly><?php echo html_escape($pasien->alamat); ?></textarea>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary mb-3">2. Detail Jadwal & Keluhan</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label for="id_dokter" class="form-label">Pilih Dokter & Spesialisasi <span class="text-danger">*</span></label>
                            <select class="form-select" id="id_dokter" name="id_dokter" required>
                                <option value="" disabled selected>-- Pilih Dokter / Spesialis --</option>
                                <?php if (!empty($doctors)): ?>
                                    <?php foreach ($doctors as $doc): ?>
                                        <option value="<?php echo $doc['id_dokter']; ?>" <?php echo set_select('id_dokter', $doc['id_dokter']); ?>>
                                            <?php echo html_escape($doc['nama_dokter'] . ' - ' . $doc['spesialis']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" min="<?php echo date('Y-m-d'); ?>" value="<?php echo set_value('tanggal_kunjungan'); ?>" required>
                            <small class="text-muted">Hanya boleh tanggal hari ini atau ke depan</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="jam_kunjungan" class="form-label">Jam Kunjungan <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="jam_kunjungan" name="jam_kunjungan" value="<?php echo set_value('jam_kunjungan'); ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="keluhan" class="form-label">Keluhan Penyakit / Gejala Medis <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" placeholder="Jelaskan secara singkat gejala medis yang dirasakan" required><?php echo set_value('keluhan'); ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo base_url('pasien/dashboard'); ?>" class="btn btn-light px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Kirim Pendaftaran</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
