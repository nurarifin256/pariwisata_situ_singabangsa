<br>
<div class="container mt-5">
    <h3 class="text-center">Detail Tiket Pengunjung</h3>


    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Nama Wahana</th>
                        <th scope="col">Tanggal Kedatangan</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Jumlah Tiket</th>
                        <th scope="col">Status</th>
                        <th scope="col">Validator</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($tiket as $t) :
                    ?>

                        <tr>
                            <td><?= $t['nama_tiket'] ?></td>
                            <td><?= $t['tanggal_kedatangan'] ?></td>
                            <td><?= $t['jam'] ?> WIB</td>
                            <td><?= $t['jumlah'] ?></td>
                            <td><?= $t['status_detail_pesanan_tiket'] ?></td>
                            <td>Petugas : <?= $t['validator'] ?></td>
                            <td>
                                <?php if ($t['status_detail_pesanan_tiket'] == 'Belum digunakan') { ?>
                                    <a href="<?= base_url() ?>Petugas/gunakanTiket/<?= $t['id_detail_pesanan_tiket'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check-circle"></i> Gunakan tiket
                                    </a>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-sm btn-light" disabled>
                                        Tiket sudah digunakan
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                    <tr class="table-secondary">
                        <td colspan="7" class="text-right">
                            <a href="<?= base_url() ?>Petugas" class="btn btn-success mr-2 mt-1"><i class="fas fa-long-arrow-alt-left mr-2"></i>Kembali</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>