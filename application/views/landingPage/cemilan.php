<br>
<br>
<div class="container">
    <?php if ($this->session->userdata('cemilanLanding')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('cemilanLanding') ?>">
            <?php
            $this->session->unset_userdata('cemilanLanding');
            ?>
        </div>
    <?php } ?>
    <section class="cemilan">
        <div class="mt-3">

            <div class="text-center">
                <h3>Cemilan</h3>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="<?= base_url() ?>LandingPage/cemilan" class="list-group-item list-group-item-action list-group-item <?php if ($this->uri->segment(2) == "cemilan") {
                                                                                                                                                    echo "active";
                                                                                                                                                } ?>">Semua</a>
                            </li>

                            <li class="list-group-item">
                                <?php $cemilann = $this->db->query("SELECT DISTINCT A.nama FROM cemilan A WHERE A.status='Aktif'");
                                foreach ($cemilann->result_array() as $c) : ?>
                                    <a href="<?= base_url() ?>Kategori/halaman/<?= str_replace(' ', '_', $c['nama']) ?>" class="list-group-item list-group-item-action 
                                <?php if ($this->uri->segment(3) == $c['nama']) {
                                        echo "active";
                                    } ?>"><?= $c['nama'] ?></a>
                                <?php endforeach; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="card-deck">
                            <div class="row  kotak-wahana">

                                <?php
                                foreach ($cemilan as $c) :
                                    if ($c['icon'] == "") {
                                        $gambar = "default-store.png";
                                    } else {
                                        $gambar = 'iconToko/' . $c['icon'];
                                    } ?>

                                    <div class="col-md-4 img-cemilan mb-3">
                                        <div class="card text-center">
                                            <img src="<?= base_url() . 'assets/img/' . $c['foto'] ?>" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $c['nama_cemilan'] ?> <?= $c['variant'] ?></h5>
                                                <p>
                                                    <img src="<?= base_url() . 'assets/img/' . $gambar ?>" class="" style="height: 20px; width:20px" alt="">
                                                    <?= $c['nama_user'] ?>
                                                </p>
                                                <p class="card-text">Rp. <?= number_format($c['harga'], 0, ',', '.') ?></p>
                                                <a href="<?= base_url() ?>LandingPage/detailCemilan/<?= $c['id_cemilan'] ?>" class="btn btn-success">Detail</a>
                                                <a href="<?= base_url() ?>Keranjang/tambahKeKeranjang/<?= $c['id_cemilan'] ?>" class="btn btn-primary"><i class="fas fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>