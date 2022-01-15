<br>
<div class="container mt-5">
    <h1 class="text-center">Detail Keranjang Cemilan</h1>

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
                    $id_toko = $this->uri->segment(3); ?>
                    <input type="hidden" name="id_toko" value="<?= $id_toko ?>">

                    <?php $no = 1;
                    foreach ($cemilan as $c) :
                        @$jumlah_totall += ($c['jumlah'] * $c['harga']);
                        @$jumlah_berat += ($c['jumlah'] * $c['berat']);
                        @$berat = ($c['jumlah'] * $c['berat'])
                    ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $c['nama_pembeli'] ?></td>
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
            <a href="<?= base_url() ?>Keranjang/detailKeranjang" class="btn btn-success">Kembali</a>

            <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
    </form>
</div>