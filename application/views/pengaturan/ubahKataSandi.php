<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2">Ubah kata sandi untuk email <?= $this->session->userdata('reset_email'); ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/tambahAkun'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <form method="post" action="<?= base_url('pengaturan/ubahKataSandi'); ?>">
                    <div class="row mb-3">
                        <p class="mb-0">*Harus mengandung huruf besar, huruf kecil, angka, dan simbol (Kata%$^%Sandi1234)</p>
                        <div class="col-md">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="kata_sandi1" name="kata_sandi1" type="password" placeholder="Masukan Kata Sandi" />
                                <label for="kata_sandi1">Masukan Kata Sandi</label>
                                <i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="display: none; cursor: pointer;"></i>
                                <?= form_error('kata_sandi1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="kata_sandi2" name="kata_sandi2" type="password" placeholder="Ulangi Kata Sandi" />
                                <label for="kata_sandi2">Ulangi Kata Sandi</label>
                                <i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePasswordConfirm" style="display: none; cursor: pointer;"></i>
                                <?= form_error('kata_sandi2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Ubah Kata Sandi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>