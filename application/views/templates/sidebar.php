<!-- Sidebar -->
<div id="sidebar">
    <div class="sidebar-header d-flex align-items-center justify-content-between">
        <h4 class="m-0 fw-bold"><i class="fa-solid fa-hospital me-2 text-primary-custom"></i>Boraheal MC</h4>
    </div>
    
    <div class="list-group list-group-flush mt-3">
        <?php if ($this->session->userdata('admin_logged_in')): ?>
            <!-- Admin Navigation -->
            <div class="px-4 mb-2 text-uppercase text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.05rem; opacity: 0.8;">Menu Admin</div>
            
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="<?php echo base_url('admin/pasien'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'pasien') ? 'active' : ''; ?>">
                <i class="fa-solid fa-user-injured"></i>
                <span>Data Pasien</span>
            </a>
            
            <a href="<?php echo base_url('admin/jadwal'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'jadwal') ? 'active' : ''; ?>">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Data Pendaftaran</span>
            </a>
            
            <a href="<?php echo base_url('admin/laporan'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'laporan' || $this->uri->segment(2) == 'laporan') ? 'active' : ''; ?>">
                <i class="fa-solid fa-file-invoice"></i>
                <span>Laporan</span>
            </a>
            
            <hr class="mx-3 my-2" style="opacity: 0.08;">
            
            <a href="<?php echo base_url('admin/logout'); ?>" class="nav-link text-danger">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Keluar</span>
            </a>

        <?php elseif ($this->session->userdata('pasien_logged_in')): ?>
            <!-- Patient Navigation -->
            <div class="px-4 mb-2 text-uppercase text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.05rem; opacity: 0.8;">Menu Pasien</div>
            
            <a href="<?php echo base_url('pasien/dashboard'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                <i class="fa-solid fa-address-card"></i>
                <span>Profil & Riwayat</span>
            </a>
            
            <a href="<?php echo base_url('pasien/daftar'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'daftar') ? 'active' : ''; ?>">
                <i class="fa-solid fa-file-medical"></i>
                <span>Pendaftaran Online</span>
            </a>
            
            <hr class="mx-3 my-2" style="opacity: 0.08;">
            
            <a href="<?php echo base_url('pasien/logout'); ?>" class="nav-link text-danger">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Keluar</span>
            </a>
        <?php endif; ?>
    </div>
</div>
<!-- /#sidebar -->