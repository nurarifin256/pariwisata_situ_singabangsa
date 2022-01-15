<br>
<div class="container mt-5">

    <?php if ($this->session->userdata('tiket')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('tiket') ?>">
            <!-- <//?= $this->session->userdata('tiket') ?> -->
            <?php
            $this->session->unset_userdata('tiket');
            ?>

        </div>
    <?php } ?>

    <h3 class="text-center mt-4">Wahana</h3>
    <hr>

    <div class="card-deck">
        <div class="row justify-content-center kotak-wahana">

            <?php
            foreach ($tiket as $t) : ?>

                <div class="col-sm-3  img-tiket mb-3">
                    <div class="card text-center">
                        <img src="<?= base_url() . 'assets/img/' . $t['foto'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $t['nama'] ?></h5>
                            <p class="card-text">Rp. <?= number_format($t['harga'], 0, ',', '.') ?></p>
                            <a href="<?= base_url() ?>LandingPage/detailWahana/<?= $t['id_tiket'] ?>" class="btn btn-success">Detail</a>
                            <a href="<?= base_url() ?>Keranjang/beliTiket/<?= $t['id_tiket'] ?>" class="btn btn-primary">Beli Tiket</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>