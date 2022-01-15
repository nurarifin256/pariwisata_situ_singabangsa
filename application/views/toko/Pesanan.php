<br>
<div class="container mt-5">
    <h3 class="text-center">Konfirmasi Pesanan</h3>

    <?php if ($this->session->userdata('pesan_cemilan')) { ?>
        <div class="flash-dataaa" data-flashdata="<?= $this->session->userdata('pesan_cemilan') ?>">
            <?php
            $this->session->unset_userdata('pesan_cemilan');
            ?>
        </div>
    <?php } ?>

    <?php if ($this->session->userdata('no_resi')) { ?>
        <div class="flash-dataaaa" data-flashdataa="<?= $this->session->userdata('no_resi') ?>">
            <?php
            $this->session->unset_userdata('no_resi');
            ?>
        </div>
    <?php } ?>

    <div class="row justify-content-center mt-3">
        <div class="col">
            <table id="example" class="display table table-hover">
                <thead>
                </thead>
                <tbody>
                    <?php
                    foreach ($konfirmasiC as $kc) : ?>

                        <tr class="table-secondary">
                            <td width="200px">No Pesanan</td>
                            <td width="20px">:</td>
                            <td class="mr-5" width="150px"><?= $kc['id_pesanan_cemilan'] ?></td>
                            <td width="150px"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nama Rekening</td>
                            <td>:</td>
                            <td><?= $kc['nama_rekening'] ?></td>

                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $kc['penerima'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Bank</td>
                            <td>:</td>
                            <td><?= $kc['nama_bank'] ?></td>


                            <td>Ekspedisi</td>
                            <td>:</td>
                            <td><?= $kc['pengirim'] ?></td>
                        </tr>
                        <tr>
                            <td>No Rekening</td>
                            <td>:</td>
                            <td><?= $kc['no_rek'] ?></td>


                            <td>Berat</td>
                            <td>:</td>
                            <td><?= $kc['total_berat'] ?> gr</td>
                        </tr>
                        <tr>
                            <td>Status / No Resi</td>
                            <td>:</td>
                            <td><?= $kc['statusPesanan'] ?> / <?= $kc['no_resi'] ?></td>

                            <td>Ongkir</td>
                            <td>:</td>
                            <td>Rp <?= number_format($kc['ongkir'], 0, ',', '.') ?></td>

                        </tr>
                        <tr>
                            <td>Bukti Pembayaran</td>
                            <td>:</td>
                            <td>
                                <img style="height: 100px; width:100px;" src="<?= base_url() . 'assets/img/bukti/' . $kc['gambar'] ?>" class="img-thumbnail">
                            </td>

                            <td>Total Bayar</td>
                            <td>:</td>
                            <td>Rp <?= number_format(($kc['total_bayar'] + $kc['ongkir']), 0, ',', '.') ?></td>
                        </tr>

                        <tr class="mb-5">
                            <td colspan="6" class="text-right">
                                <a href="<?= base_url() ?>Toko2/detailPesananCemilan/<?= $kc['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-warning mr-2 mt-1"><i class="fas fa-info-circle mr-1"></i>Detail</a>

                                <?php if ($kc['statusPesanan'] == 'sedang di packing') { ?>
                                    <a href="<?= base_url() ?>Toko2/inputResi/<?= $kc['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-success mr-2 mt-1"><i class="fas fa-pen-square"></i> Input No. Resi</a>
                                <?php } else if ($kc['statusPesanan'] == 'sedang di kirim' or $kc['statusPesanan'] == 'sudah di terima') { ?>
                                    <a href="<?= base_url() ?>Toko2/editResi/<?= $kc['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-success mr-2 mt-1"><i class="fas fa-pen-square"></i> Edit No. Resi</a>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-sm btn-light mr-2 mt-1"><i class="fas fa-pen-square"></i> Input No. Resi</a>
                                <?php } ?>

                                <?php if ($kc['statusPesanan'] == 'sedang di packing' or $kc['statusPesanan'] == 'sedang di kirim' or $kc['statusPesanan'] == 'sudah di terima') { ?>
                                    <a href="<?= base_url() ?>Toko2/batalApproveCemilan/<?= $kc['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-light mt-1"><i class="fas fa-times"></i> Batalkan Approve</a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Toko2/approveCemilan/<?= $kc['id_pesanan_cemilan'] ?>" class="btn btn-sm btn-primary mt-1"><i class="fas fa-clipboard-check mr-1"></i> Approve</a>
                                <?php } ?>


                            </td>
                        </tr>

                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>