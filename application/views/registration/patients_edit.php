<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Edit Patient Details</h2>
        <p class="text-muted">Modify patient account profile or credentials.</p>
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
                        <h5 class="fw-bold mb-0">Update Patient ID #<?php echo $patient->id_patient; ?></h5>
                        <small class="text-muted">Modify the fields you wish to change</small>
                    </div>
                </div>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger" role="alert" style="font-size: 0.875rem;">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('admin/patients_edit/' . $patient->id_patient); ?>" method="POST">
                    
                    <h6 class="fw-bold text-primary mb-3">1. Personal Profile</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo set_value('full_name', $patient->full_name); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label">Birth Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo set_value('birth_date', $patient->birth_date); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo set_value('phone_number', $patient->phone_number); ?>" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo set_value('address', $patient->address); ?></textarea>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary mb-3">2. Login Credentials</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', $patient->username); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password <small class="text-muted">(Optional)</small></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep old password">
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end border-top pt-3">
                        <a href="<?php echo base_url('admin/patients'); ?>" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Update Details</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
