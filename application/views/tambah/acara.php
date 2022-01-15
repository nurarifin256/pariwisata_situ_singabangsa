<br>
<div class="container mt-5">
    <h3 class="text-center">Acara</h3>

    <?php if ($this->session->userdata('acara')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('acara') ?>">
            <?php
            $this->session->unset_userdata('acara');
            ?>
        </div>
    <?php } ?>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <a href="<?= base_url() ?>Tambah/tambahAcara" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus fa-sm"></i> Tambah Acara</a>

            <!-- <button class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambah_acara">
                <i class="fas fa-plus fa-sm"></i>
                Tambah Acara
            </button> -->
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th style="height: 30px; width:30px">Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($acara as $a) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $a['nama'] ?></td>
                            <td><?= $a['keterangan'] ?></td>
                            <td><?= $a['status'] ?></td>
                            <td>
                                <img src="<?= base_url() . 'assets/img/acara/' . $a['gambar'] ?>" class="img-thumbnail">
                            </td>
                            <td>
                                <a href="<?= base_url() ?>Tambah/editAcara/<?= $a['id_acara'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen-square"></i> Edit
                                </a>

                                <a onclick="hapusAcara('<?= $a['id_acara'] ?>')" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>

                                <?php if ($a['status'] == 0) { ?>
                                    <a href="<?= base_url() ?>Tambah/aktifkanAcara/<?= $a['id_acara'] ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Aktifkan
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Tambah/nonAktifkanAcara/<?= $a['id_acara'] ?>" class="btn btn-sm btn-light">
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

<div class="modal fade" id="tambah_acara" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('Tambah/tambahAcara'); ?>
                <div class="form-group">
                    <label for="nama">Nama Acara</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="<?= set_value('nama') ?>" autofocus>
                    <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea rows="5" id="keterangan" class="form-control" name="keterangan" value="<?= set_value('keterangan') ?>"></textarea>
                    <?= form_error('keterangan', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="form-group">
                    <label for="">Gambar</label>
                    <div>
                        <img src="<?= base_url() ?>assets/img/default.png" alt="" class="img-thumbnail img-preview">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="sampul" required name="gambar" onchange="previewImg()" required>
                        <label class="custom-file-label" for="sampul">pilih gambar</label>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
</div>