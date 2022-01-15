<div class="full-page">

    <div id='login-form' class='login-page'>
        <div class="form-box">

            <div class='button-box'>
                <div id='btn'></div>
                <button type='button' class='toggle-btn'>Log In</button>
            </div>

            <?php if ($this->session->flashdata('pesan_auth')) : ?>
                <div class="row">
                    <div class="col pesan">
                        <?= $this->session->flashdata('pesan_auth') ?>
                    </div>
                </div>
            <?php endif; ?>

            <form id='login' class='input-group-login' method="POST" action="<?= base_url() ?>Auth/index">

                <input type='text' class='input-field' placeholder='Masukan Email' name="email" value="<?= set_value('email') ?>" autocomplete="off" autofocus>
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>

                <input type='password' class='input-field' placeholder='Masukan password' name="password" value="<?= set_value('password') ?>" autocomplete="off">
                <?= form_error('password', '<small class="text-danger">', '</small>') ?>

                <p class="mt-3">Belum punya akun ? <a href="<?= base_url() ?>Auth/registrasi">daftar akun</a></p>
                <button type='submit' class='submit-btn'>Log in</button>
            </form>

        </div>
    </div>

</div>