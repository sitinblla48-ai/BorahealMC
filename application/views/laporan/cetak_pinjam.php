<!DOCTYPE html>
<html>
    <head>
        <title>Cetak Laporan</title>
        <style>
            body{font-family: Arial;}
            h3{text-align: center;}
            table{
                width:100%;
                border-collapse:collapse;
            }
            table, th, td{
                border: 1px solid black;
            }
            th, td{
                padding:8px;
                text-align: center;
            }

            @media print{
                button {display: none;}
            }
            </style>
        </head>
</body>
            <h3>LAPORAN PEMINJAMAN</h3>

            <?php if($bulan):?>
                <p>Bulan : <?= $bulan; ?></p>
                <?php endif;?>

    <table>
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>
     <?php $no=1; foreach($data as $p): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p->kode_peminjaman; ?></td>
            <td><?= $p->nama_anggota; ?></td>
            <td><?= $p->tanggal_pinjam; ?></td>
            <td><?= $p->status; ?></td>
     </tr>
     <?php endforeach;?>
     </table>

     <br><br>

     <p style="text-align:right;">
        Tangerang, <?=date('d-m-y');?><br><br><br>
        (Admin)
    </p>

    <script>
        window.print();
        </script>
        </body>
        </html>

