<br>
<div class="container mt-5">
    <h3 class="text-center">Konfirmasi Cemilan</h3>

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
                        <th>Toko</th>
                        <th>Produk</th>
                        <th>Variant</th>
                        <th>Berat</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th style="height: 30px; width:30px">Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($konfirmasiC as $kc) : ?>
                        <tr>
                            <td><?= $kc['nama_user'] ?></td>
                            <td><?= $kc['nama_cemilan'] ?></td>
                            <td><?= $kc['variant'] ?></td>
                            <td><?= $kc['berat'] ?></td>
                            <td>Rp <?= number_format($kc['harga'], 0, ',', '.') ?></td>
                            <td><?= $kc['status'] ?></td>
                            <td>
                                <img src="<?= base_url() . 'assets/img/' . $kc['foto'] ?>" class="img-thumbnail">
                            </td>
                            <td>

                                <?php if ($kc["status"] == 'Menunggu persetujuan admin') { ?>
                                    <a href="<?= base_url() ?>Admin/approveCemilanToko/<?= $kc['id_cemilan'] . '/' . $kc['id_toko'] ?>" class="btn btn-sm btn-primary mt-1">
                                        Approve <i class="fas fa-clipboard-check"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Admin/batalApproveCemilanToko/<?= $kc['id_cemilan'] . '/' . $kc['id_toko'] ?>" class="btn btn-sm btn-light mt-1">
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