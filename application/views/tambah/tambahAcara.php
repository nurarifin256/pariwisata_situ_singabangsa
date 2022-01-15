<br>
<div class="container mt-5">
    <h1 class="text-center">Tambah Acara</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">


            <?= form_open_multipart('Tambah/tambahAcara'); ?>
            <div class="form-group">
                <label for="nama">Nama Acara</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?= set_value('nama') ?>" autofocus>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea rows="10" id="keterangan" class="form-control" name="keterangan" value="<?= set_value('keterangan') ?>"></textarea>
                <?= form_error('keterangan', '<small class="text-danger">', '</small>') ?>
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