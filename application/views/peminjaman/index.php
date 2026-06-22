<div class="container-fluid">

<h2 class="h3 mb-4 text-gray-800">Data Peminjaman</h2>

<a href="<?= site_url('peminjaman/tambah'); ?>" class="btn btn-primary mb-3">Tambah</a>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">

<table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php $no=1; foreach($peminjaman as $p): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p->kode_peminjaman; ?></td>
            <td><?= $p->nama_anggota; ?></td>
            <td><?= $p->tanggal_pinjam; ?></td>
            <td><?= $p->status; ?></td>
            <td>
                <?php
                $today = date('Y-m-d');

                $selisih = strtotime($today) - strtotime($p->tanggal_jatuh_tempo);

                $terlambat = $selisih > 0
                ? floor($selisih / 86000)
                :0;
                ?>

                <?php if($p->status == 'dipinjam'): ?>
                    <a href="<?= site_url('peminjaman/kembali/'.$p->id); ?>" 
                       class="btn btn-success btn-sm"
                       onclick="return confirm('Yakin dikembalikan?')">
                       Kembalikan
                    </a>

                    <!----Tombol WA----->
                    <a href="<?= site_url('whatsapp/kirim_notifikasi/'.$p->id);?>"
                    class="btn btn-warning btn-sm">

                    <i class="fab fa-whatsapp"></i>
                    Kirim Wa
                </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

</table>

        </div>
    </div>
</div>
</div>