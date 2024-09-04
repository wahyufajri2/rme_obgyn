<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2">Catat <?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('bidan/bidanRekamMedis'); ?>">Beranda</a></li>
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
                            <th scope="col">No RM</th>
                            <th scope="col">No Registrasi</th>
                            <th scope="col">Tanggal Periksa</th>
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
                                <td><?= $kbd['no_rg']; ?></td>
                                <?php
                                // Mengatur lokal ke bahasa Indonesia
                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                ?>

                                <td><?= $formatter->format($kbd['tgl_periksa']); ?></td>
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
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#catatRekamMedis_<?= $kbd['no_rg']; ?>">
                                        <i class="fas fa-solid fa-notes-medical fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Catat
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#detailRekamMedis">
                                        <i class="fas fa-solid fa-file-lines fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Detail
                                    </button>
                                    <a class="btn btn-danger btn-sm" href="<?= base_url('bidan/pdfRekamMedis/' . $kbd['no_rg']); ?>" target="_blank">
                                        <i class="fas fa-solid fa-file-pdf fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Cetak
                                    </a>
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

<!-- Awal modal di rekam medis kebidanan -->

<!-- Modal Catat Rekam Medis -->
<?php foreach ($Kebidanan as $kbd) : ?>
    <div class="modal fade" id="catatRekamMedis_<?= $kbd['no_rg']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="catatRekamMedisLabel_<?= $kbd['no_rg']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catatRekamMedisLabel_<?= $kbd['no_rg']; ?>">Catat Rekam Medis Pasien</h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('bidan/entriKebidanan'); ?>" method="post">
                    <div style="font-size:14px;" class="modal-body">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Kop Surat</strong></p>
                        <div class="form-row">
                            <div class="col">
                                <label class="required mb-0" for="nama_pasien">Nama Pasien</label>
                                <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" value="<?= isset($kbd['nama_pasien']) ? $kbd['nama_pasien'] : ''; ?>" readonly>
                            </div>
                            <div class="col">
                                <label class="required mb-0" for="no_rm">No. RM</label>
                                <input type="text" class="form-control form-control-sm" id="no_rm" name="no_rm" value="<?= isset($kbd['no_rm']) ? $kbd['no_rm'] : ''; ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="tgl_lahir" class="required mb-0">Tanggal lahir</label>
                                <input type="text" class="form-control flatpickr" id="tgl_lahir" name="tgl_lahir" value="<?php
                                                                                                                            $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                                                                                                            ?>
                <?= isset($kbd['tgl_lahir']) ? $formatter->format($kbd['tgl_lahir']) : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="p-1 text-center rounded" style="font-size:20px; margin-bottom: 15px; margin-top: 15px; "><strong>ASESMEN ASUHAN KEBIDANAN GINEKOLOGI</strong></div>
                        <div class="form-row">
                            <div class="col-md">
                                <label class="required mb-0" for="suami">Nama Suami</label>
                                <input type="text" class="form-control form-control-sm" id="suami" name="suami" value="<?= isset($kbd['suami']) ? $kbd['suami'] : ''; ?>" readonly>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="alamat">Alamat</label>
                                <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" value="<?= isset($kbd['alamat']) ? $kbd['alamat'] : ''; ?>" readonly>
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Alasan Masuk</strong></p>
                        <div class="form-group">
                            <label class="required mb-0" for="keluhan_pasien">Keluhan Utama / Riwayat Keluhan saat ini</label>
                            <textarea class="form-control form-control-sm" id="keluhan_pasien" name="keluhan_pasien" value="" rows="1"></textarea>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Kesehatan</strong></p>
                        <div class="form-row">
                            <div class="col form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tdk_pernah_opname" id="tdk_pernah_opname" value="">
                                <label class="form-check-label" for="tdk_pernah_opname">Tidak pernah opname</label>
                            </div>
                            <div class="col-md-5 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pernah_opname" id="pernah_opname" value="">
                                <label class="form-check-label" for="pernah_opname">Pernah Opname dengan sakit :&nbsp</label>
                                <input type="text" name="pernah_opname" id="pernah_opname" value="" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="rs_opname" id="rs_opname" value="">
                                <label class="form-check-label" for="rs_opname">Di RS :&nbsp</label>
                                <input type="text" name="rs_opname" id="rs_opname" value="" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pernah_operasi" id="pernah_operasi" value="">
                                <label class="form-check-label" for="pernah_operasi">Pernah Operasi</label>
                            </div>
                            <div class="col-md-5 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tdk_pernah_operasi" id="tdk_pernah_operasi" value="">
                                <label class="form-check-label" for="tdk_pernah_operasi">Tidak</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pasca_operasi" id="pasca_operasi" value="">
                                <label class="form-check-label" for="pasca_operasi">Pasca Operasi Hari Ke :&nbsp</label>
                                <input type="number" name="pasca_operasi" id="pasca_operasi" value="" placeholder="Diisi dengan angka" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="bawa_obat" id="bawa_obat" value="">
                                <label class="form-check-label" for="bawa_obat">Obat yang di bawa :&nbsp</label>
                                <input type="text" name="bawa_obat" id="bawa_obat" value="" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Alergi</strong></p>
                        <div class="form-row">
                            <div class="col form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox1" value="option1">
                                <label class="form-check-label" for="inlinecheckbox1">Tidak ada</label>
                            </div>
                            <div class="col-md-9 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Ada, sebutkan! :&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:10px; margin-top:-10px;"><strong>Nyeri</strong></p>
                        <div class="form-row">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label" for="inlinecheckbox1">Nyeri :</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Tidak</label>
                            </div>
                            <div class="col-md-7 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Ya , bila ya lanjutkan dengan deskripsi:</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label" for="inlinecheckbox1">Provoke :</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Ruda paksa</label>
                            </div>
                            <div class="col-md-7 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Lainnya :&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label" for="inlinecheckbox1">Quality :</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Seperti ditusuk-tusuk</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Seperti terbakar</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Seperti tertimpa beban</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Ngilu</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label" for="inlinecheckbox1">Region :</label>
                            </div>
                            <label for="inputEmail2" class="col-md-1 col-form-label">Lokasi nyeri</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-sm" id="inputEmail2">
                            </div>
                            <label for="inputEmail3" class="col-md-1 col-form-label">menjalar ke</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-sm" id="inputEmail3">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label" for="inlinecheckbox1">Time :</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Kadang-kadang</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Sering</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                <label class="form-check-label" for="inlinecheckbox2">Menetap</label>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm mt-3">
                            <thead>
                                <tr class="text-center">
                                    <td scope="col">WONG BAKER</td>
                                    <td scope="col">NUMERIC SCALE</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="col-inline">
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                                <label class="form-check-label" for="inlinecheckbox2">2</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox4" value="option2">
                                                <label class="form-check-label" for="inlinecheckbox4">4</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox6" value="option3">
                                                <label class="form-check-label" for="inlinecheckbox6">6</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox8" value="option2">
                                                <label class="form-check-label" for="inlinecheckbox8">8</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox20" value="option3">
                                                <label class="form-check-label" for="inlinecheckbox10">10</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="customRange2">Example range</label>
                                        <input type="range" class="custom-range" min="0" max="10" step="1" id="customRange2">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Skrining Gizi</strong></p>
                        <table class="table table-bordered table-sm mt-3">
                            <tbody>
                                <tr>
                                    <td rowspan="2">Apakah Pasien mengalami penurunan BB dalam 6 bulan terakhir?</td>
                                    <td colspan="2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox1" value="option1">
                                            <label class="form-check-label" for="inlinecheckbox1">Tidak ada penurunan BB</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox2" value="option2">
                                            <label class="form-check-label" for="inlinecheckbox2">Tidak yakin /Tidak tahu/ Baju terasa longgar</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-row">
                                            <div class="col-md-2 form-check form-check-inline">
                                                <label class="form-check-label">Ya, penurunan BB tersebut</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox3" value="option2">
                                                <label class="form-check-label" for="inlinecheckbox3">1-5 kg</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox4" value="option2">
                                                <label class="form-check-label" for="inlinecheckbox4">6-10 kg</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox5" value="option2">
                                                <label class="form-check-label" for="inlinecheckbox5">11-15 kg</label>
                                            </div>
                                            <div class="col-md-2 form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox6" value="option2">
                                                <label class="form-check-label" for="inlinecheckbox6"> >15 kg</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah Asupan makanan berkurang karena tidak ada nafsu makan?</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                            <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                            <label class="form-check-label" for="inlineCheckbox2">Ya</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pasien dengan diagnosis khusus (DM, kemoterapi, hemodialisa, geriatri, immunosupressed)</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                            <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                            <label class="form-check-label" for="inlineCheckbox2">Ya</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr color="gray">
                        <strong>
                            <p style="margin-bottom:auto;">Diisi oleh Dietisien :</p>
                            <p>Sudah dibaca dan diketahui oleh Dietisien, diberitahukan ke Dokter (coret slah satu)</p>
                        </strong>
                        <div class="form-inline mb-5">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" aria-label="Checkbox for following text input">&nbspYa
                                    </div>
                                </div>
                                <span>&nbspTanggal:&nbsp&nbsp</span>
                                <input type="date" class="form-control" aria-label="Text input with checkbox">
                                <span>&nbspJam:&nbsp&nbsp</span>
                                <input type="time" class="form-control" aria-label="Text input with checkbox">
                            </div>
                            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
                            </div>
                        </div>
                        <div class="p-1 bg-gray-800 text-gray-200 text-center rounded" style="font-size:20px; margin-bottom: 15px; margin-top: 15px; "><strong>PENGKAJIAN KHUSUS ASUHAN KEBIDANAN</strong></div>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <div class="py-0.5 bg-gray-700 text-gray-300 rounded border border-secondary" style="display:flex; justify-content:center; font-size:14px; margin-bottom: -13px; margin-top: -10px; "><strong>SUBJEKTIF</strong></div>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                        <p style="text-align:center;"><strong>Riwayat Menstruasi</strong></p>
                        <div class="row">
                            <div class="col">
                                <label class="form-control-label required mb-0" for="basic-addon1">Umur menarche</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Umur menarche..." aria-label="Umur menarche..." aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="basic-addon1">Tahun</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-control-label required mb-0" for="basic-addon1">Umur menarche</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Lamanya Haid..." aria-label="Lamanya Haid..." aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="basic-addon2">Hari</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-control-label required mb-0" for="basic-addon1">Umur menarche</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Ganti pembalut..." aria-label="Ganti pembalut..." aria-describedby="basic-addon3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon3">Kali</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label class="form-control-label required mb-0" for="basic-addon1">HPHT</label>
                                <div class="input-group input-group-sm">
                                    <input type="date" class="form-control" placeholder="Hari Pertama Haid Terakhir..." aria-label="Hari Pertama Haid Terakhir..." aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="basic-addon1">Tanggal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-control-label required mb-0" for="basic-addon1">HPL</label>
                                <div class="input-group input-group-sm">
                                    <input type="date" class="form-control" placeholder="Hari Perkiraan Lahir..." aria-label="Hari Perkiraan Lahir..." aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="basic-addon2">Tanggal</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox3" value="option2">
                                <label class="form-check-label" for="inlinecheckbox3">Dismenorhoe</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox4" value="option2">
                                <label class="form-check-label" for="inlinecheckbox4">Spotting</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox5" value="option2">
                                <label class="form-check-label" for="inlinecheckbox5">Menorrhagia</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="inlinecheckboxOptions" id="inlinecheckbox6" value="option2">
                                <label class="form-check-label" for="inlinecheckbox6">Metrorhagia</label>
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Perkawinan</strong></p>
                        <div class="form-row mt-3">
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label required mb-0">Status Perkawinan</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="kawin" id="kawin" value="option2">
                                <label class="form-check-label" for="kawin">Kawin</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="belumKawin" id="belumKawin" value="option2">
                                <label class="form-check-label" for="belumKawin">Belum Kawin</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="janda" id="janda" value="option2">
                                <label class="form-check-label" for="janda">Janda</label>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label required mb-0">Jumlah Perkawinan</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Istri</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="kawin" id="kawin" value="option2">
                                <label class="form-check-label" for="kawin">1x</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="belumKawin" id="belumKawin" value="option2">
                                <label class="form-check-label" for="belumKawin">2x</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="janda" id="janda" value="option2">
                                <label class="form-check-label" for="janda">>2x</label>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Suami</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="sekali" id="sekali" value="option2">
                                <label class="form-check-label" for="sekali">1x</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="duaKali" id="duaKali" value="option2">
                                <label class="form-check-label" for="duaKali">2x</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="lebihDua" id="lebihDua" value="option2">
                                <label class="form-check-label" for="lebihDua">>2x</label>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label required mb-0">Usia Perkawinan</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Usia pernikahan..." aria-label="Usia pernikahan..." aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="basic-addon1">Tahun</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Kehamilan, Persalinan dan Nifas yang Lalu</strong></p>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Kehamilan Sekarang</strong></p>
                        <p style="text-align:center; margin-top:-5px; margin-bottom:auto;"><i>( Khusus diisi untuk pasien obstetric )</i></p>
                        <div class="form-row mt-3">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Hamil Muda</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="mual" id="mual" value="option2">
                                <label class="form-check-label" for="mual">Mual</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Muntah</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="pendarahan" value="option2">
                                <label class="form-check-label" for="pendarahan">Pendarahan</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Lain-lain:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Hamil Tua</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="kawin" id="kawin" value="option2">
                                <label class="form-check-label" for="kawin">Pusing</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="belumKawin" id="belumKawin" value="option2">
                                <label class="form-check-label" for="belumKawin">Sakit Kepala</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="janda" id="janda" value="option2">
                                <label class="form-check-label" for="janda">Pendarahan</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="janda" id="janda" value="option2">
                                <label class="form-check-label" for="janda">Gerakan anak berkurang</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Lain-lain:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Penyakit Keluarga</strong></p>
                        <div class="form-row mt-3">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Kanker</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Penyakit Hati</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Hipertensi</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">DM</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Penyakit Ginjal</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Penyakit Jiwa</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Kelainan Bawaan</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Hamil Kembar</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">TBC</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Epilepsi</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Alergi</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Lain-lain:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Gynekologi</strong></p>
                        <div class="form-row mt-3">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Infertilitas</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Infeksi Virus</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">PMS</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Cervisitis Cronis</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Endometriosis</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Myoma</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Polip Servix</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Kanker Kandungan</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Operasi kandungan</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Perkosaan</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="muntah" id="muntah" value="option2">
                                <label class="form-check-label" for="muntah">Myoma</label>
                            </div>
                            <div class="col-md-7 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Flour Albus (Gatal ya / Tidak, Berbau ya / Tidak, Warna?):&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Lain-lain:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat KB</strong></p>
                        <div class="form-row mt-3">
                            <div class="col">
                                <label class="form-control-label required mb-0" for="basic-addon1">Metode KB yang pernah dipakai</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Nama metode KB yang pernah dipakai..." aria-label="Nama metode KB yang pernah dipakai..." aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-control-label required mb-0" for="basic-addon1">Lama</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Lama pemakaian..." aria-label="Lama pemakaian..." aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="basic-addon1">Tahun</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md-1.5 form-check form-check-inline">
                                <label class="form-check-label">Komplikasi dari KB :</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="janda" id="janda" value="option2">
                                <label class="form-check-label" for="janda">Pendarahan</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="janda" id="janda" value="option2">
                                <label class="form-check-label" for="janda">PID / Radang Panggul</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Lain-lain:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Pola Eliminasi / Istirahat</strong></p>
                        <div class="form-row mt-3">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Pola Eliminasi : </strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md">
                                <label class="required mb-0" for="suami">BAK</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Buang Air Kecil..." aria-label="Buang Air Kecil..." aria-describedby="bak">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="bak">cc/hari</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="warnaBAK">Warna</label>
                                <input type="text" class="form-control form-control-sm" id="warnaBAK" name="warnaBAK">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md">
                                <label class="required mb-0" for="suami">BAB</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Buang Air Besar..." aria-label="Buang Air Besar..." aria-describedby="bab">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="bab">kali/hari</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="karaktekBAB">Karakteristik</label>
                                <input type="text" class="form-control form-control-sm" id="karaktekBAB" name="karaktekBAB">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md">
                                <label class="required mb-0" for="keluhanEliminasi">Keluhan</label>
                                <input type="text" class="form-control form-control-sm" id="keluhanEliminasi" name="keluhanEliminasi">
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Pola Istirahat : </strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-3">
                                <label class="required mb-0" for="suami">Tidur Malam</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Durasi tidur malam..." aria-label="Durasi tidur malam..." aria-describedby="durasiTidurMalam">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="durasiTidurMalam">jam/hari</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="required mb-0" for="suami">Tidur Siang</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Durasi tidur siang..." aria-label="Durasi tidur siang..." aria-describedby="durasiTidurSiang">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="durasiTidurSiang">jam/hari</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Dengan Obat</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tidak dengan Obat</label>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="keluhanIstirahat">Keluhan</label>
                                <input type="text" class="form-control form-control-sm" id="keluhanIstirahat" name="keluhanIstirahat">
                            </div>
                        </div>
                        <hr color="gray">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <div class="py-0.5 bg-gray-700 text-gray-300 rounded border border-secondary" style="display:flex; justify-content:center; font-size:14px; margin-bottom: -13px; margin-top: -10px; "><strong>OBJEKTIF</strong></div>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Keadaan Umum</strong></p>
                        <div class="form-row mt-2">
                            <div class="col-md">
                                <label class="required mb-0" for="kesadaran">Kesadaran</label>
                                <input type="text" class="form-control form-control-sm" id="kesadaran" name="kesadaran">
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="suami">BB</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Berat Badan..." aria-label="Berat Badan..." aria-describedby="beratBadan">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="beratBadan">kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="suami">TB</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Tinggi Badan..." aria-label="Tinggi Badan..." aria-describedby="tinggiBadan">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="tinggiBadan">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="lla">LLA</label>
                                <input type="text" class="form-control form-control-sm" id="lla" name="lla">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md">
                                <label class="required mb-0" for="suami">TD</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Tekanan Darah..." aria-label="Tekanan Darah..." aria-describedby="tekananDarah">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="tekananDarah">mmHg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="suami">Nadi</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Denyut Nadi..." aria-label="Denyut Nadi..." aria-describedby="denyutNadi">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="denyutNadi">x/mnt</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="suami">Suhu Badan</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Suhu Badan..." aria-label="Suhu Badan..." aria-describedby="suhuBadan">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="suhuBadan">℃</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="required mb-0" for="suami">Respirasi</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Frekuensi Pernapasan..." aria-label="Frekuensi Pernapasan..." aria-describedby="respirasi">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="respirasi">x/mnt</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Pemeriksaan Fisik</strong></p>
                        <div class="form-row mt-3">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label required">Kepala</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="periksaKepala" name="periksaKepala">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label required">Muka</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Ada Cloasma</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tidak Ada Cloasma</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label required">Mata</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Conjunctiva merah</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Conjunctiva Pucat</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Sklera ikteric</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Pandangan kabur</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label required">Hidung</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Ada Polip</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tidak Ada Polip</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label required">Mulut</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Bibir:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Gigi:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label required">Leher</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Pembesaran venajugularis:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Pembesaran kel. Tiroid:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label required">Payudara</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Pengeluaran ASI</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Putting datar/tenggelam</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Puting susu menonjol</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Lain-lain</label>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Inspeksi : </strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Pelebaran vena</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Linea Alba</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Linea Nigra</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Membesar dengan arah memanjang / melebar</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Striae livide</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Striae albican</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Luka bekas operasi</label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Lain-lain:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Extremitas atas</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="extremitasAtas" name="extremitasAtas">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Extremitas bawah</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Tungkai oedema</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tungkai normal</label>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Palpasi (OBSTETRI) :</strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Leopold 1</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Leopold 2</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldDua" name="leopoldDua">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Leopold 3</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldTiga" name="leopoldTiga">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Leopold 4</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldEmpat" name="leopoldEmpat">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Nyeri tekan</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Obsborn test</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Cekungan pada perut</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Massa tumor</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" id="leopoldEmpat" name="leopoldEmpat">
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Ada nyeri tekan</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Tidak ada nyeri tekan</label>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Perkusi :</strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Reflek patella</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">plus(+)</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">min(-)</label>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Pemeriksaan Genetalia :</strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Inspeksi :</strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Pengeluaran per vagina</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Banyaknya:&nbsp&nbsp</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Banyak pengeluaran..." aria-label="Banyak pengeluaran..." aria-describedby="pengeluaranVagina">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="pengeluaranVagina">cc</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Konsistensinya</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Encer</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="denganObatTidur" id="denganObatTidur" value="option2">
                                <label class="form-check-label" for="denganObatTidur">Gumpalan/stolsel</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Keputihan</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Darah</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Darah Lendir</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Inspeksi :</strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Vagina</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Portio</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Merah</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Erosi</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Keputihan/flour albus</label>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label"><strong>Periksa bimanual :</strong></label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Uretra</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Ada infeksi</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tidak ada infeksi</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Vulva</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Ada pembengkakan kelenjar bartolini</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">&nbsp&nbsp&nbsp
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tidak ada pembengkakan kelenjar bartolini</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Vagina</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Licin,</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Ada benjolan</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tidak ada benjolan</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Portio</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Licin,</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">OUE/OUI</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Terbuka</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Tertutup</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Uterus</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Retrofleksi</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Antefleksi</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Adneksa/cavum dauglas</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Fluksus</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">Kandung Kemih</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Penuh</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tanpaObatTidur" id="tanpaObatTidur" value="option2">
                                <label class="form-check-label" for="tanpaObatTidur">Kosong</label>
                            </div>
                        </div>
                        <hr color="gray">
                        <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Pemeriksaan Penunjang</strong></p>
                        <div class="form-row mt-3">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Darah</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Hb:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Gol Dar:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Leukosit:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-0.5">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Trombosit:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">HBsAG:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">GDS</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Urine</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Protein:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">PP Test - (min)</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">PP Test + (plus)</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">USG</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Ekg</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-1 form-check form-check-inline">
                                <label class="form-check-label">Lain-lain</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <hr color="gray">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <div class="py-0.5 bg-gray-700 text-gray-300 rounded border border-secondary" style="display:flex; justify-content:center; font-size:14px; margin-bottom: -13px; margin-top: -10px; "><strong>ANALISA</strong></div>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                        <div class="form-row mt-3">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">G ........ P ........ A ........ hamil .........mg dengan abortus ...............</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Ibu umur......th dengan ................</label>
                            </div>
                        </div>
                        <hr color="gray">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <div class="py-0.5 bg-gray-700 text-gray-300 rounded border border-secondary" style="display:flex; justify-content:center; font-size:14px; margin-bottom: -13px; margin-top: -10px; "><strong>PENATALAKSANAAN</strong></div>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                        <div class="form-row mt-3">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Menginformasikan hasil pemeriksaan,orientasi ruangan,Bidan penanggung jawab dan dokter penanggung jawab</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Kolaborasi dengan dokter, advis&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Edukasi Pasien / Keluarga</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <label class="form-check-label">a. Kesediaan Pasien / keluarga menerima informasi :</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Tidak</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Ya</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">Paraf:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <label class="form-check-label">b. Terdapat hambatan dalam Edukasi :</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Tidak</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Ya</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <label class="form-check-label">Jika ya, sebutkan hambatannya (bisa pilih lebih dari satu):</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Pendengaran</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Penglihatan</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Kognitif</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Fisik</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Budaya</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Emosi</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Bahasa</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Lainnya:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <label class="form-check-label">c. Dibutuhkan penerjemah :</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Tidak</label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Ya.&nbsp&nbsp Jika Ya, sebutkan:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md form-check form-check-inline">
                                <label class="form-check-label">d. Kebutuhan Edukasi ( Pilih topic edukasi pada kotak yang tersedia ) :</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Diagnosa Penyakit</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Obat-obatan</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Diet dan Nutrisi</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Rehabilitasi Medik</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Penggunaan alat-alat medis</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Hakdan Kewajiban Pasien</label>
                            </div>
                            <div class="col-md-6 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Penunggu pasien /pendampingan persalinan oleh suami /keluarga terdekat</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Pasien dianjurkan untuk puasa minimal 4 jam</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Manajemen Nyeri / relaksasi</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Jelaskan tentang KB pasca keguguran :</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-4 form-check form-check-inline">
                                <label class="form-check-label">Pasien setuju KB pasca abortus?</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Setuju</label>
                            </div>
                            <div class="col-md-1 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Tidak</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2.5 form-check form-check-inline">
                                <label class="form-check-label">Langsung informed consent :</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="..." aria-label="..." aria-describedby="pengeluaranVagina">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="pengeluaranVagina">ttd</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Persiapan alat set kuretage, SPo2, dan obat uterustonika</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Kolaborasi dokter anestesi</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Cuci tangan</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Persiapan pasien posisi litotomi dan diberikan O2 2-3 l/mnt</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Dilakukan pembiusan oleh dokter anestesi</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-2.5 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Jam:&nbsp&nbsp</label>
                                <input type="text" name="hamilLain" id="hamilLain" aria-label="Text input with checkbox">
                            </div>
                            <label for="inputEmail3" class="col-md-2.5 col-form-label">dilakukan Tindakan kuretage hasil:</label>
                            <div class="col-md-2.5 form-check form-check-inline">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="..." aria-label="..." aria-describedby="pengeluaranVagina">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="pengeluaranVagina">cc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1.5 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Jaringan di PA</label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Jaringan tidak di PA</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Memberikan injeksi metergin 1 amp ( 0,2 mg) / asam traneksamat 1mp secara IV</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Dilakukan incici</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-2.5 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Dipasang tampon selama?</label>
                            </div>
                            <div class="col-md-3 form-check form-check-inline">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" placeholder="Durasi pasang tampon..." aria-label="Durasi pasang tampon..." aria-describedby="pengeluaranVagina">
                                    <div class="input-group-append">
                                        <span class="input-group-text mr-3" id="pengeluaranVagina">Jam</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Dipasang cateter</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Melakukan Pemeriksaan v/s post curetage / post incici</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">• Tekanan darah</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">• Nadi</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">• Respirasi</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">• SB</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label"></label>
                            </div>
                            <div class="col-md-2 form-check form-check-inline">
                                <label class="form-check-label">• Spo2</label>
                            </div>
                            <div class="col-md-0.5 form-check form-check-inline">
                                <label class="form-check-label">:</label>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control form-control-sm" id="leopoldSatu" name="leopoldSatu">
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Dekontaminasi alat dan tempat</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Cuci tangan</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Memindahkan pasien diruang perawatan setelah Post kuretage / post incici keadaaan umum baik</label>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendarahan" id="hamilLain" value="option2">
                                <label class="form-check-label" for="pendarahan">Dokumentasi</label>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="dokter_id">Bidan jaga</label>
                            <select name="id_dokter" id="id_dokter" class="form-control form-control-sm">
                                <option value="">Pilih bidan</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="dokter_id">Bidan yang melakukan tindakan</label>
                            <select name="id_dokter" id="id_dokter" class="form-control form-control-sm">
                                <option value="">Pilih bidan</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="dokter_id">Dirujuk/ Konsul ke</label>
                            <select name="id_dokter" id="id_dokter" class="form-control form-control-sm">
                                <option value="">Pilih tempat pelayanan kesehatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between bg-gray-600">
                        <div>
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                            <button type="reset" class="btn btn-warning"><i class="fas fa-solid fa-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Reset</button>
                        </div>
                        <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-circle-plus"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal catat rekam medis -->
<!-- Akhir modal rekam medis kebidanan -->