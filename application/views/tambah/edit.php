<br>
<div class="container mt-5">
    <h1 class="text-center">Edit Acara</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">


            <?= form_open_multipart('Tambah/editAcara/' . $acara['id_acara']); ?>
            <div class="form-group">
                <label for="nama">Nama Acara</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?= set_value('nama'), $acara['nama'] ?>" autofocus>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea rows="10" id="keterangan" class="form-control" name="keterangan" value="<?= set_value('keterangan') ?>"><?= $acara['keterangan'] ?></textarea>
                <?= form_error('keterangan', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="">Gambar</label>
                <div>
                    <img src="<?= base_url() . 'assets/img/acara/' . $acara['gambar'] ?>" class="img-thumbnail img-preview">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul" name="gambar" onchange="previewImg()">
                    <label class="custom-file-label" for="sampul">Pilih Gambar</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Update</button>
            <a href="<?= base_url() ?>Tambah/acara" class="btn btn-success float-right mr-1"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
        </div>
    </div>
</div>