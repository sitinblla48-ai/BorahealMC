<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Add New Patient</h2>
        <p class="text-muted">Register a new patient account in the system database.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary">
                        <i class="fa-solid fa-user-plus fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Patient Account Information</h5>
                        <small class="text-muted">Fill out all fields below</small>
                    </div>
                </div>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger" role="alert" style="font-size: 0.875rem;">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('admin/patients_create'); ?>" method="POST">
                    
                    <h6 class="fw-bold text-primary mb-3">1. Personal Profile</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" value="<?php echo set_value('full_name'); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label">Birth Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo set_value('birth_date'); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Numeric only" value="<?php echo set_value('phone_number'); ?>" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter patient home address" required><?php echo set_value('address'); ?></textarea>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary mb-3">2. Login Credentials</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Choose username" value="<?php echo set_value('username'); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password (min 5 characters)" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end border-top pt-3">
                        <a href="<?php echo base_url('admin/patients'); ?>" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Save Patient</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
