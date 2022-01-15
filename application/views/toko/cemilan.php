<br>
<div class="container mt-5">
    <h3 class="text-center mb-3">Laporan Cemilan</h3>

    <form action="<?= base_url() ?>Toko2/laporanCemilan" method="get">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="tanggal1">Dari</label>
                    <input type="date" class="form-control" name="tanggal1" value="<?= date('Y-m-01') ?>">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Sampai</label>
                    <input type="date" class="form-control" name="tanggal2" value="<?= date('Y-m-d') ?>">
                </div>
            </div>

        </div>
        <div class="text-center">

            <button type="submit" class="btn btn-primary">Lihat</button>
        </div>
    </form>

</div>
</div>