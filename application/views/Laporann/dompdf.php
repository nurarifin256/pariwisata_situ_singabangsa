<!-- favicon -->
<link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.png">

<title>Laporan Cemilan</title>

<style>
    .line-title {
        border: 0;
        border-style: inset;
        border-top: 1px solid #000;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529
    }

    .table-bordered {
        border: 1px solid #dee2e6
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6
    }

    td {
        text-align: center;
    }

    td.tgl {
        text-align: left;
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 2px
    }
</style>

<img src="assets/img/favicon.jpg" style="position: absolute; width: 60px; height: auto;">
<table style="width: 100%;">
    <tr>
        <td align="center">
            <span style="line-height: 1.6; font-weight: bold;">
                WISATA SITU SINGABANGSA
                <br>TENJO - BOGOR
            </span>
        </td>
    </tr>
</table>

<hr class="line-title">
<p align="center">
    LAPORAN PENDAPATAN CEMILAN <br>
</p>
<table>
    <tr>
        <td style="text-align: left;">Dari Tanggal</td>
        <td>:</td>
        <td class="tgl"><?= $tgl1 ?></td>
    </tr>
    <tr>
        <td>Sampai Tanggal</td>
        <td>:</td>
        <td class="tgl"><?= $tgl2 ?> <br></td>
    </tr>
</table>
<br>
<table cellspacing="0" class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Harga Cemilan</th>
        <th>Jumlah</th>
    </tr>
    <?php $no = 1;
    foreach ($data as $row) :
        @$jumlah_bayaran = $row['jumlah_cemilan'] * $row['harga_cemilan'];
        @$grand_total += @$jumlah_bayaran;
    ?>

        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $row['nama_cemilan'] ?> <?php echo $row['variant'] ?></td>
            <td><?php echo $row['jumlah_cemilan'] ?></td>
            <td style="text-align: left;">Rp <?php echo number_format($row['harga_cemilan']) ?></td>
            <td style="text-align: left;">Rp <?php echo number_format(@$jumlah_bayaran) ?></td>
        </tr>
    <?php endforeach ?>
    <tr>
        <td style="text-align: center;" colspan="4">Total</td>
        <td style="text-align: left;">Rp <?php echo number_format(@$grand_total) ?></td>
    </tr>
</table>