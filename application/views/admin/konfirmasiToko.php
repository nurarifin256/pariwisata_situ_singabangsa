<br>
<div class="container mt-5">
    <h3 class="text-center">Konfirmasi Toko</h3>

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
                        <th>Nama Toko</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($konfirmasiTo as $kto) :
                        if ($kto['role_id'] == 4) {
                            $status = "Belum di approve";
                        } else {
                            $status = "Sudah di approve";
                        }
                    ?>

                        <tr>
                            <td><?= $kto['nama'] ?></td>
                            <td><?= $kto['email'] ?></td>
                            <td><?= $status ?></td>
                            <td>

                                <?php if ($status == 'Belum di approve') { ?>
                                    <a href="<?= base_url() ?>Admin/approveToko/<?= $kto['id_user'] ?>" class="btn btn-sm btn-primary mt-1">
                                        Approve <i class="fas fa-clipboard-check"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Admin/batalApproveToko/<?= $kto['id_user'] ?>" class="btn btn-sm btn-light mt-1">
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