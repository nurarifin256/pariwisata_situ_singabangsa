<br>
<div class="container mt-5">
    <?php if ($this->session->userdata('toko')) { ?>
        <div class="flash-data" data-flashdata="<?= $this->session->userdata('toko') ?>">
            <?php
            $this->session->unset_userdata('toko');
            ?>
        </div>
    <?php } ?>
    <h1 class="text-center">Profil Toko</h1>
    <?php
    $id_user = $this->session->userdata('id_user');
    $getToko =  $this->db->query("SELECT COUNT(*) jumlah FROM user A INNER JOIN toko B ON B.id_user=A.id_user WHERE A.id_user=$id_user")->row();
    // var_dump($getToko->jumlah);
    // die;
    if ($getToko->jumlah == 1) { ?>
        <div class="row justify-content-center">
            <div class="card mb-2">
                <div class="row no-gutters">
                    <?php if ($toko['icon'] == "") {
                        $gambar = "default-store.png";
                    } else {
                        $gambar = 'iconToko/' . $toko['icon'];
                    } ?>
                    <div class="col-4">
                        <img src="<?= base_url() . 'assets/img/' . $gambar ?>" alt="..." class="pt-2 pb-1 pl-1 mr-5" style="width: 150px;">
                    </div>
                    <div class="col-8 pl-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $toko['nama'] ?></h5>
                            <p class="card-text">Email : <?= $toko['email'] ?><br>
                                Bank : <?= $toko['nama_bank'] ?><br>
                                No. rek : <?= $toko['no_rekening'] ?><br>
                                Pemilik Rekening : <?= $toko['nama_pemilik_rekening'] ?><br>
                                <a href="<?= base_url() ?>Toko2/EditProfilToko/<?= $toko['id_user'] ?>" class="float-right mr-5 btn btn-sm btn-warning mb-3 mt-2"><i class="fas fa-pen-square"></i> Edit</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-center">Silahkan lengkapi profil toko anda<a href="<?= base_url() ?>Toko2/LengkapiProfil" class="btn btn-outline-primary ml-2">Klik</a></p>
    <?php } ?>
</div>