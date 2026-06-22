<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">My Portal</h2>
        <p class="text-muted">Manage your profile and track your online registration status.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Personal Information Card -->
    <div class="col-lg-4">
        <div class="card card-stat h-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary">
                        <i class="fa-solid fa-address-card fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Personal Profile</h5>
                        <small class="text-muted">Your registered details</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small d-block">Full Name</label>
                    <span class="fw-semibold text-dark"><?php echo html_escape($patient->full_name); ?></span>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small d-block">Birth Date</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-cake-candles me-1 text-muted"></i> <?php echo date('d M Y', strtotime($patient->birth_date)); ?></span>
                </div>

                <div class="mb-3">
                    <label class="text-muted small d-block">Phone Number</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-phone me-1 text-muted"></i> <?php echo html_escape($patient->phone_number); ?></span>
                </div>

                <div class="mb-3">
                    <label class="text-muted small d-block">Address</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-map-location-dot me-1 text-muted"></i> <?php echo nl2br(html_escape($patient->address)); ?></span>
                </div>

                <div class="mb-0">
                    <label class="text-muted small d-block">Username</label>
                    <span class="fw-semibold text-dark"><i class="fa-solid fa-user-tag me-1 text-muted"></i> @<?php echo html_escape($patient->username); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration History -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0"><i class="fa-solid fa-clock-rotate-left me-2 text-secondary"></i>Registration History</h5>
                    <a href="<?php echo base_url('patient/register'); ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i> New Registration</a>
                </div>
                
                <div class="table-responsive p-0 border-0">
                    <table class="table table-hover align-middle datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th>Reg ID</th>
                                <th>Specialist</th>
                                <th>Visit Date</th>
                                <th>Visit Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($registrations)): ?>
                                <?php foreach ($registrations as $reg): ?>
                                    <?php 
                                    // Generate structured ID: REG-YYYYMMDD-XXXX
                                    $reg_id_formatted = sprintf('REG-%s-%04d', str_replace('-', '', $reg['visit_date']), $reg['id_registration']);
                                    
                                    // Badge class based on status
                                    $badge_class = 'badge-pending';
                                    if ($reg['registration_status'] == 'Approved') {
                                        $badge_class = 'badge-approved';
                                    } elseif ($reg['registration_status'] == 'Rejected') {
                                        $badge_class = 'badge-rejected';
                                    }
                                    ?>
                                    <tr>
                                        <td class="fw-bold text-primary"><?php echo $reg_id_formatted; ?></td>
                                        <td><?php echo html_escape($reg['specialist_name']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($reg['visit_date'])); ?></td>
                                        <td><?php echo date('h:i A', strtotime($reg['visit_time'])); ?></td>
                                        <td>
                                            <span class="badge px-3 py-2 rounded-pill <?php echo $badge_class; ?>">
                                                <?php echo $reg['registration_status']; ?>
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
