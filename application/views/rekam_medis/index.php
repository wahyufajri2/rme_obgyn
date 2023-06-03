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
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <button type="button" class="btn btn-outline-primary btn-lg mb-3 ml-3" data-toggle="modal" data-target="#newTambahPasienModal">Added the Patient</button>
          </div>
          <div class="col-sm-12 col-md-6">
            <div id="example2_filter" class="dataTables_filter">
              <label class="col-md-6 d-flex float-right">Search:
                <input type="search" class="form-control form-control-sm" placeholder="Search for..." aria-controls="example2">
              </label>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover table-sm text-center">
              <thead>
                <tr class="table-active">
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
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $dprm['id_pasien']; ?></td>
                    <td><?= $dprm['no_rm']; ?></td>
                    <td><?= $dprm['nama_pasien']; ?></td>
                    <td><?= $dprm['tgl_lahir']; ?></td>
                    <td><?= $dprm['alamat']; ?></td>
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
<div class="modal fade" id="newTambahPasienModal" tabindex="-1" aria-labelledby="TambahPasienModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahPasienModal">Tambah Data Pasien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('rekam_medis/create'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="id_pasien">ID Pasien</label>
            <input type="number" class="form-control form-control-sm" id="id_pasien" name='id_pasien'>
          </div>
          <div class="form-group">
            <label for="no_rm">No Rekam Medis</label>
            <input type="number" class="form-control form-control-sm" id="no_rm" name='no_rm'>
          </div>
          <div class="form-group">
            <label for="nama_pasien">Nama Pasien</label>
            <input type="text" class="form-control form-control-sm" id="nama_pasien" name='nama_pasien'>
          </div>
          <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control form-control-sm" id="tgl_lahir" name='tgl_lahir'>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control form-control-sm" id="alamat" name='alamat'>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>