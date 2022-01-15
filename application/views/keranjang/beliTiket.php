<br>
<div class="container mt-5">


    <h1 class="text-center">Pesan Tiket <?= $tiket['nama'] ?></h1>

    <div class="row justify-content-center  mt-3">
        <div class="col-md-6">
            <div class="card">
                <form method="POST" action="<?= base_url() ?>Keranjang/bayarTiket">

                    <input type="hidden" name="id_tiket" value="<?= $tiket['id_tiket'] ?>">

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td>Tanggal Kedatangan</td>
                                <td>:</td>
                                <td><input type="date" class="form-control" name="tanggal" id="txtDate" onclick="validasiTanggal()" required></td>
                            </tr>
                            <tr>
                                <td>Jam</td>
                                <td>:</td>
                                <td>
                                    <select class="form-control" name="jam" required>
                                        <option value="">Pilih Jam</option>
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
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td>Rp <?= number_format($tiket['harga'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>:</td>
                                <td><input name="jumlah" id="jumlah" type="number" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Total Bayar</td>
                                <td>:</td>
                                <td><input name="total_bayar" id="total_bayar" value="<?= number_format(0) ?>" readonly class="form-control"></td>
                            </tr>

                        </table>
                        <div class="text-right mb-3 tombol_bayar">
                            <button type="submit" class="btn btn-primary" id="tombol">Tambah ke keranjang <i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>