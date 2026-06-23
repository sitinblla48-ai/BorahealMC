<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted">Ikhtisar metrik klinis dan pendaftaran pasien.</p>
    </div>
</div>

<!-- Stats row -->
<div class="row g-3 mb-4">
    <!-- Total Pasien -->
    <div class="col-md-6 col-lg-4 col-xl-2.4">
        <div class="card card-stat border-0 border-start border-4 border-primary h-100 shadow-sm">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1">Total Pasien</div>
                        <h3 class="fw-bold m-0"><?php echo $stats['total_pasien']; ?></h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                        <i class="fa-solid fa-user-injured fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Pendaftaran -->
    <div class="col-md-6 col-lg-4 col-xl-2.4">
        <div class="card card-stat border-0 border-start border-4 border-secondary h-100 shadow-sm">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1">Total Pendaftaran</div>
                        <h3 class="fw-bold m-0"><?php echo $stats['total_pendaftaran']; ?></h3>
                    </div>
                    <div class="bg-secondary bg-opacity-10 p-3 rounded-circle text-secondary">
                        <i class="fa-solid fa-file-medical fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Disetujui -->
    <div class="col-md-6 col-lg-4 col-xl-2.4">
        <div class="card card-stat border-0 border-start border-4 border-success h-100 shadow-sm">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1">Disetujui</div>
                        <h3 class="fw-bold text-success m-0"><?php echo $stats['pendaftaran_disetujui']; ?></h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                        <i class="fa-solid fa-calendar-check fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Ditolak -->
    <div class="col-md-6 col-lg-4 col-xl-2.4">
        <div class="card card-stat border-0 border-start border-4 border-danger h-100 shadow-sm">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1">Ditolak</div>
                        <h3 class="fw-bold text-danger m-0"><?php echo $stats['pendaftaran_ditolak']; ?></h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger">
                        <i class="fa-solid fa-calendar-xmark fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Pending -->
    <div class="col-md-6 col-lg-4 col-xl-2.4">
        <div class="card card-stat border-0 border-start border-4 border-warning h-100 shadow-sm">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1">Pending</div>
                        <h3 class="fw-bold text-warning m-0"><?php echo $stats['pendaftaran_pending']; ?></h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                        <i class="fa-solid fa-clock fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Action Cards Row (Replacing "Aksi Cepat" list and blue info card) -->
<div class="row g-4">
    <!-- Kelola Data Pasien Card -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="text-primary bg-primary bg-opacity-10 p-3 rounded-3 d-inline-block mb-3">
                        <i class="fa-solid fa-user-injured fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Kelola Data Pasien</h5>
                    <p class="text-muted small mb-0">Kelola database pasien, registrasi akun pasien baru, serta perbarui data profil medis pasien secara terpusat.</p>
                </div>
                <div class="mt-4">
                    <a href="<?php echo base_url('admin/pasien'); ?>" class="btn btn-outline-primary w-100 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2">
                        <span>Kelola Pasien</span>
                        <i class="fa-solid fa-arrow-right small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Pendaftaran Card -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="text-secondary bg-secondary bg-opacity-10 p-3 rounded-3 d-inline-block mb-3">
                        <i class="fa-solid fa-calendar-check fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Jadwal Pendaftaran</h5>
                    <p class="text-muted small mb-0">Lihat permohonan pendaftaran kunjungan pasien, serta setujui atau tolak jadwal konsultasi dokter.</p>
                </div>
                <div class="mt-4">
                    <a href="<?php echo base_url('admin/jadwal'); ?>" class="btn btn-outline-primary w-100 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2">
                        <span>Kelola Jadwal</span>
                        <i class="fa-solid fa-arrow-right small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Card -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="text-info bg-info bg-opacity-10 p-3 rounded-3 d-inline-block mb-3">
                        <i class="fa-solid fa-chart-line fa-2x text-info"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Laporan</h5>
                    <p class="text-muted small mb-0">Lihat statistik klinis, pratinjau pendaftaran kunjungan bulanan, dan ekspor data ke format PDF/CSV.</p>
                </div>
                <div class="mt-4">
                    <a href="<?php echo base_url('admin/laporan'); ?>" class="btn btn-outline-primary w-100 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2">
                        <span>Buka Laporan</span>
                        <i class="fa-solid fa-arrow-right small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
