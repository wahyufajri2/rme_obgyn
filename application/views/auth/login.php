<div class="background"></div>
<div class="container">
    <div class="content">
        <h2>Selamat Datang</h2>

        <div class="text-sci">
            <h3>
                Rekam Medis Elektronik<br />
                Asesmen Obstetri dan Ginekologi<br />
                <span>[RS PKU Muhammadiyah Gamping]</span>
            </h3>
        </div>
    </div>

    <div class="login-box">
        <?= $this->session->flashdata('mesaage'); ?>
        <div class="form-box">
            <form class="user" method="post" action="<?= base_url('auth'); ?>">
                <h2>Masuk</h2>
                <h3>Masuk untuk memulai sesi Anda</h3>

                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" inputmode="email" name="email" id="email" aria-describedby="emailHelp" value="<?php if (isset($_COOKIE["email"])) {
                                                                                                                            echo $_COOKIE["email"];
                                                                                                                        } else {
                                                                                                                            echo set_value('email');
                                                                                                                        } ?>">
                    <?= form_error('email', '<small class="text-warning pl-3">', '</small>'); ?>
                    <label class="required" for="email">Masukan email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-key"></i></span>
                    <input type="kata_sandi" id="kata_sandi" name="kata_sandi" value="<?php if (isset($_COOKIE["kata_sandi"])) {
                                                                                            echo $_COOKIE["kata_sandi"];
                                                                                        } ?>">
                    <?= form_error('kata_sandi', '<small class="text-warning pl-3">', '</small>'); ?>
                    <label class="required" for="kata_sandi">Masukan kata sandi</label>
                    <div class="eye-icon-container">
                        <span class="separator"></span>
                        <span id="show_password" class="eye-icon">
                            <i class="fa-solid fa-eye-slash" id="icon"></i>
                        </span>
                    </div>
                </div>
                <div class="remember-me">
                    <label><input type="checkbox" class="custom-control-input" id="save_id" name="save_id" <?php if (isset($_COOKIE["email"])) {
                                                                                                                echo "checked";
                                                                                                            } ?>>Ingatkan saya!</label>
                </div>

                <button type="submit" class="btn">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk
                </button>
            </form>
        </div>
    </div>
</div>