<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Ubah Kata Sandi</h1>
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
            <li class="breadcrumb-item"><a href="<?= base_url('anggota'); ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active">Ubah Kata Sandi</li>
        </ol>
        <hr>

        <div class="row">
            <div class="col-lg-6">

                <?= $this->session->flashdata('message'); ?>

                <?= form_open_multipart('anggota/changePassword'); ?>
                <div class="mb-3">
                    <label for="current_password" class="form-label">Kata sandi saat ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <label for="new_password1" class="form-label">Kata sandi baru</label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <label for="new_password2" class="form-label">Ulangi kata sandi</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
                </div>

            </div>
        </div>
    </div>
</main>