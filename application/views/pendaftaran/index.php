<div class="content-wrapper bg-gray-200">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
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
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newTambahKunjunganModal">Tambah Kunjungan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="table-active">
                                        <th>No</th>
                                        <th>No RM</th>
                                        <th>No RG</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>Dokter</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($Kunjungan as $kjg) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $kjg['no_rm']; ?></td>
                                            <td><?= $kjg['no_rg']; ?></td>
                                            <td><?= $kjg['nama_pasien']; ?></td>
                                            <td><?= $kjg['alamat']; ?></td>
                                            <td><?= $kjg['nama_dokter']; ?></td>
                                            <td><?= $kjg['periksa_tgl']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-pen-to-square"></i> Entry</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-clock-rotate-left"></i> History</button>
                                                <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-print"></i> Print</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-file-pdf"></i> pdf</button>
                                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-file-excel"></i> excel</button>
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

<!-- Modal -->
<div class="modal fade" id="newTambahKunjunganModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="TambahKunjunganModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahKunjunganModal">Tambah Data Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pendaftaran/createKunjungan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_pasien">No Rekam Medis</label>
                        <input type="number" class="form-control form-control-sm" id="id_pasien" name='id_pasien'>
                    </div>
                    <div class="form-group">
                        <label for="no_rm">No Registrasi</label>
                        <input type="number" class="form-control form-control-sm" id="no_rm" name='no_rm'>
                    </div>
                    <div class="form-group">
                        <label for="nama_pasien">Nama Pasien</label>
                        <input type="text" class="form-control form-control-sm" id="nama_pasien" name='nama_pasien'>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control form-control-sm" id="alamat" name='alamat'>
                    </div>
                    <div class="form-group">
                        <label for="dokter_id">Dokter</label>
                        <select name="id_dokter" id="id_dokter" class="form-control">
                            <option value="">Pilih Dokter</option>
                            <?php foreach ($dokter as $dr) : ?>
                                <option value="<?= $dr['id_dokter']; ?>"><?= $dr['nama_dokter']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="periksa_tgl">Tanggal Periksa</label>
                        <input type="date" class="form-control form-control-sm" id="periksa_tgl" name='periksa_tgl'>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"><i class="fas fa-solid fa-circle-xmark"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-solid fa-circle-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>