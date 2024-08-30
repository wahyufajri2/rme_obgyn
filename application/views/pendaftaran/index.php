<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('pendaftaran'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex">
                    <p class="fw-semibold">*Jika NIK belum ada, <strong><a href="<?= base_url('pendaftaran/masterPasien'); ?>" style="color: inherit; text-decoration: none;">daftarkan pasein!</a></strong>. Jika sudah ada, <strong><a href="<?= base_url('pendaftaran/masterPasien'); ?>" style="color: inherit; text-decoration: none;">daftarkan periksa!</a></strong></p>
                </div>
            </div>
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
                            <th scope="col">Tanggal daftar</th>
                            <th scope="col">Nomor daftar</th>
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
                                <td><?= $dft['nik']; ?></td>
                                <?php
                                // Mengatur lokal ke bahasa Indonesia
                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                ?>
                                <td><?= $formatter->format($dft['tgl_pendaftaran']); ?></td>
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
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahDataPeriksaPasien_<?= $dft['no_rg']; ?>">
                                        <i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Ubah
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

    <!-- Modal ubah periksa pasien di pendaftaran -->
    <div class="modal fade" id="ubahDataPeriksaPasien_<?= $dft['no_rg']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahDataPeriksaPasienLabel_<?= $dft['no_rg']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataPeriksaPasienLabel_<?= $dft['no_rg']; ?>">Daftarkan periksa pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pendaftaran/tambahPasien'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="number" class="form-control" id="nik" name="nik" value="<?= isset($dft['nik']) ? $dft['nik'] : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_pasien" class="form-label">Nama pasien</label>
                                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= isset($dft['nama_pasien']) ? $dft['nama_pasien'] : ''; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="suami" class="form-label">Nama suami</label>
                                    <input type="text" class="form-control" id="suami" name="suami" value="<?= isset($dft['suami']) ? $dft['suami'] : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= isset($dft['alamat']) ? $dft['alamat'] : ''; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id" class="form-label">Nama Dokter</label>
                            <select name="id" id="id" class="form-select">
                                <option value="">Pilih Dokter</option>
                                <?php foreach ($daftar_dokter as $dk) : ?>
                                    <option value="<?= $dk['id']; ?>"><?= $dk['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_periksa" class="form-label">Tanggal periksa</label>
                            <input type="date" class="form-control flatpickr" id="tgl_periksa" name="tgl_periksa" value="<?= set_value('tgl_periksa'); ?>">
                            <?= form_error('tgl_periksa', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-floppy-disk"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>