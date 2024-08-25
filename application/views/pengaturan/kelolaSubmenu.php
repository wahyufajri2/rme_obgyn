<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('pengaturan/kelolaSubmenu'); ?>">Beranda</a></li>
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
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr class="table-active">
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Url</th>
                            <th scope="col">Ikon</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subMenu as $i => $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i + 1; ?></th>
                                <td><?= $sm['judul']; ?></td>
                                <td><?= $sm['menu']; ?></td>
                                <td><?= $sm['url']; ?></td>
                                <td><?= $sm['ikon']; ?></td>
                                <td>
                                    <span class="badge rounded-pill text-bg-<?= ($sm['apakah_aktif'] == 1) ? 'warning' : 'secondary'; ?>"><?= ($sm['apakah_aktif'] == 1) ? 'Aktif' : 'Nonaktif'; ?></span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahSubmenuModal_<?= $sm['id']; ?>">
                                        <i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Ubah
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusSubmenuModal_<?= $sm['id']; ?>">
                                        <i class="fas fa-solid fa-trash-can fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newSubMenuModal"><i class="fas fa-solid fa-circle-plus fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tambah Submenu Baru</a>
            </div>
        </div>
    </div>
</main>

<!-- Modal tambah submenu-->
<div class="modal fade" id="newSubMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Submenu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('pengaturan/kelolaSubmenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul submenu</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul submenu">
                        <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="id_menu" class="form-label">Pilih Menu</label>
                        <select name="id_menu" id="id_menu" class="form-select">
                            <option value="">Pilih Menu</option>
                            <?php
                            $allowedMenus = ['Admin', 'Pendaftaran', 'Bidan', 'Dokter', 'Pengaturan']; // Daftar menu yang diizinkan
                            foreach ($menu as $m) :
                                if (in_array($m['menu'], $allowedMenus)) : // Hanya tampilkan jika menu ada dalam daftar
                            ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">Url submenu</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url submenu">
                        <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="ikon" class="form-label">Ikon submenu</label>
                        <input type="text" class="form-control" id="ikon" name="ikon" placeholder="Ikon submenu">
                        <?= form_error('ikon', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" value="1" name='apakah_aktif' id="apakah_aktif" checked>
                        <label for="apakah_aktif" class="form-check-label">Aktif?</label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                        <button type="reset" class="btn btn-warning"><i class="fas fa-solid fa-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Atur ulang</button>
                    </div>
                    <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-circle-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk mengubah nama submenu -->
<?php foreach ($subMenu as $sm) : ?>
    <div class="modal fade" id="ubahSubmenuModal_<?= $sm['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahSubmenuModalLabel_<?= $sm['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahSubmenuModalLabel_<?= $sm['id']; ?>">Ubah Submenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('pengaturan/ubahSubmenu/' . $sm['id']); ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul submenu</label>
                            <input type="text" class="form-control" id="judul_<?= $sm['id']; ?>" name="judul" placeholder="Judul submenu" value="<?= $sm['judul']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="id_menu" class="form-label">Pilih Menu</label>
                            <select name="id_menu" id="id_menu_<?= $sm['id']; ?>" class="form-select">
                                <option value="">Pilih Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>" <?= ($m['id'] == $sm['id_menu']) ? 'selected' : ''; ?>><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">Url submenu</label>
                            <input type="text" class="form-control" id="url_<?= $sm['id']; ?>" name="url" placeholder="Url submenu" value="<?= $sm['url']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="ikon" class="form-label">Ikon submenu</label>
                            <input type="text" class="form-control" id="ikon_<?= $sm['id']; ?>" name="ikon" placeholder="Ikon submenu" value="<?= $sm['ikon']; ?>">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="apakah_aktif_<?= $sm['id']; ?>" value="1" name='apakah_aktif'
                                <?php if ($sm['apakah_aktif'] == 1) echo 'checked'; ?>>
                            <label for="apakah_aktif_<?= $sm['id']; ?>" class="form-check-label">Aktif?</label>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                        </div>
                        <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-floppy-disk"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal untuk menghapus submenu -->
<?php foreach ($subMenu as $sm) : ?>
    <div class="modal fade" id="hapusSubmenuModal_<?= $sm['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusSubmenuModalLabel_<?= $sm['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gradient-secondary">
                    <h1 class="modal-title fs-5" id="hapusSubmenuModalLabel_<?= $sm['id']; ?>">Konfirmasi Hapus Submenu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus submenu <strong><?= $sm['judul']; ?></strong>?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Batal</button>
                    <form action="<?= base_url('pengaturan/hapusSubmenu/' . $sm['id']); ?>" method="post">
                        <input type="hidden" name="menu_id" id="menuIdToDelete">
                        <button type="submit" class="btn btn-danger fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>