<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login - Boraheal MC</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body class="login-bg d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card p-4 border-0">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <i class="fa-solid fa-hospital-user fa-3x text-primary mb-3"></i>
                            <h3 class="fw-bold">Patient Portal</h3>
                            <p class="text-muted">Hospital Patient Registration System</p>
                        </div>
                        
                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger py-2" role="alert">
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url('patient/login'); ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fa-solid fa-user text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Enter username" value="<?php echo set_value('username'); ?>" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fa-solid fa-lock text-muted"></i></span>
                                    <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Enter password" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2.5 fw-bold mb-3">Sign In</button>
                        </form>

                        <div class="text-center mb-2">
                            <span class="text-muted small">Don't have an account? </span>
                            <a href="<?php echo base_url('auth/register'); ?>" class="text-decoration-none small fw-bold">Sign Up Here</a>
                        </div>
                        
                        <div class="text-center">
                            <a href="<?php echo base_url('admin/login'); ?>" class="text-decoration-none small text-muted"><i class="fa-solid fa-user-shield me-1"></i> Admin Portal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery, Bootstrap 5, SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({ icon: 'success', title: 'Success!', text: '<?php echo $this->session->flashdata('success'); ?>', timer: 3000, showConfirmButton: false });
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({ icon: 'error', title: 'Login Error', text: '<?php echo $this->session->flashdata('error'); ?>', confirmButtonColor: '#3b82f6' });
        <?php endif; ?>
    });
    </script>
</body>
</html>
