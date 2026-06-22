<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Laporan Sistem</h2>
        <p class="text-muted">Unduh rekapitulasi data pendaftaran kunjungan dan statistik pasien.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Ringkasan Statistik -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2"><i class="fa-solid fa-chart-bar text-primary me-2"></i>Ringkasan Statistik</h5>
                
                <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                    <span class="text-muted"><i class="fa-solid fa-user-injured me-2 text-muted"></i> Total Pasien Terdaftar</span>
                    <span class="fw-bold"><?php echo $stats['total_pasien']; ?></span>
                </div>
                
                <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                    <span class="text-muted"><i class="fa-solid fa-file-medical me-2 text-muted"></i> Total Pendaftaran Konsultasi</span>
                    <span class="fw-bold"><?php echo $stats['total_pendaftaran']; ?></span>
                </div>

                <div class="d-flex justify-content-between mb-3 border-bottom pb-2 text-success">
                    <span><i class="fa-solid fa-circle-check me-2"></i> Pendaftaran Disetujui</span>
                    <span class="fw-bold"><?php echo $stats['pendaftaran_disetujui']; ?></span>
                </div>

                <div class="d-flex justify-content-between mb-3 border-bottom pb-2 text-danger">
                    <span><i class="fa-solid fa-circle-xmark me-2"></i> Pendaftaran Ditolak</span>
                    <span class="fw-bold"><?php echo $stats['pendaftaran_ditolak']; ?></span>
                </div>

                <div class="d-flex justify-content-between text-warning">
                    <span><i class="fa-solid fa-circle-pause me-2"></i> Pendaftaran Pending</span>
                    <span class="fw-bold"><?php echo $stats['pendaftaran_pending']; ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Ekspor Panel -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-file-export text-secondary me-2"></i>Unduh Dokumen Laporan</h5>
                    <p class="text-muted">Gunakan tombol di bawah ini untuk mengunduh laporan antrean pendaftaran dalam format CSV atau PDF. Dokumen diunduh secara instan dari server.</p>
                </div>
                
                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <a href="<?php echo base_url('admin/ekspor_pdf'); ?>" class="btn btn-danger w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="fa-solid fa-file-pdf fa-lg"></i>
                            Ekspor ke PDF
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url('admin/ekspor_csv'); ?>" class="btn btn-success w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="fa-solid fa-file-csv fa-lg"></i>
                            Ekspor ke CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
