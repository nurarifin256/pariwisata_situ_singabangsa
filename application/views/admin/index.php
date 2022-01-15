<br>
<div class="container mt-5">
    <h3 class="text-center">Daftar User Petugas</h3>

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <a href="<?= base_url() ?>Auth/registrasi" class="btn btn-sm btn-primary mb-2"><i class="fas fa-user-plus"></i> Tambah User</a>
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($user_pegawai as $up) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $up['nama'] ?></td>
                            <td><?= $up['email'] ?></td>
                            <td><?= $up['is_aktif'] ?></td>
                            <td>
                                <button type="button" class="btn btn-light" onclick="hapus_user_pegawai('<?= $up['id_user'] ?>')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>