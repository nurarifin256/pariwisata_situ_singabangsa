<br>
<div class="container mt-5">
    <h3 class="text-center">Laporan Cemilan</h3>
    <form action="<?= base_url() ?>Laporann" autocomplete="off" method="post">
        <input type="hidden" name="tgl1" value="<?php echo $tgl1 ?>" readonly>
        <input type="hidden" name="tgl2" value="<?php echo $tgl2 ?>" readonly>
        <input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user') ?>" readonly>
        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-print"></i> Print</button>
    </form>

    <div id="print_id">
        <div class="row justify-content-center mt-3">
            <div class="col">
                <table id="example" class="display table table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Cemilan</th>
                            <th>Harga Cemilan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($laporan as $l) :
                            @$jumlah_bayaran = $l['jumlah_cemilan'] * $l['harga_cemilan'];
                            @$total_all += $jumlah_bayaran;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $l['nama_cemilan'] ?> <?= $l['variant'] ?></td>
                                <td><?= $l['jumlah_cemilan'] ?></td>
                                <td>Rp <?= number_format($l['harga_cemilan']) ?></td>
                                <td>Rp <?= number_format(@$jumlah_bayaran) ?></td>
                                <td>
                                    <a href="<?= base_url() ?>Toko2/detailLaporanCemilan/<?= $l['id_cemilan'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-info-circle mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                    <tr>
                        <td class="text-center" colspan="4">Total</td>
                        <td colspan="2">Rp <?= number_format(@$total_all) ?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>