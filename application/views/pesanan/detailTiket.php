<br>
<div class="container mt-5">
    <h1 class="text-center">Detail Pesanan Tiket</h1>

    <form action="" method="post" id="pesanan_tiket">
        <div class="table-responsive mt-3">
            <table class="table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col" width="10px">No</th>
                        <th scope="col" width="100px">Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" width="165px">Jam</th>
                        <th scope="col" width="100px">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col" width="100px">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Validator</th>
                        <th scope="col">Tiket</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $no = 1;
                    foreach ($tiket as $t) :
                        $sub_total = $t['harga'] * $t['jumlah'];
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $t['nama_tiket'] ?></td>

                            <input type="hidden" id="id_tiket_<?= $no ?>" value="<?= $t['id_tiket'] ?>">
                            <input type="hidden" id="id_detail_pesanan_tiket_<?= $no ?>" value="<?= $t['id_detail_pesanan_tiket'] ?>">

                            <td>
                                <input type="date" class="form-control" id="tanggal_ked_<?= $no ?>" value="<?= $t['tanggal_kedatangan'] ?>" onchange="updateTanggal('<?= $no ?>')">
                            </td>
                            <td>
                                <select class="form-control" name="jam" id="jam_<?= $no ?>" onchange="updateJam('<?= $no ?>')" required>
                                    <option value="<?= $t['jam'] ?>"><?= $t['jam'] ?></option>
                                    <option value="08:00 - 09:00">08:00 - 09:00</option>
                                    <option value="09:00 - 10:00">09:00 - 10:00</option>
                                    <option value="10:00 - 11:00">10:00 - 11:00</option>
                                    <option value="11:00 - 12:00">11:00 - 12:00</option>
                                    <option value="12:00 - 13:00">12:00 - 13:00</option>
                                    <option value="13:00 - 14:00">13:00 - 14:00</option>
                                    <option value="14:00 - 15:00">14:00 - 15:00</option>
                                    <option value="15:00 - 16:00">15:00 - 16:00</option>
                                    <option value="16:00 - 17:00">16:00 - 17:00</option>
                                </select>
                            </td>
                            <td>Rp <?= number_format($t['harga'], 0, ',', '.') ?></td>
                            <td><?= $t['jumlah'] ?></td>
                            <td>Rp <?= number_format($sub_total, 0, ',', '.') ?></td>
                            <td><?= $t['status_detail_pesanan_tiket'] ?></td>
                            <td>Petugas : <?= $t['validator'] ?></td>
                            <td>
                                <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-ticket-alt"></i>
                                </button> -->

                                <a href="#" class="e-tiket btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-nama="<?= $t['nama_tiket'] ?>" data-nama-pembeli="<?= $t['nama_pembeli'] ?>" data-jumlah="<?= $t['jumlah'] ?>" data-foto="<?= $t['foto'] ?>" data-tanggal="<?= $t['tanggal_kedatangan'] ?>" data-jam="<?= $t['jam'] ?>" data-status="<?= $t['status_detail_pesanan_tiket'] ?>"><i class="fas fa-ticket-alt"></i></a>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                    <tr class="table-secondary">
                        <td colspan="6" class="text-center">Grand Total Bayar</td>
                        <td colspan="2">Rp <?= number_format($t['jumlah_bayar'], 0, ',', '.') ?></td>
                        <td colspan="2" class="text-right">
                            <a href="<?= base_url() ?>Pesanan" class="btn btn-success mr-2 mt-1"><i class="fas fa-long-arrow-alt-left mr-2"></i>Kembali</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </form>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">E-Tiket</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="offset-md-2 col-md-8">
                            <h2>
                                <label for="" class="nama"></label>
                            </h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            Pengunjung : <br>
                            <h5>
                                <label for="" class="nama_pembeli"></label>
                            </h5> <br>
                            Jumlah Tiket: <br>
                            <h5>
                                <label for="" class="jumlah"></label>
                            </h5>
                        </div>

                        <div class="col-md-7">
                            <img class="img-thumbnail" src="" id="pict">
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-6">
                            Tanggal Kedatangan : <br>
                            <h5>
                                <label for="" class="tanggal"></label>
                            </h5>
                        </div>
                        <div class="col-6">
                            Jam Kedatangan : <br>
                            <h5>
                                <label for="" class="jam"></label>
                            </h5>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="offset-md-2 col-md-8">
                            Status : <br>
                            <h5>
                                <label for="" class="status"></label>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>