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
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newTambahPasienModal"><i class="fas fa-solid fa-circle-plus fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tambah Pasien</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr class="table-active text-center">
                    <th>No</th>
                    <th>ID Pasien</th>
                    <th>No MR</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($DataPasienRM as $dprm) : ?>
                    <tr>
                      <td class="text-center" scope="row"><?= $i; ?></td>
                      <td class="text-center"><?= $dprm['id_pasien']; ?></td>
                      <td class="text-center"><?= $dprm['no_rm']; ?></td>
                      <td class="text-center"><?= $dprm['nama_pasien']; ?></td>
                      <td class="text-center"><?= $dprm['tgl_lahir']; ?></td>
                      <td class="text-center"><?= $dprm['alamat']; ?></td>
                      <td>
                        <div class="text-center">
                          <a href="" alt="Entri Data" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Entri</a>
                          <a href="#" class="btn btn-outline-success btn-sm text-center" data-toggle="modal" data-target="#EditPasienRMModal<?php echo $dprm['id_pasien']; ?>"><i class="fas fa-solid fa-clock-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Riwayat</a>
                          <a href="<?= base_url(); ?>Rekam_Medis/deletePasienRM/<?= $dprm['id_pasien']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah yakin menghapus data ini?');"><i class="fas fa-solid fa-trash-can fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Hapus</a>
                        </div>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="EditPasienRMModal<?php echo $dprm['id_pasien']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="EditPasienModal" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <form action="<?php echo base_url(); ?>Rekam_Medis/editPasienRM/<?php echo $dprm['id_pasien']; ?>" method="post">
                              <div class="modal-content">
                                <div class="modal-header bg-gradient-secondary">
                                  <h5 class="modal-title" id="EditPasienModal">Edit Master Data Pasien <strong><?php echo $dprm['nama_pasien']; ?></strong></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body bg-gray-500">
                                  <input type="hidden" name="id_pasien" value="<?php echo $dprm['id_pasien']; ?>">
                                  <div class="form-group">
                                    <label class="required" for="id_pasien">ID Pasien</label>
                                    <input type="number" class="form-control form-control-sm" id="id_pasien" name="id_pasien" value="<?php echo $dprm['id_pasien']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="required" for="no_rm">No Rekam Medis</label>
                                    <input type="number" class="form-control form-control-sm" id="no_rm" name="no_rm" value="<?php echo $dprm['no_rm']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="required" for="nama_pasien">Nama Pasien</label>
                                    <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" value="<?php echo $dprm['nama_pasien']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="required" for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir" value="<?php echo $dprm['tgl_lahir']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="required" for="alamat">Alamat</label>
                                    <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" value="<?php echo $dprm['alamat']; ?>">
                                  </div>
                                </div>
                                <div class="modal-footer justify-content-between bg-gray-600">
                                  <div>
                                    <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                                    <button type="reset" class="btn btn-warning"><i class="fas fa-solid fa-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Reset</button>
                                  </div>
                                  <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-circle-plus"></i> Ubah</button>
                                </div>
                            </form>
                          </div>
                        </div>
                        <!-- End of Edit Modal -->

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

<!-- Modal Tambah -->
<div class="modal fade" id="newTambahPasienModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="TambahPasienModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-gradient-secondary">
        <h5 class="modal-title" id="TambahPasienModal">Tambah Data Pasien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('rekam_medis/createPasienRM'); ?>" method="post">
        <div class="modal-body bg-gray-500">
          <div class="form-group">
            <label class="required" for="id_pasien">ID Pasien</label>
            <input type="number" class="form-control form-control-sm" id="id_pasien" name='id_pasien'>
          </div>
          <div class="form-group">
            <label class="required" for="no_rm">No Rekam Medis</label>
            <input type="number" class="form-control form-control-sm" id="no_rm" name='no_rm'>
          </div>
          <div class="form-group">
            <label class="required" for="nama_pasien">Nama Pasien</label>
            <input type="text" class="form-control form-control-sm" id="nama_pasien" name='nama_pasien'>
          </div>
          <div class="form-group">
            <label class="required" for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control form-control-sm" id="tgl_lahir" name='tgl_lahir'>
          </div>
          <div class="form-group">
            <label class="required" for="alamat">Alamat</label>
            <input type="text" class="form-control form-control-sm" id="alamat" name='alamat'>
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
<!-- End of Modal Tambah -->