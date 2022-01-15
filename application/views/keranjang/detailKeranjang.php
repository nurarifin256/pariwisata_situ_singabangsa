<br>
<div class="container mt-5">
    <h1 class="text-center">Keranjang Tiket</h1>

    <?php if ($tiket->num_rows() > 0) { ?>

        <form action="<?= base_url() ?>Pembayaran/tiket" method="post" id="keranjang_tiket">
            <div class="table-responsive mt-3">
                <table class="table table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pembeli</th>
                            <th scope="col">Nama Tiket</th>
                            <th scope="col">Tanggal Kedatangan</th>
                            <th scope="col" width="140px">Harga Tiket</th>
                            <th scope="col" width="100px">Jumlah</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        foreach ($tiket->result_array() as $t) :
                            @$total_all += ($t['jumlah'] * $t['harga']);

                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $t['nama_user'] ?></td>
                                <td><?= $t['nama_tiket'] ?></td>
                                <td>
                                    <input type="date" value="<?= $t['tanggal'] ?>" id="tanggal_d_<?= $no ?>" class="form-control" onchange="updateTanggal('<?= $no ?>')">
                                </td>

                                <td>
                                    <input type="text" id="harga_det_<?= $no ?>" value="<?= number_format($t['harga']) ?>" onkeyup="sum_total('<?= $no ?>')" readonly class="form-control-plaintext">
                                </td>

                                <input type="hidden" id="id_tiket_<?= $no ?>" value="<?= $t['id_tiket'] ?>">
                                <input type="hidden" id="id_keranjang_tiket_<?= $no ?>" value="<?= $t['id_keranjang_tiket'] ?>">

                                <td>
                                    <input id="jumlah_det_<?= $no ?>" name="jumlah_det" type="text" class="form-control" value="<?= $t['jumlah'] ?>" onkeypress="return hanyaAngka(event)" onkeyup="sum_total('<?= $no ?>')" onchange="updateJumlahTiket('<?= $no ?>'), validasiJumlah('<?= $no ?>')">
                                </td>

                                <td>
                                    <input type="text" name="total_bayar[]" id="total_bayar_<?= $no ?>" readonly class="form-control-plaintext total_bayar" value="<?= number_format($t['total_bayar']) ?>">
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-light tombol-hapus" onclick="hapus_keranjang_tiket('<?= $t['id_keranjang_tiket'] ?>', '<?= $t['id_tiket'] ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-secondary">
                            <td class="text-center" colspan="5">Total Bayar :</td>
                            <td class="text-right">Rp</td>
                            <td colspan="2"><input type="text" name="total_all" id="total_all" class="form-control-plaintext" value="<?= number_format(@$total_all); ?>"></td>
                        </tr>

                    </tbody>
                </table>

                <div class="text-right">
                    <a href="<?= base_url() ?>LandingPage/index" class="btn btn-success">Kembali</a>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
            </div>

        <?php } else { ?>
            <h5 class="text-center">Keranjang tiket anda masih kosong,<a href="<?= base_url() ?>LandingPage/index#wahana" class="ml-2 btn btn-md btn-outline-primary">Pesan Tiket <i class="fas fa-ticket-alt"></i></a></h5>
        <?php } ?>
        </form>

        <h1 class="text-center">Keranjang Cemilan</h1>

        <?php if ($cemilan->num_rows() > 0) { ?>

            <form action="<?= base_url() ?>Pembayaran/cemilan" method="post" id="keranjang_cemilan">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col">No</th>
                                <th scope="col">Nama Pembeli</th>
                                <th scope="col">Nama Cemilan</th>
                                <th width="180px" scope="col">Harga Cemilan</th>
                                <th width="100px" scope="col">Berat</th>
                                <th scope="col" width="100px">Jumlah</th>
                                <th width="180px" scope="col">Sub Total</th>
                                <th width="100px" scope="col">Sub Berat</th>
                                <th scope="col">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($cemilan->result_array() as $c) :
                                @$jumlah_totall += ($c['jumlah'] * $c['harga']);
                                @$jumlah_berat += ($c['jumlah'] * $c['berat']);
                                @$berat = ($c['jumlah'] * $c['berat'])
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $c['nama_user'] ?></td>
                                    <td><?= $c['nama_cemilan'] ?> <?= $c['variant'] ?></td>

                                    <td>
                                        <input type="text" id="harga_cem_<?= $no ?>" value="<?= number_format($c['harga']) ?>" readonly class="form-control-plaintext">
                                    </td>

                                    <input type="hidden" id="id_cemilan_<?= $no ?>" value="<?= $c['id_cemilan'] ?>">
                                    <input type="hidden" id="id_keranjang_cemilan_<?= $no ?>" value="<?= $c['id_keranjang_cemilan'] ?>">

                                    <td>
                                        <input type="text" id="berat_cem_<?= $no ?>" value="<?= $c['berat'] ?>" readonly class="form-control-plaintext">
                                    </td>

                                    <td>
                                        <input type="text" required name="jumlah" id="jumlah_cem_<?= $no ?>" class="form-control" value="<?= $c['jumlah'] ?>" onkeypress="return hanyaAngka(event)" onchange="updateJumlahCemilan('<?= $no ?>'), validasiJumlahCem('<?= $no ?>')" onkeyup="jumlah_total('<?= $no ?>'), jumlah_berat('<?= $no ?>');">
                                    </td>

                                    <td>
                                        <input type="text" name="total_bayarr[]" id="total_bayarr_<?= $no ?>" readonly class="form-control-plaintext total_bayarr" value="<?= number_format($c['total_bayar']) ?>">
                                    </td>

                                    <td>
                                        <input type="text" id="sub_berat_<?= $no ?>" name="sub_berat[]" readonly class="form-control-plaintext sub_berat" value="<?= @$berat ?>">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-light" onclick="hapus_keranjang_cemilan('<?= $c['id_keranjang_cemilan'] ?>', '<?= $c['id_cemilan'] ?>')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <script>

                </script>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="form-control" required id="provinsi" name="provinsi">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Kota/Kabupaten</label>
                                    <select class="form-control" required name="kota">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="provinsi">Ekspedisi</label>
                                    <select class="form-control" required id="provinsi" name="ekspedisi">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Jenis Pengiriman</label>
                                    <select class="form-control" name="jenis" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="provinsi">Alamat</label>
                                    <input type="text" class="form-control" required name="alamat" autocomplete="off" placeholder="Alamat lengkap, Desa, Kecamatan">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="">No HP</label>
                                    <input type="number" class="form-control" name="no_hp" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <ul class="list-group">

                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label for="jumlah_totall" class="col-form-label">Total Harga : Rp. </label>
                                    <div>
                                        <input type="text" readonly class="form-control-plaintext ml-2" value="<?= @$jumlah_totall ?>" id="jumlah_totall" name="jumlah_totall">
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label for="jumlah_beratt" class="col-form-label">Total Berat : </label>
                                    <div>
                                        <input type="text" readonly class="form-control-plaintext ml-2" value="<?= @$jumlah_berat; ?>" id="jumlah_beratt" name="jumlah_beratt">
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label for="ongkir" class="col-form-label">Ongkir : Rp. </label>
                                    <div>
                                        <input type="text" readonly class="form-control-plaintext ml-2" value="0" required id="ongkir" name="ongkir">
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label for="tot_bayar" class="col-form-label">Total Bayar : Rp. </label>
                                    <div>
                                        <input type="text" readonly class="form-control-plaintext ml-2" value="0" id="tot_bayar" name="tot_bayar">
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="text-right mt-3 mb-5">
                    <a href="<?= base_url() ?>LandingPage/cemilan" class="btn btn-success">Kembali</a>

                    <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
            <?php } else { ?>
                <h5 class="text-center">Keranjang cemilan anda masih kosong,<a href="<?= base_url() ?>LandingPage/cemilan" class="ml-2 btn btn-outline-primary">Yu Jajan <i class="fas fa-cookie"></i></a></h5>";
            <?php } ?>

            </form>


</div>