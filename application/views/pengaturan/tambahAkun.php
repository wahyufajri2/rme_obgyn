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
                <?= $this->session->flashdata('message'); ?>
                <form method="post" action="<?= base_url('pengaturan/tambahAkun'); ?>">
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="nama" name="nama" type="text" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>" />
                                <label for="nama">Nama Lengkap</label>
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input class="form-control" inputmode="email" id="email" name="email" type="text" placeholder="Alamat Email" value="<?= set_value('email'); ?>" />
                            <label for="email">Alamat Email</label>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="id_peran" name="id_peran">
                                <option value="">Pilih salah satu peran</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>"><?= $r['peran']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id_peran">Pilih peran</label>
                            <?= form_error('id_peran', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <p class="mb-0">*Harus mengandung huruf besar, huruf kecil, angka, dan simbol (Kata%$^%Sandi1234)</p>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="kata_sandi1" name="kata_sandi1" type="password" placeholder="Masukan Kata Sandi" />
                                <label for="kata_sandi1">Masukan Kata Sandi</label>
                                <i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="display: none; cursor: pointer;"></i>
                                <?= form_error('kata_sandi1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Daftarkan Akun
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>