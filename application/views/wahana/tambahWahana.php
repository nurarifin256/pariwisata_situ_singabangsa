<br>
<div class="container mt-5">
    <h1 class="text-center">Tambah Wahana</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">


            <?= form_open_multipart('Wahana/tambahWahana'); ?>
            <div class="form-group">
                <label for="nama">Nama Wahana</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?= set_value('nama') ?>" autocomplete="off" autofocus>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea rows="10" id="keterangan" class="form-control" name="keterangan" value="<?= set_value('keterangan') ?>" autocomplete="off"></textarea>
                <?= form_error('keterangan', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input id="harga" autocomplete="off" type="number" class="form-control" name="harga" value="<?= set_value('harga') ?>"></input>
                <?= form_error('harga', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="">Gambar</label>
                <div>
                    <img src="<?= base_url() ?>assets/img/default.png" alt="" class="img-thumbnail img-preview">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul" required name="gambar" onchange="previewImg()" required>
                    <label class="custom-file-label" for="sampul">pilih gambar</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </div>
    </div>
</div>