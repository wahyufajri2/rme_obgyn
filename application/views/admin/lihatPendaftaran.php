<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/lihatPendaftaran'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor pendaftaran</th>
                            <th scope="col">Tanggal periksa</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($daftar as $dft) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $dft['nama_pasien']; ?></td>
                                <td><?= $dft['no_rg']; ?></td>
                                <?php
                                // Mengatur lokal ke bahasa Indonesia
                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                ?>
                                <td><?= $formatter->format($dft['tgl_periksa']); ?></td>
                                <td><?= $dft['nama_dokter']; ?></td>
                                <td>
                                    <?php if ($dft['status'] == 'Belum periksa'): ?>
                                        <span class="badge text-bg-secondary">Belum periksa</span>
                                    <?php elseif ($dft['status'] == 'Sedang periksa'): ?>
                                        <span class="badge text-bg-success">Sedang periksa</span>
                                    <?php elseif ($dft['status'] == 'Selesai periksa'): ?>
                                        <span class="badge text-bg-danger">Selesai periksa</span>
                                    <?php else: ?>
                                        <?= $dft['status']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detailDataPasienDaftar_<?= $dft['no_rg']; ?>">
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

<!-- Modal untuk melihat detail data pasien di pendaftaran -->
<?php foreach ($daftar as $dft) : ?>
    <div class="modal fade" id="detailDataPasienDaftar_<?= $dft['no_rg']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailDataPasienDaftarLabel_<?= $dft['no_rg']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailDataPasienDaftarLabel_<?= $dft['no_rg']; ?>">Detail Data Pasien Di Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Nomor Pendaftaran</span>
                                <div class="card p-1">
                                    <?= $dft['no_rg']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Tanggal Pendaftaran</span>
                                <div class="card p-1">
                                    <?php
                                    // Mengatur lokal ke bahasa Indonesia
                                    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                    ?>
                                    <?= $formatter->format($dft['tgl_pendaftaran']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Status</span>
                                <div class="card p-1">
                                    <?= $dft['status']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Tanggal Periksa</span>
                                <div class="card p-1">
                                    <?php
                                    // Mengatur lokal ke bahasa Indonesia
                                    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                    ?>
                                    <?= $formatter->format($dft['tgl_periksa']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Nomor NIK</span>
                                <div class="card p-1">
                                    <?= $dft['nik']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Nama Dokter</span>
                                <div class="card p-1">
                                    <?= $dft['nama_dokter']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <span>Alamat</span>
                                <div class="card p-1">
                                    <?= $dft['alamat']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span>Nama suami</span>
                                <div class="card p-1">
                                    <?= $dft['suami']; ?>
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