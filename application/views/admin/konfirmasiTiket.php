<br>
<div class="container mt-5">
    <h3 class="text-center">Konfirmasi Tiket</h3>

    <?php if ($this->session->userdata('approve')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('approve') ?>">
            <?php
            $this->session->unset_userdata('approve');
            ?>
        </div>
    <?php } ?>


    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No Pesanan</th>
                        <th>Nama Rekening</th>
                        <th>No Rekening</th>
                        <th>Bank</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th style="height: 30px; width:30px">Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($konfirmasiT as $kt) : ?>

                        <tr>
                            <td><?= $kt['id_pesanan_tiket'] ?></td>
                            <td><?= $kt['nama_rekening'] ?></td>
                            <td><?= $kt['no_rekening'] ?></td>
                            <td><?= $kt['nama_bank'] ?></td>
                            <td>Rp <?= number_format($kt['jumlah_bayar'], 0, ',', '.') ?></td>
                            <td><?= $kt['status_pesanan'] ?></td>
                            <td>
                                <img src="<?= base_url() . 'assets/img/bukti/' . $kt['gambar'] ?>" class="img-thumbnail">
                            </td>
                            <td>
                                <a href="<?= base_url() ?>Admin/detailPesananTiket/<?= $kt['id_pesanan_tiket'] ?>" class="btn btn-sm btn-warning mt-1">
                                    Detail <i class="fas fa-info-circle"></i>
                                </a>

                                <?php if ($kt['status_pesanan'] == 'sedang di proses') { ?>
                                    <a href="<?= base_url() ?>Admin/approveTiket/<?= $kt['id_pesanan_tiket'] ?>" class="btn btn-sm btn-primary mt-1">
                                        Approve <i class="fas fa-clipboard-check"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Admin/batalApproveTiket/<?= $kt['id_pesanan_tiket'] ?>" class="btn btn-sm btn-light mt-1">
                                        Batalkan approve <i class="fas fa-times"></i>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>