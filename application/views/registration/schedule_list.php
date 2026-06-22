<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Registration Schedules</h2>
        <p class="text-muted">Manage patient registration schedules, consultations, and approvals.</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h5 class="fw-bold m-0"><i class="fa-solid fa-calendar-days text-primary me-2"></i>Consultation Schedules</h5>
                    <span class="badge bg-primary px-3 py-2">Sorted by Visit Date</span>
                </div>
                
                <div class="table-responsive p-0 border-0">
                    <table class="table table-hover align-middle datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th>Reg ID</th>
                                <th>Patient Name</th>
                                <th>Specialist</th>
                                <th>Visit Date</th>
                                <th>Visit Time</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($schedules)): ?>
                                <?php foreach ($schedules as $sched): ?>
                                    <?php 
                                    $reg_id_formatted = sprintf('REG-%s-%04d', str_replace('-', '', $sched['visit_date']), $sched['id_registration']);
                                    
                                    // Badge class based on status
                                    $badge_class = 'badge-pending';
                                    if ($sched['registration_status'] == 'Approved') {
                                        $badge_class = 'badge-approved';
                                    } elseif ($sched['registration_status'] == 'Rejected') {
                                        $badge_class = 'badge-rejected';
                                    }
                                    ?>
                                    <tr>
                                        <td class="fw-bold text-primary"><?php echo $reg_id_formatted; ?></td>
                                        <td class="fw-semibold"><?php echo html_escape($sched['patient_name']); ?></td>
                                        <td><?php echo html_escape($sched['specialist_name']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($sched['visit_date'])); ?></td>
                                        <td><?php echo date('h:i A', strtotime($sched['visit_time'])); ?></td>
                                        <td>
                                            <span class="badge px-3 py-2 rounded-pill <?php echo $badge_class; ?>">
                                                <?php echo $sched['registration_status']; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($sched['registration_status'] == 'Pending'): ?>
                                                <div class="d-inline-flex gap-2">
                                                    <a href="<?php echo base_url('admin/approve_registration/' . $sched['id_registration']); ?>" class="btn btn-sm btn-success btn-approve-confirm" title="Approve Registration">
                                                        <i class="fa-solid fa-check me-1"></i> Approve
                                                    </a>
                                                    <a href="<?php echo base_url('admin/reject_registration/' . $sched['id_registration']); ?>" class="btn btn-sm btn-danger btn-reject-confirm" title="Reject Registration">
                                                        <i class="fa-solid fa-xmark me-1"></i> Reject
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted small"><i class="fa-solid fa-lock me-1"></i> Closed</span>
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
