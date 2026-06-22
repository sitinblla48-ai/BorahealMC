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

<div class="row g-4">
    <!-- Quick Shortcuts Card -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-bolt me-2 text-warning"></i>Aksi Cepat</h5>
                <p class="text-muted">Akses langsung fitur utama administrasi:</p>
                <div class="d-grid gap-2">
                    <a href="<?php echo base_url('admin/pasien'); ?>" class="btn btn-outline-primary py-2.5 text-start fw-semibold"><i class="fa-solid fa-user-injured me-2"></i> Kelola Database Pasien</a>
                    <a href="<?php echo base_url('admin/jadwal'); ?>" class="btn btn-outline-secondary py-2.5 text-start fw-semibold"><i class="fa-solid fa-calendar-day me-2"></i> Kelola Jadwal & Persetujuan</a>
                    <a href="<?php echo base_url('admin/laporan'); ?>" class="btn btn-outline-info py-2.5 text-start fw-semibold"><i class="fa-solid fa-chart-line me-2"></i> Ringkasan Laporan & Ekspor Data</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Panel -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm card-stat h-100 bg-primary text-white">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <h4 class="fw-bold mb-2">Hospital Admin Center</h4>
                    <p class="text-white-50">Anda masuk sebagai Administrator. Anda memiliki hak akses penuh untuk mendaftarkan pasien baru, menyetujui atau menolak permohonan pendaftaran kunjungan dokter, dan mengekspor laporan bulanan.</p>
                </div>
                <div class="text-end">
                    <i class="fa-solid fa-shield-halved fa-5x text-white-50 opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</div>
