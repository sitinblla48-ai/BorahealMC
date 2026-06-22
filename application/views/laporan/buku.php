<div class="container-fluid">

    <h3>Laporan Data Buku</h3>

    <form method="get">

        <select name="kategori" class="form-control-sm">

            <option value="">-- Semua Kategori --</option>

            <?php foreach($kategori as $b): ?>

                <option value="<?= $b->id; ?>">
                    <?= $b->nama_kategori; ?>
                </option>

            <?php endforeach; ?>

        </select>
        
        <button type="submit" class="btn btn-primary btn-sm">
            Filter
        </button>

        <a href="<?= site_url('laporan/buku');?>"
        class="btn btn-secondary btn-sm">
        Reset
        </a>

    </form>

    <br>
    <a href="<?= site_url('buku/cetak_buku?kategori='.$kategori_terpilih); ?>"
target="_blank" class="btn btn-success btn-sm">
    Cetak PDF
</a>
   
    <table class="table table-bordered mt-3">

        <tr>
            <th>No</th>
            <th>Kode Buku</th>
            <th>Judul Buku</th>
            <th>Kategori</th>
            <th>Stok</th>
        </tr>

        <?php $no = 1; foreach($buku as $b): ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $b->kode_buku; ?></td>
            <td><?= $b->judul_buku; ?></td>
            <td><?= $b->nama_kategori; ?></td>
            <td><?= $b->stok; ?></td>
        </tr>

        <?php endforeach; ?>

    </table>

</div>