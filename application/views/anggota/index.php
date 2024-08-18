<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('anggota'); ?>">
                    <?php
                    $loggedInRoleId = isset($_SESSION['role_id']) ? $_SESSION['role_id'] : null;

                    foreach ($role as $rl) {
                        if ($rl['id'] == $loggedInRoleId) {
                            echo '<span value="' . $rl['id'] . '">' . $rl['role'] . '</span>';
                        };
                    }; ?>
                </a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>

        <div class="row">
            <div class="col-lg-5">
                <a href="<?= base_url('anggota/edit'); ?>" class="btn btn-primary mb-3"><i class="fas fa-solid fa-user-pen"></i> Ubah Profil</a>
                <a href="<?= base_url('anggota/changePassword'); ?>" class="btn btn-danger mb-3"><i class="fas fa-solid fa-key"></i> Ganti Kata Sandi</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>

        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= base_url('assets/assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['name']; ?></h5>
                        <p class="card-text"><?= $user['email']; ?></p>
                        <p class="card-text"><small class="text-body-secondary">Sebagai admin sejak <?= date('d F Y', $user['date_created']); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>