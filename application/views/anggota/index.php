<div class="container-fluid">

<h2 class="h3 mb-4 text-gray-800">Data Anggota</h2>

<a href="<?= site_url('anggota/tambah'); ?>" class="btn btn-primary mb-3">Tambah</a>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">

<table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
    <thead>
    <tr>
        <th>No</th>
        <th>No Anggota</th>
        <th>Nama Anggota</th>
        <th>Telepon</th>
        <th>Email</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>

<tbody>
    <?php $no=1; foreach($anggota as $k): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $k->no_anggota; ?></td>
            <td><?= $k->nama_anggota; ?></td>
            <td><?= $k->telepon; ?></td>
            <td><?= $k->email; ?></td>
            <td><?= $k->status; ?></td>
            <td>
                <a href="<?= site_url("anggota/edit/".$k->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= site_url("anggota/hapus/".$k->id); ?>"
                onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

</table>

        </div>
    </div>
</div>
</div>