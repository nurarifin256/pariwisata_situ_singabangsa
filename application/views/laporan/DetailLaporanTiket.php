<br>
<div class="container mt-5">
    <h3 class="text-center">Detail Laporan Tiket</h3>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No Pesanan</th>
                        <th>Nama Pengunjung</th>
                        <th>Tanggal Kedatangan</th>
                        <th>Jumlah Tiket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($laporan as $l) :
                    ?>
                        <tr>
                            <td><?= $l['no_pesanan'] ?></td>
                            <td><?= $l['nama_pengunjung'] ?></td>
                            <td><?= $l['tanggal_datang'] ?></td>
                            <td><?= $l['jumlah_tiket'] ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <a href="<?= base_url() ?>Laporan/laporanTiket" class="btn btn-success">Kembali</a>
        </div>
    </div>
</div>