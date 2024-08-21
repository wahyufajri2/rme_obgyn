<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/tambahAkun'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
                <form method="post" action="<?= base_url('admin/tambahAkun'); ?>">
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="nama" name="nama" type="text" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>" />
                                <label for="nama">Nama Lengkap</label>
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" inputmode="email" id="email" name="email" type="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>" />
                        <label for="email">Alamat Email</label>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input class="form-control" id="kata_sandi1" name="kata_sandi1" type="password" placeholder="Masukan Kata Sandi" />
                                <label for="kata_sandi1">Masukan Kata Sandi</label>
                                <i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="display: none; cursor: pointer;"></i>
                                <?= form_error('kata_sandi1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input class="form-control" id="kata_sandi2" name="kata_sandi2" type="password" placeholder="Ulangi Kata Sandi" />
                                <label for="kata_sandi2">Ulangi Kata Sandi</label>
                                <i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePasswordConfirm" style="display: none; cursor: pointer;"></i>
                                <?= form_error('kata_sandi2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Daftarkan Akun
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>