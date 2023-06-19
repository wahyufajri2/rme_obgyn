<div class="content-wrapper bg-gray-200">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="text-gray-800"><?= $title; ?></h3>
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
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#entriPasienAsesment"><i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Entry</button>
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
<div class="modal fade" id="entriPasienAsesment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="entriPasienAsesmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title text-white" id="entriPasienAsesmentLabel">Entri Pasien Asesment Kebidanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bidan/entriKebidanan'); ?>" method="post">
                <div class="modal-body bg-gray-500">
                    <p style="text-align:center;"><strong>Kop Surat</strong></p>
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