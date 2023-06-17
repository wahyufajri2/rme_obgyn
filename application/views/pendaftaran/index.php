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
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newTambahKunjunganModal"><i class="fas fa-solid fa-circle-plus fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tambah Kunjungan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="table-active">
                                        <th>ID Kunjungan</th>
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
                                            <!-- <th scope="row"><?= $i; ?></th> -->
                                            <td><?= $kjg['id_kunjungan']; ?></td>
                                            <td><?= $kjg['no_rm']; ?></td>
                                            <td><?= $kjg['no_rg']; ?></td>
                                            <td><?= $kjg['nama_pasien']; ?></td>
                                            <td><?= $kjg['alamat']; ?></td>
                                            <td><?= $kjg['nama_dokter']; ?></td>
                                            <td><?= $kjg['periksa_tgl']; ?></td>
                                            <td>
                                                <a href="" alt="Entri Data" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Entri</a>
                                                <!-- <a href="" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-clock-rotate-left"></i> Riwayat</a> -->
                                                <a href="<?= base_url(); ?>Pendaftaran/editPasienRM/<?= $kjg['id_kunjungan']; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-solid fa-clock-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Riwayat</a>
                                                <a href="<?= base_url(); ?>Pendaftaran/deleteKunjungan/<?= $kjg['id_kunjungan']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah yakin menghapus data ini?');"><i class="fas fa-solid fa-trash-can fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Hapus</a>


                                                <!-- <a href="" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-print"></i> Print</a>
                                                <a href="" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-file-pdf"></i> pdf</a>
                                                <a href="" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-file-excel"></i> excel</a> -->
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
                        <label for="id_kunjungan">ID Kunjungan</label>
                        <input type="number" class="form-control form-control-sm" id="id_kunjungan" name='id_kunjungan'>
                    </div>
                    <div class="form-group">
                        <label for="no_rm">No Rekam Medis</label>
                        <select name="no_rm" id="no_rm" class="form-control form-control-sm">
                            <option value="">Pilih No RM</option>
                            <?php foreach ($pasien as $psn) : ?>
                                <option value="<?= $psn['id_pasien']; ?>"><?= $psn['no_rm']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_rg">No Registrasi</label>
                        <input type="number" class="form-control form-control-sm" id="no_rg" name='no_rg'>
                    </div>
                    <div class="form-group">
                        <label for="nama_pasien">Nama Pasien</label>
                        <select name="nama_pasien" id="nama_pasien" class="form-control form-control-sm">
                            <option value="">Pilih Pasien</option>
                            <?php foreach ($pasien as $psn) : ?>
                                <option value="<?= $psn['id_pasien']; ?>"><?= $psn['nama_pasien']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <select name="alamat" id="alamat" class="form-control form-control-sm">
                            <option value="">Pilih Alamat</option>
                            <?php foreach ($pasien as $psn) : ?>
                                <option value="<?= $psn['id_pasien']; ?>"><?= $psn['alamat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dokter_id">Dokter</label>
                        <select name="id_dokter" id="id_dokter" class="form-control form-control-sm">
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
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-circle-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>