<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Ubah Profil</h1>
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
            <li class="breadcrumb-item active">Ubah Profil</li>
        </ol>
        <hr>
        <div class="row">
            <div class="col-lg-8">

                <?= form_open_multipart('anggota/edit'); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <div class="col-sm-2">Gambar Profil</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label for="image" class="custom-file-label">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>