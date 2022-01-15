<br>
<div class="container mt-5">
    <h3 class="text-center">Input Nomor Resi</h3>

    <div class="justify-content-center mt-3">

        <form method="post" action="Toko2/inputResi/<?= $id_pesanan_cemilan ?>">
            <div class="form-group row">
                <label for="staticEmail" class=" offset-sm-2 col-sm-2 col-form-label">No Pesanan</label>
                <div class="col-sm-6">
                    <input type="text" name="id_pesanan_cemilan" readonly class="form-control-plaintext" value="<?= $id_pesanan_cemilan ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="no_resi" class=" offset-sm-2 col-sm-2 col-form-label">No Resi</label>
                <div class="col-sm-6">
                    <input type="text" name="no_resi" class="form-control" id="no_resi" value="<?= set_value('no_resi') ?>" autocomplete="off" autofocus>
                    <?= form_error('no_resi', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="no_resi" class=" offset-sm-2 col-sm-2 col-form-label"></label>
                <div class="col-sm-6 text-right">
                    <button type="submit" class="btn btn-primary">Input</button>
                </div>
            </div>
        </form>

    </div>
</div>