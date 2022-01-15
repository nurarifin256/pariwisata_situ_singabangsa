<br>
<div class="container mt-5 mb-5">
    <h3 class="text-center">Cemilan</h3>

    <?php if ($this->session->userdata('cemilan')) { ?>
        <div class="flash-dataa" data-flashdata="<?= $this->session->userdata('cemilan') ?>">
            <?php
            $this->session->unset_userdata('cemilan');
            ?>
        </div>
    <?php } ?>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <a href="<?= base_url() ?>Toko2/tambahCemilan" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus fa-sm"></i> Tambah Cemilan</a>

            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Variant</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Status</th>
                        <th style="height: 30px; width:30px">Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($cemilan as $c) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $c['nama_cemilan'] ?></td>
                            <td><?= $c['variant'] ?></td>
                            <td><?= $c['keterangan'] ?></td>
                            <td>Rp <?= number_format($c['harga'], 0, ',', '.') ?></td>
                            <td><?= $c['berat'] ?> gr</td>
                            <td><?= $c['status'] ?></td>
                            <td>
                                <img src="<?= base_url() . 'assets/img/' . $c['foto'] ?>" class="img-thumbnail">
                            </td>
                            <td>
                                <a href="<?= base_url() ?>Toko2/editCemilan/<?= $c['id_cemilan'] . '/' . $c['id_toko'] ?>" class="btn btn-sm btn-warning mt-1">
                                    <i class="fas fa-pen-square"></i> Edit
                                </a>

                                <a onclick="hapusCemilan('<?= $c['id_cemilan'] ?>')" class="btn btn-sm btn-danger mt-1">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>