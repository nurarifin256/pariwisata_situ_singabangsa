<br>
<div class="container mt-5">
    <h3 class="text-center">Pesan Customer</h3>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>No WA</th>
                        <th>Tanggal</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pesan as $p) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['no_tlp'] ?></td>
                            <td><?= $p['tanggal'] ?></td>
                            <td><?= $p['pesan'] ?></td>
                            <td>
                                <a onclick="hapusPesan('<?= $p['id_pesan'] ?>')" class="btn btn-sm btn-danger">
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