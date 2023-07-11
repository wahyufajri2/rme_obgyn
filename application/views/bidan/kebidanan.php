<div class="content-wrapper bg-gray-200">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <?= $this->session->flashdata('message'); ?>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#TambahPasienAsesment"><i class="fas fa-solid fa-circle-plus fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tambah Pasien</button> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="table-active">
                                        <th>No</th>
                                        <th>No Rg</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($Kebidanan as $kbd) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $kbd['no_rg']; ?></td>
                                            <td><?= $kbd['no_rm']; ?></td>
                                            <td><?= $kbd['nama_pasien']; ?></td>
                                            <td><?= $kbd['alamat']; ?></td>
                                            <td><?= $kbd['status']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#EntriPasienAsesment"><i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Entry</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-clock-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Riwayat</button>
                                                <a class="btn btn-outline-warning btn-sm" href="<?= base_url('bidan/printKebidanan'); ?>" target="_blank"><i class="fas fa-solid fa-print fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Print</a>
                                                <a class="btn btn-outline-danger btn-sm" href="<?= base_url('bidan/pdfKebidanan'); ?>" target="_blank"><i class="fas fa-solid fa-file-pdf fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> pdf</a>
                                                <a class="btn btn-outline-success btn-sm" href="<?= base_url('bidan/excelKebidanan'); ?>"><i class="fas fa-solid fa-file-excel fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> excel</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

</div>
<!-- End of Main Content -->

<!-- Modal Entri -->
<div class="modal fade" id="EntriPasienAsesment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="EntriPasienAsesmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title text-white" id="EntriPasienAsesmentLabel">Entri Pasien Asesment Kebidanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bidan/entriKebidanan'); ?>" method="post">
                <div style="font-size:14px;" class="modal-body bg-gray-500">
                    <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Kop Surat</strong></p>
                    <div class="form-row">
                        <div class="col">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien">
                        </div>
                        <div class="col">
                            <label for="no_rm">No. MR</label>
                            <input type="number" class="form-control form-control-sm" id="no_rm" name="no_rm">
                        </div>
                        <div class="col">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir">
                        </div>
                    </div>
                    <div class="p-1 bg-gray-800 text-gray-200 text-center rounded" style="font-size:20px; margin-bottom: 15px; margin-top: 15px; "><strong>ASESMEN ASUHAN KEBIDANAN GINEKOLOGI</strong></div>
                    <div class="form-row">
                        <div class="col-md">
                            <label for="suami">Nama Suami</label>
                            <input type="text" class="form-control form-control-sm" id="suami" name="suami">
                        </div>
                        <div class="col-md">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control form-control-sm" id="alamat" name="alamat">
                        </div>
                    </div>
                    <hr color="gray">
                    <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Alasan Masuk</strong></p>
                    <div class="form-group">
                        <label for="keluhanPasien">Keluhan Utama / Riwayat Keluhan saat ini</label>
                        <textarea class="form-control form-control-sm" id="keluhanPasien" rows="1"></textarea>
                    </div>
                    <hr color="gray">
                    <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Kesehatan</strong></p>
                    <div class="form-row">
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">Tidak pernah opname</label>
                        </div>
                        <div class="col-md-5 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Pernah Opname dengan sakit :</label>
                        </div>
                        <div class="col-md-4 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Di RS :</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">Pernah Operasi</label>
                        </div>
                        <div class="col-md-5 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                        </div>
                        <div class="col-md-4 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Pasca Operasi Hari Ke :</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">Obat yang di bawa :</label>
                        </div>
                    </div>
                    <hr color="gray">
                    <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Alergi</strong></p>
                    <div class="form-row">
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">Tidak ada</label>
                        </div>
                        <div class="col-md-9 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Ada, sebutkan! :</label>
                        </div>
                    </div>
                    <hr color="gray">
                    <p style="text-align:center; margin-bottom:10px; margin-top:-10px;"><strong>Nyeri</strong></p>
                    <div class="form-row">
                        <div class="col-md-1 form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio1">Nyeri :</label>
                        </div>
                        <div class="col-md-3 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                        </div>
                        <div class="col-md-7 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Ya , bila ya lanjutkan dengan deskripsi:</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-1 form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio1">Provoke :</label>
                        </div>
                        <div class="col-md-3 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Ruda paksa</label>
                        </div>
                        <div class="col-md-7 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Lainnya :</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-1 form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio1">Quality :</label>
                        </div>
                        <div class="col-md-3 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Seperti ditusuk-tusuk</label>
                        </div>
                        <div class="col-md-2 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Seperti terbakar</label>
                        </div>
                        <div class="col-md-3 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Seperti tertimpa beban</label>
                        </div>
                        <div class="col-md-1 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Ngilu</label>
                        </div>
                        <div class="col-md-1 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2"></label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-1 form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio1">Region :</label>
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
                            <label class="form-check-label" for="inlineRadio1">Time :</label>
                        </div>
                        <div class="col-md-3 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Kadang-kadang</label>
                        </div>
                        <div class="col-md-2 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Sering</label>
                        </div>
                        <div class="col-md-3 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Menetap</label>
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
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="col-md-2 form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option2">
                                            <label class="form-check-label" for="inlineRadio4">4</label>
                                        </div>
                                        <div class="col-md-2 form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio6" value="option3">
                                            <label class="form-check-label" for="inlineRadio6">6</label>
                                        </div>
                                        <div class="col-md-2 form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio8" value="option2">
                                            <label class="form-check-label" for="inlineRadio8">8</label>
                                        </div>
                                        <div class="col-md-2 form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio20" value="option3">
                                            <label class="form-check-label" for="inlineRadio10">10</label>
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
                                        <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Tidak ada penurunan BB</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Tidak yakin /Tidak tahu/ Baju terasa longgar</label>
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
                                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio3" value="option2">
                                            <label class="form-check-label" for="inlineRadio3">1-5 kg</label>
                                        </div>
                                        <div class="col-md-2 form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio4" value="option2">
                                            <label class="form-check-label" for="inlineRadio4">6-10 kg</label>
                                        </div>
                                        <div class="col-md-2 form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio5" value="option2">
                                            <label class="form-check-label" for="inlineRadio5">11-15 kg</label>
                                        </div>
                                        <div class="col-md-2 form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio6" value="option2">
                                            <label class="form-check-label" for="inlineRadio6"> >15 kg</label>
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
                            <label class="form-control-label" for="basic-addon1">Umur menarche</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Umur menarche..." aria-label="Umur menarche..." aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="basic-addon1">Tahun</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-control-label" for="basic-addon1">Umur menarche</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Lamanya Haid..." aria-label="Lamanya Haid..." aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="basic-addon2">Hari</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-control-label" for="basic-addon1">Umur menarche</label>
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
                            <label class="form-control-label" for="basic-addon1">HPHT</label>
                            <div class="input-group input-group-sm">
                                <input type="date" class="form-control" placeholder="Hari Pertama Haid Terakhir..." aria-label="Hari Pertama Haid Terakhir..." aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="basic-addon1">Tanggal</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-control-label" for="basic-addon1">HPL</label>
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
                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio3" value="option2">
                            <label class="form-check-label" for="inlineRadio3">Dismenorhoe</label>
                        </div>
                        <div class="col-md-2 form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio4" value="option2">
                            <label class="form-check-label" for="inlineRadio4">Spotting</label>
                        </div>
                        <div class="col-md-2 form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio5" value="option2">
                            <label class="form-check-label" for="inlineRadio5">Menorrhagia</label>
                        </div>
                        <div class="col-md-2 form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio6" value="option2">
                            <label class="form-check-label" for="inlineRadio6">Metrorhagia</label>
                        </div>
                    </div>
                    <hr color="gray">
                    <p style="text-align:center; margin-bottom:auto; margin-top:-10px;"><strong>Riwayat Perkawinan</strong></p>
                    <div class="form-row mt-3">
                        <div class="col-md-2 form-check form-check-inline">
                            <label class="form-check-label">Status Perkawinan</label>
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
                            <label class="form-check-label">Jumlah Perkawinan</label>
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
                            <label class="form-check-label">Usia Perkawinan</label>
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
                            <label class="form-control-label" for="basic-addon1">Metode KB yang pernah dipakai</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Nama metode KB yang pernah dipakai..." aria-label="Nama metode KB yang pernah dipakai..." aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-control-label" for="basic-addon1">Lama</label>
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
                            <label for="suami">BAK</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Buang Air Kecil..." aria-label="Buang Air Kecil..." aria-describedby="bak">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="bak">cc/hari</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label for="warnaBAK">Warna</label>
                            <input type="text" class="form-control form-control-sm" id="warnaBAK" name="warnaBAK">
                        </div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-md">
                            <label for="suami">BAB</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Buang Air Besar..." aria-label="Buang Air Besar..." aria-describedby="bab">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="bab">kali/hari</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label for="karaktekBAB">Karakteristik</label>
                            <input type="text" class="form-control form-control-sm" id="karaktekBAB" name="karaktekBAB">
                        </div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-md">
                            <label for="keluhanEliminasi">Keluhan</label>
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
                            <label for="suami">Tidur Malam</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Durasi tidur malam..." aria-label="Durasi tidur malam..." aria-describedby="durasiTidurMalam">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="durasiTidurMalam">jam/hari</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="suami">Tidur Siang</label>
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
                            <label for="keluhanIstirahat">Keluhan</label>
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
                            <label class="mb-0" for="kesadaran">Kesadaran</label>
                            <input type="text" class="form-control form-control-sm" id="kesadaran" name="kesadaran">
                        </div>
                        <div class="col-md">
                            <label class="mb-0" for="suami">BB</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Berat Badan..." aria-label="Berat Badan..." aria-describedby="beratBadan">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="beratBadan">kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="mb-0" for="suami">TB</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Tinggi Badan..." aria-label="Tinggi Badan..." aria-describedby="tinggiBadan">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="tinggiBadan">cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="mb-0" for="lla">LLA</label>
                            <input type="text" class="form-control form-control-sm" id="lla" name="lla">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col-md">
                            <label class="mb-0" for="suami">TD</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Tekanan Darah..." aria-label="Tekanan Darah..." aria-describedby="tekananDarah">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="tekananDarah">mmHg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="mb-0" for="suami">Nadi</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Denyut Nadi..." aria-label="Denyut Nadi..." aria-describedby="denyutNadi">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="denyutNadi">x/mnt</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="mb-0" for="suami">Suhu Badan</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" placeholder="Suhu Badan..." aria-label="Suhu Badan..." aria-describedby="suhuBadan">
                                <div class="input-group-append">
                                    <span class="input-group-text mr-3" id="suhuBadan">℃</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="mb-0" for="suami">Respirasi</label>
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
                            <label class="form-check-label">Kepala</label>
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
                            <label class="form-check-label">Muka</label>
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
                            <label class="form-check-label">Mata</label>
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
                            <label class="form-check-label">Hidung</label>
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
                            <label class="form-check-label">Mulut</label>
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
                            <label class="form-check-label">Leher</label>
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
                            <label class="form-check-label">Payudara</label>
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
                </div>
                <div class="modal-footer justify-content-between bg-gray-600">
                    <div>
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                        <button type="reset" class="btn btn-warning"><i class="fas fa-solid fa-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Reset</button>
                    </div>
                    <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-circle-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.End of modal entri -->