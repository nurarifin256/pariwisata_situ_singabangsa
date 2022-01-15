<br>
<div class="container mt-5">
    <h1 class="text-center">Detail Pesanan Cemilan</h1>

    <form action="" method="post">
        <div class="table-responsive mt-3">
            <table class="table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Sub Berat</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($cemilan as $c) :
                        $sub_total = $c['harga'] * $c['jumlah'];
                        $sub_berat = $c['berat'] * $c['jumlah'];
                    ?>

                        <tr>
                            <td><?= $c['nama'] ?> <?= $c['variant'] ?></td>
                            <td>Rp <?= number_format($c['harga'], 0, ',', '.') ?></td>
                            <td><?= $c['jumlah'] ?></td>
                            <td><?= $c['berat'] ?></td>
                            <td><?= $sub_berat ?> gr</td>
                            <td>Rp <?= number_format($sub_total, 0, ',', '.') ?></td>
                        </tr>


                    <?php endforeach; ?>
                    <tr class="table-secondary">
                        <td colspan="4" class="text-center">Total</td>
                        <td><?= $c['total_berat'] ?> gr</td>
                        <td>Rp <?= number_format($c['total_bayar'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">
                            <a href="<?= base_url() ?>Pesanan" class="btn btn-success mr-2 mt-1"><i class="fas fa-long-arrow-alt-left mr-2"></i>Kembali</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </form>
</div>