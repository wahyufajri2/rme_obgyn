<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/lihatRekamMedis'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No RM</th>
                            <th scope="col">Bidan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($Kebidanan as $kbd) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $kbd['nama_pasien']; ?></td>
                                <td><?= $kbd['no_rm']; ?></td>
                                <td><?= $kbd['nama_bidan']; ?></td>
                                <td><?= $kbd['status']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#detailRekamMedis">
                                        <i class="fas fa-solid fa-file-lines fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>