<div class="background-custom"></div>
<div class="container-custom">
    <div class="content-custom">
        <h2 class="logo-custom"><img src="<?= base_url('assets/'); ?>assets/img/logo-unisa.png" alt="">UNISA Yogyakarta</h2>
        <div class="text-sci-custom">
            <h2>Selamat Datang!<br><span>Di Sistem Generate Password WiFi <br> Universitas 'Aisyiyah Yogyakarta</span></h2>
            <p>Ini adalah sistem generate password WiFi</p>

            <div class="social-icons-custom">
                <a href="https://www.facebook.com/UniversitasAisyiyahYogyakarta/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://youtu.be/BAB4N_t9lh0?si=YBw6lRzGidFQ3I6e" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://www.instagram.com/unisa_yogya/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <div class="logreg-box">
            <?= $this->session->flashdata('message'); ?>
            <div class="form-box-custom login-custom">
                <form class="user" method="post" action="<?= base_url('auth/forgotPassword'); ?>">
                    <h2>Anda lupa kata sandi?</h2>

                    <div class="input-box-custom">
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" inputmode="email" name="email" id="email" aria-describedby="emailHelp" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-warning pl-3">', '</small>'); ?>
                        <label for="email">Email</label>
                    </div>

                    <button type="submit" class="btn-custom">Atur Ulang Kata Sandi
                    </button>

                    <div class="login-register">
                        <p>Kembali ke halaman masuk? <a href="<?= base_url('auth'); ?>" class="register-link">Masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>