<br>
<div class="container mt-5">
    <h1 class="text-center">Edit Cemilan</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">


            <?= form_open_multipart('Toko2/editCemilan/'  . $cemilan['id_cemilan'] . '/' . $cemilan['id_toko']); ?>
            <div class="form-group">
                <label for="nama">Nama Cemilan</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?= $cemilan['nama'] ?>" autocomplete="off" autofocus>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="variant">Variant Rasa</label>
                <input type="text" id="variant" name="variant" class="form-control" value="<?= $cemilan['variant'] ?>" autocomplete="off">
                <?= form_error('variant', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea rows="10" id="keterangan" class="form-control" name="keterangan" autocomplete="off"><?= $cemilan['keterangan'] ?></textarea>
                <?= form_error('keterangan', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="berat">Berat / gr</label>
                <input type="number" id="berat" name="berat" class="form-control" value="<?= $cemilan['berat'] ?>" autocomplete="off">
                <?= form_error('berat', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input id="harga" autocomplete="off" type="number" class="form-control" name="harga" value="<?= number_format($cemilan['harga'], 0, ',', '.') ?>"></input>
                <?= form_error('harga', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="">Gambar</label>
                <div>
                    <img src="<?= base_url() . 'assets/img/' . $cemilan['foto'] ?>" alt="" class="img-thumbnail img-preview">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul" name="gambar" onchange="previewImg()">
                    <label class="custom-file-label" for="sampul">pilih gambar</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </div>
    </div>
</div>