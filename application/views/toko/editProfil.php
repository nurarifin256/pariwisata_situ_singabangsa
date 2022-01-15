<br>
<div class="container mt-5">
    <h1 class="text-center">Edit Profil Toko</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">


            <?= form_open_multipart('Toko2/EditProfilToko/' . $toko['id_user']); ?>
            <div class="form-group">
                <label for="nama">Nama Toko</label>
                <input type="text" id="nama" class="form-control" name="nama" value="<?= $toko['nama'] ?>">
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control" name="email" value="<?= $toko['email'] ?>">
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="nama_bank">Nama Bank</label>
                <select class="form-control" name="nama_bank" value="<?= set_value('nama_bank') ?>" id="nama_bank">
                    <option value="<?= $toko['nama_bank'] ?>"><?= $toko['nama_bank'] ?></option>
                    <option value="bca">BCA</option>
                    <option value="bca_syariah">BCA Syariah</option>
                    <option value="bni">BNI</option>
                    <option value="bri">BRI</option>
                    <option value="bsi">BSI</option>
                    <option value="cimb_niaga">CIMB Niaga</option>
                    <option value="mandiri">Mandiri</option>
                    <option value="maybank">Maybank</option>
                    <option value="mega">MEGA</option>
                    <option value="permata">Permata</option>
                </select>
                <?= form_error('nama_bank', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="no_rekening">No Rekening</label>
                <input type="number" id="no_rekening" class="form-control" name="no_rekening" value="<?= $toko['no_rekening'] ?>">
                <?= form_error('no_rekening', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="nama_pemilik_rekening">Nama Pemilik Rekening</label>
                <input type="text" id="nama_pemilik_rekening" class="form-control" name="nama_pemilik_rekening" value="<?= $toko['nama_pemilik_rekening'] ?>">
                <?= form_error('nama_pemilik_rekening', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="">Logo Toko</label>
                <?php if ($toko['icon'] == "") {
                    $gambar = "default-store.png";
                } else {
                    $gambar = 'iconToko/' . $toko['icon'];
                } ?>
                <div>
                    <img src="<?= base_url() . 'assets/img/' . $gambar ?>" alt="" class="img-thumbnail img-preview">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul" name="gambar" onchange="previewImg()">
                    <label class="custom-file-label" for="sampul">pilih gambar</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Update</button>
            <a href="<?= base_url() ?>Toko2/BerandaToko" class="btn btn-success float-right mr-2">Kembali</a>
        </div>
    </div>
</div>