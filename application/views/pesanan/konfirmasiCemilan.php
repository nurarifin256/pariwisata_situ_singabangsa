<br>
<div class="container mt-5">
    <h1 class="text-center">Konfirmasi Pesanan Cemilan</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">


            <?= form_open_multipart('Pesanan/konfirmasiCemilan/' . $id); ?>
            <input type="hidden" name="id_pesanan_cemilan" value="<?= $id ?>">
            <div class="form-group">
                <label for="nama_rekening">Nama Rekening</label>
                <input type="text" id="nama_rekening" name="nama_rekening" class="form-control" value="<?= set_value('nama_rekening') ?>" autofocus>
                <?= form_error('nama_rekening', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="no_rekening">No Rekening</label>
                <input type="number" id="no_rekening" class="form-control" name="no_rekening" value="<?= set_value('no_rekening') ?>">
                <?= form_error('no_rekening', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="nama_bank">Nama Bank</label>
                <select class="form-control" name="nama_bank" value="<?= set_value('nama_bank') ?>" id="nama_bank">
                    <option>Pilih Bank</option>
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
                <label for="">Bukti Pembayaran</label>
                <div>
                    <img src="<?= base_url() ?>assets/img/default.png" alt="" class="img-thumbnail img-preview">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul" required name="gambar" onchange="previewImg()">
                    <label class="custom-file-label" for="sampul">pilih gambar</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Komfirmasi</button>
            <a href="<?= base_url() ?>Pesanan" class="btn btn-success float-right mr-2">Kembali</a>

            </?>
        </div>
    </div>
</div>