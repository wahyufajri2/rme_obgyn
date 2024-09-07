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
                                <td>
                                    <?php if ($kbd['status'] == 'Belum periksa'): ?>
                                        <span class="badge text-bg-secondary">Belum periksa</span>
                                    <?php elseif ($kbd['status'] == 'Sedang periksa'): ?>
                                        <span class="badge text-bg-success">Sedang periksa</span>
                                    <?php elseif ($kbd['status'] == 'Selesai periksa'): ?>
                                        <span class="badge text-bg-danger">Selesai periksa</span>
                                    <?php else: ?>
                                        <?= $kbd['status']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#adminlihatRekamMedis_<?= $kbd['no_rg']; ?>">
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

<!-- Awal modal lihat rekam medis -->

<!-- Modal Lihat Rekam Medis -->
<?php foreach ($Kebidanan as $kbd) : ?>
    <div class="modal fade" id="adminlihatRekamMedis_<?= $kbd['no_rg']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="adminlihatRekamMedisLabel_<?= $kbd['no_rg']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminlihatRekamMedisLabel_<?= $kbd['no_rg']; ?>">Lihat Rekam Medis Pasien</h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <?php foreach ($Asesmen as $asm) : ?>
                    <div style="font-size:14px;" class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="mb-0" for="no_rm">No. RM</label>
                                    <input type="text" class="form-control form-control-sm" id="no_rm" name="no_rm" value="<?= isset($kbd['no_rm']) ? $kbd['no_rm'] : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-0" for="no_rg">No. RG</label>
                                    <input type="text" class="form-control form-control-sm" id="no_rg" name="no_rg" value="<?= isset($kbd['no_rg']) ? $kbd['no_rg'] : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-0" for="nama_pasien">Nama Pasien</label>
                                    <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" value="<?= isset($kbd['nama_pasien']) ? $kbd['nama_pasien'] : ''; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label mb-0">Tanggal lahir</label>
                                    <input type="text" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir" value="<?php
                                                                                                                                    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                                                                                                                    ?>
<?= isset($kbd['tgl_lahir']) ? $formatter->format($kbd['tgl_lahir']) : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-0" for="suami">Nama Suami</label>
                                    <input type="text" class="form-control form-control-sm" id="suami" name="suami" value="<?= isset($kbd['suami']) ? $kbd['suami'] : ''; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-0" for="alamat">Alamat</label>
                                    <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" value="<?= isset($kbd['alamat']) ? $kbd['alamat'] : ''; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="p-1 text-center rounded" style="font-size:20px; margin-bottom: 15px; margin-top: 15px; "><strong>ASESMEN OBSTETRI DAN GINEKOLOGI</strong></div>
                        <hr color="gray">
                        <div class="form-group">
                            <label class="form-label mb-0" for="alasan_masuk">Keluhan Utama / Riwayat Keluhan saat ini</label>
                            <input type="text" class="form-control form-control-sm" id="alasan_masuk" name="alasan_masuk" value="<?= isset($asm['alasan_masuk']) ? $asm['alasan_masuk'] : ''; ?>"></input>
                        </div>
                        <div class="form-group">
                            <label class="form-label mb-0" for="deskripsi_opname">Deskrpsi Opname</label>
                            <input type="text" class="form-control form-control-sm" id="deskripsi_opname" name="deskripsi_opname" value="<?= isset($asm['deskripsi_opname']) ? $asm['deskripsi_opname'] : ''; ?>"></input>
                        </div>
                        <div class="form-group">
                            <label class="form-label mb-0" for="deskripsi_alergi">Deskripsi Alergi</label>
                            <input type="text" class="form-control form-control-sm" id="deskripsi_alergi" name="deskripsi_alergi" value="<?= isset($asm['deskripsi_alergi']) ? $asm['deskripsi_alergi'] : ''; ?>"></input>
                        </div>
                        <div class="form-group">
                            <label class="form-label mb-0" for="deskripsi_nyeri">Deskripsi Nyeri</label>
                            <input type="text" class="form-control form-control-sm" id="deskripsi_nyeri" name="deskripsi_nyeri" value="<?= isset($asm['deskripsi_nyeri']) ? $asm['deskripsi_nyeri'] : ''; ?>"></input>
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal lihat rekam medis -->