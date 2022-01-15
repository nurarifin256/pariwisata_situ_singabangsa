<br>
<div class="container mt-5">
    <h3 class="text-center">Konfirmasi Tiket</h3>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal Kedatangan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($tiket as $t) :
                        $sub_total = $t['harga'] * $t['jumlah'];
                    ?>

                        <tr>
                            <td><?= $t['nama'] ?></td>
                            <td><?= $t['tanggal_kedatangan'] ?></td>
                            <td>Rp <?= number_format($t['harga'], 0, ',', '.') ?></td>
                            <td><?= $t['jumlah'] ?></td>
                            <td>Rp <?= number_format($sub_total, 0, ',', '.') ?></td>
                            <td><?= $t['status_detail_pesanan_tiket'] ?></td>
                            <td>
                                <?php if ($t['status_detail_pesanan_tiket'] == 'siap di gunakan') { ?>
                                    <a href="<?= base_url() ?>Petugas/gunakanTikett/<?= $t['id_detail_pesanan_tiket'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check-circle"></i> Gunakan tiket
                                    </a>
                                <?php } else if ($t['status_detail_pesanan_tiket'] == 'Belum digunakan') { ?>
                                    <a href="#" class="btn btn-sm btn-light">
                                        Gunakan tiket
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Petugas/batalGunakanTiket/<?= $t['id_detail_pesanan_tiket'] ?>" class="btn btn-sm btn-light">
                                        <i class="fas fa-times"></i> Batal gunakan tiket
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                    <tr class="table-secondary">
                        <td colspan="4" class="text-center">Total Bayar</td>
                        <td>Rp <?= number_format($t['jumlah_bayar'], 0, ',', '.') ?></td>
                        <td colspan="2" class="text-right">
                            <a href="<?= base_url() ?>Admin/konfirmasiTiket" class="btn btn-success mr-2 mt-1"><i class="fas fa-long-arrow-alt-left mr-2"></i>Kembali</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>