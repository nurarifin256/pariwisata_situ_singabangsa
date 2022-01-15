<br>
<div class="container mt-5">
    <?php if ($this->session->userdata('pesanan')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('pesanan') ?>">
            <?php
            $this->session->unset_userdata('pesanan');
            ?>
        </div>
    <?php } ?>

    <h1 class="text-center">Pesanan Tiket</h1>

    <form action="" method="post">
        <div class="table-responsive mt-3">
            <table class="table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">No Pesanan</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($tiket->result_array() as $t) :
                    ?>

                        <tr>
                            <td><?= $t['id_pesanan_tiket'] ?></td>
                            <td><?= $t['nama'] ?></td>
                            <td>Rp <?= number_format($t['jumlah_bayar']) ?></td>
                            <td><?= $t['STATUS_AKHIR'] ?></td>
                            <td>
                                <a href="<?= base_url() ?>Pesanan/detailTiket/<?= $t['id_pesanan_tiket'] ?>" class="btn btn-sm btn-warning mr-2 mt-1"><i class="fas fa-info-circle mr-1"></i>Detail</a>

                                <?php if ($t['status'] == 'sedang di proses' or $t['status'] == 'siap di gunakan') { ?>
                                    <a href="#" disabled class="btn btn-sm btn-light mt-1"><i class="fas fa-clipboard-check mr-1"></i>Sudah dikonfirmasi</a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Pesanan/konfirmasiTiket/<?= $t['id_pesanan_tiket'] ?>" class="btn btn-sm btn-primary mt-1"><i class="fas fa-clipboard-check mr-1"></i>Konfirmasi</a>
                                <?php } ?>


                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </form>

    <h1 class="text-center">Pesanan Cemilan</h1>

    <form action="" method="post">
        <div class="table-responsive mt-3">
            <table class="table table-hover">


                <?php
                foreach ($cemilan->result_array() as $c) :
                ?>

                    <tr class="mt-2 table-secondary">
                        <td>No Pesanan</td>
                        <td>:</td>
                        <td><?= $c['id_pesanan_cemilan'] ?></td>
                    </tr>
                    <tr>
                        <td>Penerima</td>
                        <td>:</td>
                        <td><?= $c['penerima'] ?></td>
                    </tr>
                    <tr>
                        <td>Batas Pembayaran</td>
                        <td>:</td>
                        <?php $bp = $c['tanggal_pesan'] + (60 * 60 * 24);
                        date_default_timezone_set('Asia/Jakarta') ?>
                        <td><?= date('d F Y', $bp) ?>, <?= date('G:i', $bp); ?> WIB</td>
                    </tr>
                    <tr>
                        <td>Kurir</td>
                        <td>:</td>
                        <td style="text-transform:uppercase"><?= $c['pengirim'] ?></td>
                    </tr>
                    <tr>
                        <td>Berat</td>
                        <td>:</td>
                        <td><?= $c['total_berat'] ?> gr</td>
                    </tr>
                    <tr>
                        <td>Ongkos Kirim</td>
                        <td>:</td>
                        <td>Rp <?= number_format($c['ongkir'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td>Total Harga Barang</td>
                        <td>:</td>
                        <td>Rp <?= number_format($c['total_bayar'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td>Total Bayar</td>
                        <td>:</td>
                        <td>Rp <?= number_format(($c['total_bayar'] + $c['ongkir']), 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td>Status / No Resi</td>
                        <td>:</td>
                        <td><?= $c['status'] ?> / <?= $c['no_resi'] ?></td>
                    </tr>
                    <tr class="mb-5">
                        <td colspan="3" class="text-right">
                            <a href="<?= base_url() ?>Pesanan/detailCemilan/<?= $c['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-warning mr-2 mt-1"><i class="fas fa-info-circle mr-1"></i>Detail</a>

                            <?php if ($c['status'] == 'sedang di proses' or $c['status'] == 'sedang di packing') { ?>
                                <a href="#" disabled class="btn btn-sm btn-light mt-1"><i class="fas fa-clipboard-check mr-1"></i>Sudah dikonfirmasi</a>
                            <?php } else if ($c['status'] == 'sedang di kirim') { ?>
                                <a href="<?= base_url() ?>Pesanan/cemilanDiTerima/<?= $c['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-success mt-1"><i class="fas fa-truck-loading mr-1"></i>Pesanan diterima</a>
                            <?php } else if ($c['status'] == 'Belum konfirmasi pembayaran') { ?>
                                <a href="<?= base_url() ?>Pesanan/konfirmasiCemilan/<?= $c['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-primary mt-1"><i class="fas fa-clipboard-check mr-1"></i>Konfirmasi</a>
                            <?php } ?>


                        </td>
                    </tr>

                <?php endforeach; ?>

            </table>
        </div>
    </form>


</div>