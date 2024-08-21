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
                <table class="table table-hover">
                    <thead>
                        <tr class="table-active">
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Url</th>
                            <th scope="col">Ikon</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subMenu as $i => $sm) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i + 1; ?></th>
                                <td><?= $sm['judul']; ?></td>
                                <td><?= $sm['menu']; ?></td>
                                <td><?= $sm['url']; ?></td>
                                <td><?= $sm['ikon']; ?></td>
                                <td class="text-center">
                                    <span class="badge rounded-pill text-bg-<?= ($sm['apakah_aktif'] == 1) ? 'success' : 'secondary'; ?>"><?= ($sm['apakah_aktif'] == 1) ? 'Aktif' : 'Nonaktif'; ?></span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-circle-plus fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tambah Submenu Baru</a>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Submenu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body bg-gray-500">
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul" name='judul' placeholder="Judul submenu">
                    </div>
                    <div class="form-group">
                        <select name="id_menu" id="id_menu" class="form_control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name='url' placeholder="Url submenu">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="ikon" name='ikon' placeholder="Ikon submenu">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" name='apakah_aktif' id="apakah_aktif" checked>
                            <label for="apakah_aktif" class="form-check-label">Aktif?</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between bg-gray-600">
                    <div>
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                        <button type="reset" class="btn btn-warning"><i class="fas fa-solid fa-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Atur ulang</button>
                    </div>
                    <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-circle-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>