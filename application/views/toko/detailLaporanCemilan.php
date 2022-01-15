<br>
<div class="container mt-5">
    <h3 class="text-center">Detail Laporan Cemilan</h3>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No Pesanan</th>
                        <th>Pembeli</th>
                        <th>Jumlah Cemilan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($laporan as $l) :
                    ?>
                        <tr>
                            <td><?= $l['no_pesanan'] ?></td>
                            <td><?= $l['penerima'] ?></td>
                            <td><?= $l['jumlah_cemilan'] ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <a href="<?= base_url() ?>Toko2/laporanCemilan" class="btn btn-success">Kembali</a>
        </div>
    </div>
</div>