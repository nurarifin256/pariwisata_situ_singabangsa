<br>
<div class="container mt-5">
    <h1 class="text-center">Beli Cemilan</h1>

    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url() . 'assets/img/' . $cemilan['foto'] ?>" class="img-fluid">
                    <h1><?= $cemilan['nama'] ?> <?= $cemilan['variant'] ?></h1>
                    <h4>Rp. <?= number_format($cemilan['harga'], 0, ',', '.') ?></h4>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <h4>Pengiriman</h4>

            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select name="" id="provinsi" class="form-control">
                    <option value="">Pilih Provinsi</option>
                    <option></option>
                </select>
            </div>

            <div class="form-group">
                <label for="kabupaten">Kabupate/Kota</label>
                <select name="" id="kabupaten" class="form-control">
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
            </div>

            <div class="form-group">
                <label for="service">Kurir</label>
                <select name="" id="kurir" class="form-control">
                    <option value="">Pilih Kurir</option>
                </select>
            </div>

            <div class="form-group">
                <label for="service">Service</label>
                <select name="" id="service" class="form-control">
                    <option value="">Pilih Service</option>
                </select>
            </div>

        </div>
    </div>
</div>