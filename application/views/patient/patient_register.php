<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Online Registration</h2>
        <p class="text-muted">Submit a new consultation request. Please fill out all required fields.</p>
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
                        <h5 class="fw-bold mb-0">New Registration Request</h5>
                        <small class="text-muted">Provide your medical request details</small>
                    </div>
                </div>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger" role="alert" style="font-size: 0.875rem;">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('patient/register'); ?>" method="POST">
                    
                    <h6 class="fw-bold text-primary mb-3">1. Patient Profile Details (Auto-filled)</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label text-muted small">Full Name</label>
                            <input type="text" class="form-control bg-light" id="full_name" name="full_name" value="<?php echo html_escape($patient->full_name); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label text-muted small">Birth Date</label>
                            <input type="date" class="form-control bg-light" id="birth_date" name="birth_date" value="<?php echo html_escape($patient->birth_date); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label text-muted small">Phone Number</label>
                            <input type="text" class="form-control bg-light" id="phone_number" name="phone_number" value="<?php echo html_escape($patient->phone_number); ?>" readonly>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label text-muted small">Address</label>
                            <textarea class="form-control bg-light" id="address" name="address" rows="2" readonly><?php echo html_escape($patient->address); ?></textarea>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary mb-3">2. Appointment & Schedule Details</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label for="id_specialist" class="form-label">Medical Specialist <span class="text-danger">*</span></label>
                            <select class="form-select" id="id_specialist" name="id_specialist" required>
                                <option value="" disabled selected>-- Select Medical Specialist --</option>
                                <?php if (!empty($specialists)): ?>
                                    <?php foreach ($specialists as $spec): ?>
                                        <option value="<?php echo $spec['id_specialist']; ?>" <?php echo set_select('id_specialist', $spec['id_specialist']); ?>>
                                            <?php echo html_escape($spec['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="visit_date" class="form-label">Visit Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="visit_date" name="visit_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo set_value('visit_date'); ?>" required>
                            <small class="text-muted">Must be today or a future date</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="visit_time" class="form-label">Visit Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="visit_time" name="visit_time" value="<?php echo set_value('visit_time'); ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="complaint" class="form-label">Complaint / Illness Symptoms <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="complaint" name="complaint" rows="3" placeholder="Describe your symptoms or reason for visit" required><?php echo set_value('complaint'); ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo base_url('patient/dashboard'); ?>" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Submit Request</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
