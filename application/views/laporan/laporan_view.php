<?php
// Extract all unique years from database pendaftaran to populate dropdown
$years = [];
$CI =& get_instance();
$all_scheds = $CI->db->select('tanggal_kunjungan')->from('pendaftaran')->get()->result_array();
foreach ($all_scheds as $s) {
    if (!empty($s['tanggal_kunjungan'])) {
        $yr = date('Y', strtotime($s['tanggal_kunjungan']));
        if (!in_array($yr, $years)) {
            $years[] = $yr;
        }
    }
}
sort($years);
$current_year = date('Y');
if (!in_array($current_year, $years)) {
    $years[] = $current_year;
}

$month_names_indo = array(
    'all' => 'Semua Bulan',
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
);

$is_active_total = ($selected_status === 'all');
$is_active_disetujui = ($selected_status === 'Disetujui');
$is_active_ditolak = ($selected_status === 'Ditolak');
$is_active_pending = ($selected_status === 'Pending');
?>

<style>
/* Stats cards styling for reports page */
.card-stat {
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(139, 92, 246, 0.05);
    background-color: #ffffff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card-stat:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.08);
}
.border-primary {
    border-color: #8B5CF6 !important;
}
.border-secondary {
    border-color: #C4B5FD !important;
}
.text-primary-custom {
    color: #8B5CF6 !important;
}
.bg-primary-light {
    background-color: #F5F3FF !important;
}

/* Active card highlight using Boraheal purple theme */
.card-stat.active-card {
    border: 2px solid #8B5CF6 !important;
    background-color: #F5F3FF !important;
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(139, 92, 246, 0.12) !important;
}

/* Custom Grid for 5 cards in a row on desktop */
@media (min-width: 1200px) {
    .col-xl-2-4 {
        flex: 0 0 20%;
        max-width: 20%;
    }
}

/* Print CSS */
@media print {
    /* Hide non-printable layout elements */
    #sidebar, 
    .navbar-custom, 
    .navbar, 
    .no-print, 
    .btn, 
    .dataTables_length, 
    .dataTables_filter, 
    .dataTables_info, 
    .dataTables_paginate,
    footer,
    .card-header,
    .d-flex.justify-content-between.align-items-center.mb-3 {
        display: none !important;
    }
    
    /* Reset page and margins */
    @page {
        size: A4 portrait;
        margin: 1.5cm 1.2cm;
    }
    
    body {
        background: #fff !important;
        color: #000 !important;
        font-family: 'Poppins', 'Inter', Arial, sans-serif !important;
        font-size: 10pt !important;
    }
    
    #content-wrapper {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .container, .container-fluid {
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* Print Header Styles */
    .d-print-block {
        display: block !important;
    }
    
    /* Stats Layout for Print */
    .print-stats-row {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        justify-content: space-between !important;
        margin-bottom: 25px !important;
        border: 1px solid #e1dbec !important;
        border-radius: 8px !important;
        padding: 15px !important;
        background-color: #faf9ff !important;
    }
    
    .print-stat-col {
        text-align: center !important;
        flex: 1 !important;
        border-right: 1px solid #e1dbec !important;
    }
    .print-stat-col:last-child {
        border-right: none !important;
    }
    .print-stat-label {
        font-size: 8pt !important;
        text-transform: uppercase !important;
        color: #7c728e !important;
        font-weight: bold !important;
        margin-bottom: 5px !important;
    }
    .print-stat-val {
        font-size: 14pt !important;
        font-weight: bold !important;
        color: #372f47 !important;
    }
    .print-stat-val.text-success { color: #15803d !important; }
    .print-stat-val.text-danger { color: #b91c1c !important; }
    .print-stat-val.text-warning { color: #b45309 !important; }

    /* Hide standard stats cards during print */
    .stats-cards-container {
        display: none !important;
    }
    
    /* Table Print Styling */
    .card {
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        background: transparent !important;
        margin-bottom: 20px !important;
    }
    
    .table-responsive {
        box-shadow: none !important;
        padding: 0 !important;
        background: transparent !important;
        overflow: visible !important;
    }
    
    table.table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }
    
    table.table th, table.table td {
        border: 1px solid #cccccc !important;
        padding: 8px 6px !important;
        font-size: 9pt !important;
        color: #000 !important;
        background: #fff !important;
    }
    
    table.table th {
        background-color: #f3f0ff !important;
        font-weight: bold !important;
        text-align: center !important;
    }
    
    table.table td .badge {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        color: #000 !important;
        font-weight: 500 !important;
        font-size: 9pt !important;
    }
}
</style>

<!-- Print-only Title Header -->
<div class="d-none d-print-block print-header text-center mb-4">
    <h2 class="fw-bold mb-1" style="color: #8B5CF6;">Boraheal Medical Center</h2>
    <h4 class="fw-semibold mb-1 text-dark">Laporan Pendaftaran Pasien</h4>
    <p class="mb-1">Periode Laporan: <span class="fw-bold"><?php echo $month_names_indo[$selected_bulan] . ' ' . ($selected_tahun == 'all' ? 'Semua Tahun' : $selected_tahun); ?></span><?php if ($selected_status !== 'all'): ?> (Status: <?php echo htmlspecialchars($selected_status); ?>)<?php endif; ?></p>
    <p class="mb-1">Total Pendaftaran: <span class="fw-bold"><?php echo count($schedules); ?></span></p>
    <p class="small text-muted mb-2">Tanggal Cetak: <?php echo date('d-m-Y H:i'); ?> WIB</p>
    <hr style="border-top: 2px solid #8B5CF6; opacity: 1; margin-top: 10px; margin-bottom: 20px;">
</div>

<div class="row mb-4 no-print">
    <div class="col-12">
        <h2 class="fw-bold">Laporan Sistem</h2>
        <p class="text-muted">Unduh rekapitulasi data pendaftaran kunjungan dan statistik pasien.</p>
    </div>
</div>

<!-- Monthly Filter Card -->
<div class="card border-0 shadow-sm mb-4 no-print">
    <div class="card-body p-4">
        <form action="<?php echo base_url('admin/laporan'); ?>" method="GET" class="row align-items-end g-3">
            <!-- Hidden Input for Selected Status Card Filter -->
            <input type="hidden" name="status" id="filterStatus" value="<?php echo htmlspecialchars($selected_status); ?>">

            <!-- Filter Controls -->
            <div class="col-lg-6">
                <div class="row g-2">
                    <div class="col-sm-6">
                        <label for="filterBulan" class="form-label fw-semibold text-muted mb-1">
                            <i class="fa-solid fa-calendar-minus me-1 text-primary-custom"></i>Bulan
                        </label>
                        <select name="bulan" id="filterBulan" class="form-select">
                            <option value="all" <?php echo ($selected_bulan === 'all') ? 'selected' : ''; ?>>Semua Bulan</option>
                            <option value="01" <?php echo ($selected_bulan === '01') ? 'selected' : ''; ?>>Januari</option>
                            <option value="02" <?php echo ($selected_bulan === '02') ? 'selected' : ''; ?>>Februari</option>
                            <option value="03" <?php echo ($selected_bulan === '03') ? 'selected' : ''; ?>>Maret</option>
                            <option value="04" <?php echo ($selected_bulan === '04') ? 'selected' : ''; ?>>April</option>
                            <option value="05" <?php echo ($selected_bulan === '05') ? 'selected' : ''; ?>>Mei</option>
                            <option value="06" <?php echo ($selected_bulan === '06') ? 'selected' : ''; ?>>Juni</option>
                            <option value="07" <?php echo ($selected_bulan === '07') ? 'selected' : ''; ?>>Juli</option>
                            <option value="08" <?php echo ($selected_bulan === '08') ? 'selected' : ''; ?>>Agustus</option>
                            <option value="09" <?php echo ($selected_bulan === '09') ? 'selected' : ''; ?>>September</option>
                            <option value="10" <?php echo ($selected_bulan === '10') ? 'selected' : ''; ?>>Oktober</option>
                            <option value="11" <?php echo ($selected_bulan === '11') ? 'selected' : ''; ?>>November</option>
                            <option value="12" <?php echo ($selected_bulan === '12') ? 'selected' : ''; ?>>Desember</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="filterTahun" class="form-label fw-semibold text-muted mb-1">
                            <i class="fa-solid fa-calendar-plus me-1 text-primary-custom"></i>Tahun
                        </label>
                        <select name="tahun" id="filterTahun" class="form-select">
                            <option value="all" <?php echo ($selected_tahun === 'all') ? 'selected' : ''; ?>>Semua Tahun</option>
                            <?php foreach ($years as $yr): ?>
                                <option value="<?php echo $yr; ?>" <?php echo ($selected_tahun === $yr) ? 'selected' : ''; ?>><?php echo $yr; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Tampilkan Button -->
            <div class="col-lg-2 col-md-4">
                <button type="submit" id="btnTampilkan" class="btn btn-primary w-100 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-circle-play"></i> Tampilkan
                </button>
            </div>
            
            <!-- Export Buttons -->
            <div class="col-lg-4 col-md-8 text-md-end">
                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                    <a href="<?php echo base_url('admin/ekspor_pdf?bulan=' . $selected_bulan . '&tahun=' . $selected_tahun . '&status=' . $selected_status); ?>" id="btnExportPDF" class="btn btn-danger py-2.5 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="fa-solid fa-file-pdf"></i> Unduh PDF
                    </a>
                    <a href="<?php echo base_url('admin/ekspor_csv?bulan=' . $selected_bulan . '&tahun=' . $selected_tahun . '&status=' . $selected_status); ?>" id="btnExportCSV" class="btn btn-success py-2.5 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="fa-solid fa-file-csv"></i> Unduh CSV
                    </a>
                    <button type="button" id="btnPrintReport" class="btn btn-primary py-2.5 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="fa-solid fa-print"></i> Cetak
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Print-only stats layout -->
<div class="d-none print-stats-row">
    <div class="print-stat-col">
        <div class="print-stat-label">Total Pasien</div>
        <div class="print-stat-val text-primary-custom"><?php echo $stats['total_pasien']; ?></div>
    </div>
    <div class="print-stat-col">
        <div class="print-stat-label">Total Pendaftaran</div>
        <div class="print-stat-val"><?php echo $stats['total_pendaftaran']; ?></div>
    </div>
    <div class="print-stat-col">
        <div class="print-stat-label">Disetujui</div>
        <div class="print-stat-val text-success"><?php echo $stats['pendaftaran_disetujui']; ?></div>
    </div>
    <div class="print-stat-col">
        <div class="print-stat-label">Ditolak</div>
        <div class="print-stat-val text-danger"><?php echo $stats['pendaftaran_ditolak']; ?></div>
    </div>
    <div class="print-stat-col">
        <div class="print-stat-label">Pending</div>
        <div class="print-stat-val text-warning"><?php echo $stats['pendaftaran_pending']; ?></div>
    </div>
</div>

<!-- Dynamic Dashboard Stats (Preview Cards as Interactive Filters) -->
<div class="row g-3 mb-4 stats-cards-container">
    <!-- Total Pasien -->
    <div class="col-md-6 col-lg-4 col-xl-2-4">
        <div class="card card-stat border-0 border-start border-4 border-primary h-100 shadow-sm filter-card" data-filter="all" style="cursor: pointer;">
            <div class="card-body py-3.5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Total Pasien</div>
                        <h4 class="fw-bold m-0" id="stat-total-pasien"><?php echo $stats['total_pasien']; ?></h4>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-2.5 rounded-circle text-primary">
                        <i class="fa-solid fa-user-injured fa-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Pendaftaran -->
    <div class="col-md-6 col-lg-4 col-xl-2-4">
        <div class="card card-stat border-0 border-start border-4 border-secondary h-100 shadow-sm filter-card <?php echo $is_active_total ? 'active-card' : ''; ?>" data-filter="all" style="cursor: pointer;">
            <div class="card-body py-3.5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Total Pendaftaran</div>
                        <h4 class="fw-bold m-0" id="stat-total-pendaftaran"><?php echo $stats['total_pendaftaran']; ?></h4>
                    </div>
                    <div class="bg-secondary bg-opacity-10 p-2.5 rounded-circle text-secondary">
                        <i class="fa-solid fa-file-medical fa-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Disetujui -->
    <div class="col-md-6 col-lg-4 col-xl-2-4">
        <div class="card card-stat border-0 border-start border-4 border-success h-100 shadow-sm filter-card <?php echo $is_active_disetujui ? 'active-card' : ''; ?>" data-filter="Disetujui" style="cursor: pointer;">
            <div class="card-body py-3.5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Disetujui</div>
                        <h4 class="fw-bold text-success m-0" id="stat-disetujui"><?php echo $stats['pendaftaran_disetujui']; ?></h4>
                    </div>
                    <div class="bg-success bg-opacity-10 p-2.5 rounded-circle text-success">
                        <i class="fa-solid fa-calendar-check fa-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Ditolak -->
    <div class="col-md-6 col-lg-4 col-xl-2-4">
        <div class="card card-stat border-0 border-start border-4 border-danger h-100 shadow-sm filter-card <?php echo $is_active_ditolak ? 'active-card' : ''; ?>" data-filter="Ditolak" style="cursor: pointer;">
            <div class="card-body py-3.5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Ditolak</div>
                        <h4 class="fw-bold text-danger m-0" id="stat-ditolak"><?php echo $stats['pendaftaran_ditolak']; ?></h4>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-2.5 rounded-circle text-danger">
                        <i class="fa-solid fa-calendar-xmark fa-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Pending -->
    <div class="col-md-6 col-lg-4 col-xl-2-4">
        <div class="card card-stat border-0 border-start border-4 border-warning h-100 shadow-sm filter-card <?php echo $is_active_pending ? 'active-card' : ''; ?>" data-filter="Pending" style="cursor: pointer;">
            <div class="card-body py-3.5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Menunggu</div>
                        <h4 class="fw-bold text-warning m-0" id="stat-pending"><?php echo $stats['pendaftaran_pending']; ?></h4>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-2.5 rounded-circle text-warning">
                        <i class="fa-solid fa-clock fa-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Data Preview Card -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3 border-bottom pb-3 no-print">
            <i class="fa-solid fa-list text-primary-custom me-2"></i>Pratinjau Data Laporan
        </h5>
        
        <div class="table-responsive">
            <table id="reportTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>Nomor Pendaftaran</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Spesialis</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Jam Kunjungan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($schedules)): ?>
                        <?php foreach ($schedules as $sched): 
                            $reg_id = sprintf('REG-%s-%04d', str_replace('-', '', $sched['tanggal_kunjungan']), $sched['id_pendaftaran']);
                            $v_date_display = date('d-m-Y', strtotime($sched['tanggal_kunjungan']));
                            $v_time = date('H:i', strtotime($sched['jam_kunjungan']));
                            
                            $status = $sched['status_pendaftaran'];
                            if ($status == 'Disetujui') {
                                $badge_class = 'badge-approved';
                            } elseif ($status == 'Ditolak') {
                                $badge_class = 'badge-rejected';
                            } else {
                                $badge_class = 'badge-pending';
                                $status = 'Pending';
                            }
                        ?>
                        <tr>
                            <td class="fw-semibold text-primary-custom"><?php echo $reg_id; ?></td>
                            <td><?php echo htmlspecialchars($sched['nama_pasien']); ?></td>
                            <td><?php echo htmlspecialchars($sched['nama_dokter']); ?></td>
                            <td><span class="badge bg-secondary text-white"><?php echo htmlspecialchars($sched['spesialis']); ?></span></td>
                            <td><?php echo $v_date_display; ?></td>
                            <td><?php echo $v_time; ?></td>
                            <td><span class="badge <?php echo $badge_class; ?>"><?php echo $status; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Vanilla JS Event Binding to avoid dependency load order issues -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Cetak Button click binding
    var printBtn = document.getElementById("btnPrintReport");
    if (printBtn) {
        printBtn.addEventListener("click", function(e) {
            e.preventDefault();
            window.print();
        });
    }

    // 2. Interactive Statistics Card Filter Binding
    var cards = document.querySelectorAll(".filter-card");
    cards.forEach(function(card) {
        card.addEventListener("click", function() {
            var filterVal = this.getAttribute("data-filter");
            var filterStatusInput = document.getElementById("filterStatus");
            if (filterStatusInput) {
                filterStatusInput.value = filterVal;
            }
            
            // Auto submit the form to reload with filtered status
            var form = document.querySelector(".card-body form");
            if (form) {
                form.submit();
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    // Initialize DataTable if not already done
    if (!$.fn.DataTable.isDataTable('#reportTable')) {
        $('#reportTable').DataTable({
            responsive: true,
            order: [[4, 'asc'], [5, 'asc']], // Sort by date and time by default
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
});
</script>
