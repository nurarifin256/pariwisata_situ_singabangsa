<div class="bgjumbo"></div>

<div class="container">

    <?php if ($this->session->userdata('pesan')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('pesan') ?>">
            <?php
            $this->session->unset_userdata('pesan');
            ?>
        </div>
    <?php } ?>

    <section class="acara">
        <h3 class="text-center mt-4">Event</h3>
        <hr>

        <div class="card mb-5 img-acara" style=" max-width: 92.6%;">
            <div class="row no-gutters">
                <div class="col-sm-3">
                    <img class="card-img-top" src="<?= base_url() . 'assets/img/acara/' . $acara['gambar'] ?>">
                </div>
                <div class="col-sm-9">
                    <div class="card-body">
                        <h5 class="card-title"><?= $acara['nama'] ?></h5>
                        <p class="card-text"><?= $acara['keterangan'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tiket" id="wahana">
        <h3 class="text-center mt-4">Wahana</h3>
        <hr>

        <div class="card-deck">
            <div class="row justify-content-center kotak-wahana">

                <?php
                foreach ($tiket as $t) : ?>

                    <div class="col-sm-4  img-tiket mb-3">
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

        <div class="text-center mb-3 mt-3">
            <a href="<?= base_url() ?>LandingPage/semuaWahana" class="badge badge-success">
                <h5>Lihat Wahana Lainnya</h5>
            </a>
        </div>

    </section>

    <section class="cemilan">

        <h3 class="text-center mt-4">Cemilan</h3>
        <hr>

        <div class="cdodol card mb-5" style="max-width: 92.6%;">
            <div class="row no-gutters">
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="<?= base_url() ?>assets/img/ld.jpg">
                </div>
                <div class="col-sm-8">
                    <div class="card-body">
                        <h5 class="card-title">Dodol Tenjo</h5>
                        <p class="card-text">Dikemas dengan kemasan siap saji, isi 25 pcs. ada dua varian rasa, original dan wijen. berat 500 gr</p>
                        <h5 class="card-text">Rp 12.000</h5>
                        <a href="<?= base_url() ?>Kategori/dodol" class="btn btn-success">Lihat Lainnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="ctalas card mb-3 mt-5" style="max-width: 92.6%;">
            <div class="row no-gutters">
                <div class="col-sm-8">
                    <div class="card-body">
                        <h5 class="card-title">Talas</h5>
                        <p class="card-text">Nikmati cemilan hasil kebun warga sekitar Desa Singabangsa, dikemas dengan kemasan premium. cocok dimakan bersama keluarga, ada berbagai macam jenis cemilan</p>
                        <h5 class="card-text">Rp 10.000</h5>
                        <a href="<?= base_url() ?>Kategori/talas" class="btn btn-success">Lihat Lainnya</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img src="<?= base_url() ?>assets/img/lt.jpg" class="img-thumbnail">
                </div>
            </div>
        </div>


    </section>

    <section class="alamat mb-5">
        <h3 class="text-center mt-3">Kontak</h3>
        <hr>

        <div class="ralamat">
            <div class="row" style=" max-width: 96%;">

                <div class="col-sm-5">
                    <div class="card mb-3 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Lokasi</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3227.1818088379023!2d106.46744911413862!3d-6.321246163613774!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420897515116d7%3A0xc18f3f5613c5a8e!2sSitu%20Singa%20Bangsa!5e1!3m2!1sid!2sid!4v1628945260012!5m2!1sid!2sid" width="350" height="425" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                </div>
                <div class="col-sm-7">
                    <form action="<?= base_url() ?>LandingPage/kirimPesan" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="masukan nama" value="<?= set_value('nama') ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="telepon">No. Whatsapp</label>
                            <input type="number" class="form-control" id="telepon" name="no_tlp" placeholder="masukan no whatsapp" value="<?= set_value('no_tlp') ?>">
                            <?= form_error('no_tlp', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="Pesan">Pesan</label>
                            <textarea class="form-control" rows="10" id="pesan" name="pesan" placeholder="masukan pesan" value="<?= set_value('pesan') ?>"></textarea>
                            <?= form_error('pesan', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>

            </div>
        </div>

    </section>
</div>