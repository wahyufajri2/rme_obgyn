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
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#TambahPasienAsesment"><i class="fas fa-solid fa-circle-plus fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tambah Pasien</button>
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
                                                <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-print fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Print</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-file-pdf fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> pdf</button>
                                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-file-excel fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> excel</button>
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
                <div class="modal-body bg-gray-500">
                    <p style="text-align:center; margin-bottom:auto;"><strong>Kop Surat</strong></p>
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
                    <hr>
                    <div class="form-row">
                        <div class="col">
                            <label for="suami">Nama Suami</label>
                            <input type="text" class="form-control form-control-sm" id="suami" name="suami">
                        </div>
                        <div class="col">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control form-control-sm" id="alamat" name="alamat">
                        </div>
                    </div>
                    <hr>
                    <p style="text-align:center; margin-bottom:auto;"><strong>Alasan Masuk</strong></p>
                    <div class="form-group">
                        <label for="keluhanPasien">Keluhan Utama / Riwayat Keluhan saat ini</label>
                        <textarea class="form-control form-control-sm" id="keluhanPasien" rows="1"></textarea>
                    </div>
                    <hr>
                    <p style="text-align:center; margin-bottom:auto;"><strong>Riwayat Kesehatan</strong></p>
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
                    <hr>
                    <p style="text-align:center; margin-bottom:auto;"><strong>Riwayat Alergi</strong></p>
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
                    <hr>
                    <p style="text-align:center; margin-bottom:auto;"><strong>Nyeri</strong></p>
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
                    <hr>
                    <p style="text-align:center; margin-bottom:auto;"><strong>Skrining Gizi</strong></p>
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