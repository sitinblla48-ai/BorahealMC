    </div>
    <!-- /Container -->
    
    <!-- Footer -->
    <footer class="bg-white text-center text-muted py-3 mt-auto border-top">
        <small>&copy; <?php echo date('Y'); ?> RS Boraheal Medical Center. Hak Cipta Dilindungi.</small>
    </footer>
</div>
<!-- /#content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Bootstrap 5 Bundle with Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom JS -->
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

<!-- SweetAlert Flash Messages -->
<script>
$(document).ready(function() {
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo $this->session->flashdata('success'); ?>',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?php echo $this->session->flashdata('error'); ?>',
            confirmButtonColor: '#6f42c1'
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('info')): ?>
        Swal.fire({
            icon: 'info',
            title: 'Pemberitahuan',
            text: '<?php echo $this->session->flashdata('info'); ?>',
            confirmButtonColor: '#6f42c1'
        });
    <?php endif; ?>
});
</script>
</body>
</html>