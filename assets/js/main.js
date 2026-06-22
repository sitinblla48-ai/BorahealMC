/* Custom Script for Hospital Patient Registration System */
$(document).ready(function() {
    // Sidebar toggle
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar, #content-wrapper').toggleClass('active');
    });

    // Initialize DataTables
    if ($('.datatable').length > 0) {
        $('.datatable').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "Cari data...",
                search: "",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    }

    // Delete Confirmation with SweetAlert2 (Hapus)
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var name = $(this).data('name') || 'data ini';
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda ingin menghapus " + name + "? Tindakan ini tidak dapat dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Approval Confirmations (Setujui)
    $(document).on('click', '.btn-approve-confirm', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        Swal.fire({
            title: 'Setujui Pendaftaran?',
            text: "Tindakan ini akan menyetujui jadwal kunjungan pasien.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });

    // Rejection Confirmations (Tolak)
    $(document).on('click', '.btn-reject-confirm', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        Swal.fire({
            title: 'Tolak Pendaftaran?',
            text: "Tindakan ini akan menolak jadwal kunjungan pasien.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});
