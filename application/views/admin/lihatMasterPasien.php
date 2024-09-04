<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/lihatMasterPasien'); ?>">Beranda</a></li>
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
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Tanggal lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($dataMasterPasien as $dmp) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $dmp['nama_pasien']; ?></td>
                                <td><?= $dmp['nik']; ?></td>
                                <?php
                                // Mengatur lokal ke bahasa Indonesia
                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                ?>

                                <td><?= $formatter->format($dmp['tgl_lahir']); ?></td>
                                <td><?= $dmp['alamat']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detailDataPasien_<?= $dmp['nik']; ?>">
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

<!-- Awal modal untuk melihat detail master data pasien -->
<?php foreach ($dataMasterPasien as $dmp) : ?>
    <div class="modal fade" id="detailDataPasien_<?= $dmp['no_rm']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailDataPasienLabel_<?= $dmp['no_rm']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailDataPasienLabel_<?= $dmp['no_rm']; ?>">Detail Master Data Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Nomor RM</span>
                                <div class="card p-1">
                                    <?= $dmp['no_rm']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Nomor NIK</span>
                                <div class="card p-1">
                                    <?= $dmp['nik']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Jenis kelamin</span>
                                <div class="card p-1">
                                    <?= $dmp['jenis_kelamin']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Nama pasien</span>
                                <div class="card p-1">
                                    <?= $dmp['nama_pasien']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Tanggal lahir</span>
                                <div class="card p-1">
                                    <?php
                                    // Mengatur lokal ke bahasa Indonesia
                                    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                    ?>
                                    <?= $formatter->format($dmp['tgl_lahir']); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Nomor handphone</span>
                                <div class="card p-1">
                                    <?= $dmp['no_hp']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Alamat</span>
                                <div class="card p-1">
                                    <?= $dmp['alamat']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Nama suami</span>
                                <div class="card p-1">
                                    <?= $dmp['suami']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal untuk melihat detail master data pasien -->