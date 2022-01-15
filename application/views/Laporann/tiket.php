<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.png">

    <title>Laporan Tiket</title>

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
</head>

<body>
    <!-- <img src="<//?php echo $_SERVER["DOCUMENT_ROOT"] . '/placeholder.jpg'; ?>" />
    <img src="<//?php echo $_SERVER["DOCUMENT_ROOT"] . '\placeholder.jpg'; ?>" />
    <img src="<//?php echo $_SERVER["DOCUMENT_ROOT"] . './placeholder.jpg'; ?>" /> -->

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
        LAPORAN PENDAPATAN TIKET <br>
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
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Approve</th>
                <th>Jumlah Tiket</th>
                <th>Harga Tiket</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data as $row) :
                @$jumlah_bayaran = $row['Jumlahtiket'] * $row['harga_tiket'];
                @$grand_total += @$jumlah_bayaran;
            ?>


                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nama_tiket'] ?></td>
                    <td><?php echo $row['tanggalApprove'] ?></td>
                    <td><?php echo $row['Jumlahtiket'] ?></td>
                    <td style="text-align: right;"><?php echo number_format($row['harga_tiket']) ?></td>
                    <td style="text-align: right;"><?php echo number_format(@$jumlah_bayaran) ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="5">Total</td>
                    <td style="text-align: right;"><?= number_format(@$grand_total) ?></td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>


</body>

</html>