<br>
<div class="container mt-5">
    <h3 class="text-center">Daftar Pengunjung</h3>

    <?php if ($this->session->userdata('update_tiket')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('update_tiket') ?>">
            <?php
            $this->session->unset_userdata('update_tiket');
            ?>
        </div>
    <?php } ?>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No Pesanan</th>
                        <th>Nama Pengunjung</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($konfirmasiT as $kt) : ?>

                        <tr>
                            <td><?= $kt['id_pesanan_tiket'] ?></td>
                            <td><?= $kt['nama'] ?></td>
                            <td><?= $kt['STATUS_AKHIR'] ?></td>
                            <td>
                                <a href="<?= base_url() ?>Petugas/detailPesananTiket/<?= $kt['id_pesanan_tiket'] ?>" class="btn btn-sm btn-warning">
                                    Detail <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>