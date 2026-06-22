<!-- Page Content -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light navbar-custom">
        <div class="container-fluid p-0">
            <button class="btn btn-outline-secondary me-3" id="sidebarCollapse">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <h5 class="m-0 fw-bold d-none d-sm-inline-block text-dark">
                Sistem Registrasi Pasien RS - Boraheal Medical Center
            </h5>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark fw-bold d-flex align-items-center gap-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-circle-user fa-lg text-primary"></i>
                        <span>
                            <?php 
                            if ($this->session->userdata('admin_logged_in')) {
                                echo html_escape($this->session->userdata('admin_username')) . ' (Admin)';
                            } elseif ($this->session->userdata('pasien_logged_in')) {
                                echo html_escape($this->session->userdata('pasien_name')) . ' (Pasien)';
                            } else {
                                echo 'Tamu';
                            }
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown">
                        <li>
                            <?php if ($this->session->userdata('admin_logged_in')): ?>
                                <a class="dropdown-item text-danger fw-semibold" href="<?php echo base_url('admin/logout'); ?>">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar
                                </a>
                            <?php elseif ($this->session->userdata('pasien_logged_in')): ?>
                                <a class="dropdown-item text-danger fw-semibold" href="<?php echo base_url('pasien/logout'); ?>">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Main Content Body -->
    <div class="container-fluid py-4 flex-grow-1">
