<div class="container-fluid">
<h2 class="h3 mb-4 text-gray-800">Edit Anggota</h2>

<div class="card shadow">
    <div class="card-body">

<form method="post" action="<?= site_url('anggota/update/'.$anggota->id); ?>">

    <div class="form-group">
        <label>No Anggota</label>
        <input type="text" name="no_anggota" class="form-control" 
        value="<?= $anggota->no_anggota; ?>" readonly>
    </div>

    <div class="form-group">
        <label>Nama Anggota</label>
        <input type="text" name="nama_anggota" class="form-control" 
        value="<?= $anggota->nama_anggota; ?>" required>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required><?= $anggota->alamat; ?></textarea>
    </div>

    <div class="form-group">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control" 
        value="<?= $anggota->telepon; ?>" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" 
        value="<?= $anggota->email; ?>" required>
    </div>

    <div class="form-group">
        <label>Tanggal Daftar</label>
        <input type="date" name="tanggal" class="form-control" 
        value="<?= $anggota->tanggal; ?>" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="Aktif" <?= $anggota->status == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="Nonaktif" <?= $anggota->status == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= site_url('anggota'); ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>
</div>