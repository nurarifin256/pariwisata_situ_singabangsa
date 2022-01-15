<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>LandingPage">
            <img src="<?= base_url() ?>assets/img/navbrand3.png" width="30" height="30" class="d-inline-block align-top">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">

                <?php if ($this->session->userdata('role_id') == 1) { ?>

                    <li class="nav-item">
                        <a class="nav-link 
                    <?php
                    if ($this->uri->segment(2) == "index") {
                        echo "active";
                    }
                    ?>" href="<?= base_url() ?>Admin/index">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link 
                    <?php
                    if ($this->uri->segment(1) == "Pesan") {
                        echo "active";
                    }
                    ?>" href="<?= base_url() ?>Pesan">Pesan</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle 
                        <?php
                        if ($this->uri->segment(1) == "Cemilan" or $this->uri->segment(1) == "Tambah" or $this->uri->segment(1) == "Wahana") {
                            echo "active";
                        } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tambah
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url() ?>Tambah/acara">Tambah Acara</a>
                            <a class="dropdown-item" href="<?= base_url() ?>Wahana">Tambah Wahana</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <?php
                        $konfirmasiT =  $this->db->query("SELECT COUNT(*) jumlah FROM pesanan_tiket A WHERE A.status='sedang di proses'")->row();
                        $konfirmasiC =  $this->db->query("SELECT COUNT(*) jumlah2 FROM cemilan B WHERE B.status='Menunggu persetujuan admin'")->row();
                        $konfirmasiTo =  $this->db->query("SELECT COUNT(*) jumlahToko FROM user C WHERE C.role_id=4")->row();
                        ?>
                        <a class="nav-link dropdown-toggle
                        <?php
                        if ($this->uri->segment(2) == "konfirmasiCemilan" or $this->uri->segment(2) == "konfirmasiTiket") {
                            echo "active";
                        } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Approve <sup class="badge badge-pill badge-light"><?= $konfirmasiT->jumlah +  $konfirmasiTo->jumlahToko +  $konfirmasiC->jumlah2 ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url() ?>Admin/konfirmasiTiket">Approve Tiket <sup class="badge badge-pill badge-primary"><?= $konfirmasiT->jumlah ?></a>
                            <a class="dropdown-item" href="<?= base_url() ?>Admin/konfirmasiCemilanToko">Approve Cemilan <sup class="badge badge-pill badge-primary"><?= $konfirmasiC->jumlah2 ?></a>
                            <a class="dropdown-item" href="<?= base_url() ?>Admin/konfirmasiToko">Approve Toko <sup class="badge badge-pill badge-primary"><?= $konfirmasiTo->jumlahToko ?></a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle
                        <?php
                        if ($this->uri->segment(2) == "tiket" or $this->uri->segment(2) == "cemilan" or $this->uri->segment(2) == "laporanCemilan" or $this->uri->segment(2) == "laporanTiket") {
                            echo "active";
                        } ?>
                        " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laporan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url() ?>Laporan/tiket">Laporan Tiket</a>
                        </div>
                    </li>


                <?php } else if ($this->session->userdata('role_id') == 3) { ?>

                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>Petugas">Beranda</a>
                    </li>

                <?php } else if ($this->session->userdata('role_id') == 4) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>Toko/BelumVerifikasi">Beranda Toko</a>
                    </li>
                <?php } else if ($this->session->userdata('role_id') == 5) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>Toko2/BerandaToko">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>Toko2/Produk">Cemilan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>Toko2/Laporan">Laporan</a>
                    </li>
                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link 
                    <?php
                    if ($this->uri->segment(2) == "index") {
                        echo "active";
                    }
                    ?>" href="<?= base_url() ?>LandingPage/index">Beranda</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle 
                        <?php if ($this->uri->segment(2) == "detailWahana") {
                            echo "active";
                        } else if ($this->uri->segment(2) == "beliTiket") {
                            echo "active";
                        } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Wahana
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $wahana =  $this->db->query("SELECT * FROM tiket");
                            // var_dump($wahanaa->row());
                            // die;
                            foreach ($wahana->result_array() as $w) : ?>
                                <a class="dropdown-item" href="<?= base_url() ?>LandingPage/detailWahana/<?= $w['id_tiket'] ?>"><?= $w['nama'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if ($this->uri->segment(1) == "Kategori") {
                                                                echo "active";
                                                            } else if ($this->uri->segment(2) == "cemilan") {
                                                                echo "active";
                                                            } else if ($this->uri->segment(2) == "detailCemilan") {
                                                                echo "active";
                                                            } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cemilan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php $cemilan = $this->db->query("SELECT DISTINCT A.nama FROM cemilan A WHERE A.status='Aktif' ORDER BY A.nama ASC");
                            foreach ($cemilan->result_array() as $c) : ?>
                                <a class="dropdown-item" href="<?= base_url() ?>Kategori/halaman/<?= str_replace(' ', '_', $c['nama']) ?>"><?= $c['nama'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </li>


                    <?php if ($this->session->userdata('role_id') == 2) { ?>
                        <li class="nav-item">
                            <a class="nav-link 
                        <?php
                        if ($this->uri->segment(1) == "Pesanan") {
                            echo "active";
                        }
                        ?>" href="<?= base_url() ?>Pesanan">Pesanan Saya</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link 
                        <?php
                        if ($this->uri->segment(1) == "Bukatoko") {
                            echo "active";
                        }
                        ?>" href="<?= base_url() ?>Auth/registrasiToko">Buka Toko</a>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link 
                    <?php
                    if ($this->uri->segment(1) == "Panduan") {
                        echo "active";
                    }
                    ?>" href="<?= base_url() ?>Panduan">Panduan</a>
                    </li>


                <?php } ?>

            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if ($this->session->userdata('role_id') == 1 or $this->session->userdata('role_id') == 3 or $this->session->userdata('role_id') == 4) { ?>

                    <?php } else {
                    if ($this->session->userdata('role_id') == 5) { ?>
                        <li class="nav-item">
                            <?php
                            $id_user = $this->session->userdata("id_user");
                            $pesananC =  $this->db->query("SELECT COUNT(B.id_pesanan_cemilan) AS jumlahPes FROM konfirmasi_cemilan A INNER JOIN pesanan_cemilan B ON B.id_pesanan_cemilan=A.id_pesanan_cemilan INNER JOIN detail_pesanan_cemilan C ON C.id_pesanan_cemilan=B.id_pesanan_cemilan INNER JOIN cemilan D ON D.id_cemilan=C.id_cemilan INNER JOIN toko E ON E.id_toko=D.id_toko INNER JOIN user F ON F.id_user=E.id_user WHERE F.id_user='$id_user' AND B.status='sedang di proses' GROUP BY B.id_pesanan_cemilan")->row();

                            if ($pesananC > '0') {
                                $jumlah_fix = $pesananC->jumlahPes;
                            } else {
                                $jumlah_fix = 0;
                            }
                            ?>

                            <a href="<?= base_url() ?>Toko2/Pesanan" class="nav-link 
                            <?php if ($this->uri->segment(2) == "detailKeranjang") {
                                echo "active";
                            } ?>"><i class="fas fa-bell"></i><sup class="ml-1"><?= $jumlah_fix ?></sup>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <?php
                            $id_user = $this->session->userdata("id_user");
                            $keranjangc =  $this->db->query("SELECT COUNT(*) jumlah2 FROM keranjang_cemilan A WHERE A.id_user='$id_user' AND A.status='1'")->row();
                            $keranjangt =  $this->db->query("SELECT COUNT(*) jumlah1 FROM keranjang_tiket B WHERE B.id_user='$id_user'")->row();
                            ?>

                            <a href="<?= base_url() ?>Keranjang/detailKeranjang" class="nav-link 
                            <?php if ($this->uri->segment(2) == "detailKeranjang") {
                                echo "active";
                            } ?>"><i class="fas fa-shopping-cart"></i><sup class="ml-1"><?= $keranjangc->jumlah2 + $keranjangt->jumlah1 ?></sup>
                            </a>
                        </li>
                <?php }
                } ?>

                <li class="nav-item">

                    <?php if ($this->session->userdata('nama')) { ?>
                        <a class="nav-link" href="<?= base_url() ?>Auth/logout">Log Out <i class="fas fa-sign-out-alt"></i></a>
                    <?php } else { ?>
                        <a class="nav-link" href="<?= base_url() ?>Auth">Log In <i class="fas fa-sign-in-alt"></i></a>
                    <?php } ?>

                </li>
            </ul>
        </div>
    </div>
</nav>