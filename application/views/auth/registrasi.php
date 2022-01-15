<div class="full-page">

    <div class='login-page'>
        <div class="form-boxx">

            <div class='button-boxx'>
                <div id='btn-reg'></div>
                <button type='button' class='toggle-btn'>Daftar Akun</button>
            </div>

            <form id='login' class='input-group-loginn' method="POST" action="<?= base_url() ?>Auth/registrasi">

                <input type='text' class='input-field' placeholder='Masukan Nama' name="nama" value="<?= set_value('nama') ?>" autocomplete="off" autofocus>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>

                <input type='text' class='input-field' placeholder='Masukan Email' name="email" value="<?= set_value('email') ?>" autocomplete="off">
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>

                <input type='password' class='input-field' placeholder='Masukan Password' name="password1" value="<?= set_value('password1') ?>" autocomplete="off">
                <?= form_error('password1', '<small class="text-danger">', '</small>') ?>

                <input type='password' class='input-field' placeholder='Ulangi Password' name="password2" value="<?= set_value('password2') ?>" autocomplete="off">
                <?= form_error('password2', '<small class="text-danger">', '</small>') ?>

                <div class="pertanyaan">
                    <p class="mt-3">Sudah punya akun ? <a href="<?= base_url() ?>Auth">login</a></p>
                    <button type='submit' class='submit-btn'>Daftar</button>
                </div>
            </form>

        </div>
    </div>



</div>