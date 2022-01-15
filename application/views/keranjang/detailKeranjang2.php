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
                            <th scope="col" width="165px">Jam</th>
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
                                    <input type="date" value="<?= $t['tanggal'] ?>" id="tanggal_d_<?= $no ?>" onclick="validasiTanggal('<?= $no ?>')" class="form-control" onchange="updateTanggal('<?= $no ?>')">
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
                                        <option value="15:00 - 16:00">16:00 - 17:00</option>
                                        <option value="16:00 - 17:00">16:00 - 17:00</option>
                                    </select>
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
                            <td class="text-center" colspan="6">Total Bayar :</td>
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
        </form>
    <?php } else { ?>
        <h5 class="text-center">Keranjang tiket anda masih kosong,<a href="<?= base_url() ?>LandingPage/index#wahana" class="ml-2 btn btn-md btn-outline-primary">Pesan Tiket <i class="fas fa-ticket-alt"></i></a></h5>
    <?php } ?>

    <h1 class="text-center">Keranjang Cemilan</h1>

    <?php if ($cemilan->num_rows() > 0) { ?>

        <table id="example" class="display table table-hover">
            <thead>
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Nama Toko</th>
                    <th>Jumlah Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                foreach ($cemilan->result_array() as $c) :
                    $id_toko = $c['id_toko'];
                    $jumlah_cemilan = $this->db->query("SELECT SUM(A.jumlah) jumlah_cemilan FROM keranjang_cemilan A INNER JOIN cemilan B ON B.id_cemilan=A.id_cemilan WHERE B.id_toko=$id_toko AND A.status=1")->row();
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $c['nama_toko'] ?></td>
                        <td><?= $jumlah_cemilan->jumlah_cemilan ?></td>

                        <td>
                            <a href="<?= base_url() ?>Keranjang/detailKeranjangCemilan/<?= $c['id_toko'] ?>" class="btn btn-sm btn-warning mt-1">
                                <i class="fas fa-info-circle mr-1"></i> Detail
                            </a>

                            <a onclick="hapusPesananByToko('<?= $c['id_toko'] ?>')" class="btn btn-sm btn-danger mt-1">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <div class="text-right mt-3 mb-5">
            <a href="<?= base_url() ?>LandingPage/cemilan" class="btn btn-success">Kembali</a>
        </div>

    <?php } else { ?>
        <h5 class="text-center">Keranjang cemilan anda masih kosong,<a href="<?= base_url() ?>LandingPage/cemilan" class="ml-2 btn btn-outline-primary">Yu Jajan <i class="fas fa-cookie"></i></a></h5>";
    <?php } ?>
</div>