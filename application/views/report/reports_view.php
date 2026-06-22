<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">System Reports</h2>
        <p class="text-muted">Generate and export system metrics and patient registration data.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Reports Summary Card -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2"><i class="fa-solid fa-chart-bar text-primary me-2"></i>Statistics Summary</h5>
                
                <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                    <span class="text-muted"><i class="fa-solid fa-user-injured me-2 text-muted"></i> Total Registered Patients</span>
                    <span class="fw-bold"><?php echo $stats['total_patients']; ?></span>
                </div>
                
                <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                    <span class="text-muted"><i class="fa-solid fa-file-medical me-2 text-muted"></i> Total Consultations Booked</span>
                    <span class="fw-bold"><?php echo $stats['total_registrations']; ?></span>
                </div>

                <div class="d-flex justify-content-between mb-3 border-bottom pb-2 text-success">
                    <span><i class="fa-solid fa-circle-check me-2"></i> Approved Consultations</span>
                    <span class="fw-bold"><?php echo $stats['approved_registrations']; ?></span>
                </div>

                <div class="d-flex justify-content-between mb-3 border-bottom pb-2 text-danger">
                    <span><i class="fa-solid fa-circle-xmark me-2"></i> Rejected Consultations</span>
                    <span class="fw-bold"><?php echo $stats['rejected_registrations']; ?></span>
                </div>

                <div class="d-flex justify-content-between text-warning">
                    <span><i class="fa-solid fa-circle-pause me-2"></i> Pending Approvals</span>
                    <span class="fw-bold"><?php echo $stats['pending_registrations']; ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Panel -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm card-stat h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-file-export text-secondary me-2"></i>Export Report Data</h5>
                    <p class="text-muted">Select a format below to download the registration schedule lists and summary statistics. Export files are fully generated server-side.</p>
                </div>
                
                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <a href="<?php echo base_url('admin/export_pdf'); ?>" class="btn btn-danger w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="fa-solid fa-file-pdf fa-lg"></i>
                            Export to PDF
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url('admin/export_csv'); ?>" class="btn btn-success w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="fa-solid fa-file-csv fa-lg"></i>
                            Export to CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
