<br>
<div class="container mt-5 mb-5">
    <h3 class="text-center">Wahana</h3>
    <?php if ($this->session->userdata('wahana')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('wahana') ?>">
            <?php
            $this->session->unset_userdata('wahana');
            ?>
        </div>
    <?php } ?>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <a href="<?= base_url() ?>Wahana/tambahWahana" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus fa-sm"></i> Tambah Wahana</a>

            <!-- <button class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_acara">
                <i class="fas fa-plus fa-sm"></i>
                Tambah Acara
            </button> -->
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Nama</th>
                        <th style="width: 350px;">Keterangan</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th style="height: 30px; width:30px">Gambar</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tiket as $t) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $t['nama'] ?></td>
                            <td><?= $t['keterangan'] ?></td>
                            <td>Rp <?= number_format($t['harga'], 0, ',', '.') ?></td>
                            <td><?= $t['status'] ?></td>
                            <td>
                                <img src="<?= base_url() . 'assets/img/' . $t['foto'] ?>" class="img-thumbnail">
                            </td>
                            <td>
                                <a href="<?= base_url() ?>Wahana/editWahana/<?= $t['id_tiket'] ?>" class="btn btn-sm btn-warning mt-1">
                                    <i class="fas fa-pen-square"></i> Edit
                                </a>

                                <a onclick="hapusWahana('<?= $t['id_tiket'] ?>')" class="btn btn-sm btn-danger mt-1">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>

                                <?php if ($t['status'] == 'nonaktif') { ?>
                                    <a href="<?= base_url() ?>Wahana/aktifkanWahana/<?= $t['id_tiket'] ?>" class="btn btn-sm btn-success mt-1">
                                        <i class="fas fa-check"></i> Aktifkan
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Wahana/nonAktifkanWahana/<?= $t['id_tiket'] ?>" class="btn btn-sm btn-light mt-1">
                                        <i class="fas fa-times"></i> Non Aktifkan
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