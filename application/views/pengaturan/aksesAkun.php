<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2">Mengubah Akses Akun</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('pengaturan/kelolaAkun'); ?>">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('pengaturan/kelolaAkun'); ?>">Kelola Peran Akun</a></li>
            <li class="breadcrumb-item active">Ubah Akses Akun</li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <h5>Peran : <?= $satuRole['peran']; ?></h5>
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr class="table-active">
                            <th scope="col">No</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['menu']; ?></td>
                                <td>
                                    <input class="form-check-input" type="checkbox" <?= check_access($satuRole['id'], $m['id']); ?> data-peran="<?= $satuRole['id']; ?>" data-menu="<?= $m['id']; ?>">
                                    <span class="badge rounded-pill text-bg-<?= check_access($satuRole['id'], $m['id']) ? 'warning' : 'secondary'; ?> ms-2">
                                        <?= check_access($satuRole['id'], $m['id']) ? 'Diizinkan' : 'Tidak diizinkan'; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="<?= base_url('pengaturan/kelolaPeranAkun'); ?>" class="btn btn-primary btn-sm  fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
</main>