<main>
  <div class="container-fluid px-3">
    <h1 class="mt-2"><?= $title; ?></h1>
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="<?= base_url('pendaftaran/masterPasien'); ?>">Beranda</a></li>
      <li class="breadcrumb-item active"><?= $title; ?></li>
    </ol>
    <hr>
    <div class="card mb-4">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <p class="fw-semibold">*Jika NIK sudah ada, <strong><a href="<?= base_url('pendaftaran'); ?>">daftarkan periksa</a></strong>. Jika belum ada, daftarkan NIK di menu <strong><a href="<?= base_url('pendaftaran/masterPasien'); ?>">Master Data Pasien</a></strong></p>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftarMasterPasien">
            <i class="fa-solid fa-person-circle-plus"></i> Daftarkan pasien
          </button>
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
              <th scope="col">Tanggal lahir</th>
              <th scope="col">Alamat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($DataPasienDaftar as $dpd) : ?>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $dpd['nama_pasien']; ?></td>
                <td><?= $dpd['nik']; ?></td>
                <?php
                // Mengatur lokal ke bahasa Indonesia
                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                ?>

                <td><?= $formatter->format($dpd['tgl_lahir']); ?></td>
                <td><?= $dpd['alamat']; ?></td>
                <td>
                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detailDataPasien_<?= $dpd['nik']; ?>">
                    <i class="fas fa-solid fa-file-lines fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Detail
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahDataPasien_<?= $dpd['nik']; ?>">
                    <i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Ubah
                  </button>
                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#daftarPeriksaPasien">
                    <i class="fas fa-solid fa-bed fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Daftar periksa
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

<!-- Modal tambah data pasien di master data pasien -->
<div class="modal fade" id="daftarMasterPasien" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="daftarMasterPasienLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="daftarMasterPasienLabel">Daftarkan pasien di master data pasien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('pendaftaran/tambahPasien'); ?>" method="post">
          <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="number" class="form-control" id="nik" name="nik" value="<?= set_value('nik'); ?>">
            <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nama_pasien" class="form-label">Nama pasien</label>
                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= set_value('nama_pasien'); ?>">
                <?= form_error('nama_pasien', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal lahir</label>
                <input type="date" class="form-control flatpickr" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>">
                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                  <option selected>Pilih jenis kelamin</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
                <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="mb-3">
                <label for="no_hp" class="form-label">No Handphone</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= set_value('no_hp'); ?>">
                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat'); ?>">
                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="suami" class="form-label">Nama suami</label>
                <input type="text" class="form-control" id="suami" name="suami" value="<?= set_value('suami'); ?>">
                <?= form_error('suami', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
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

<!-- Modal tambah periksa pasien di pendaftaran -->
<?php foreach ($DataPasienDaftar as $dpd) : ?>
  <div class="modal fade" id="daftarPeriksaPasien" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="daftarPeriksaPasienLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="daftarPeriksaPasienLabel">Daftarkan periksa pasien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('pendaftaran/tambahPasien'); ?>" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="number" class="form-control" id="nik" name="nik" value="<?= isset($dpd['nik']) ? $dpd['nik'] : ''; ?>" readonly>
                  <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="nama_pasien" class="form-label">Nama pasien</label>
                  <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= isset($dpd['nama_pasien']) ? $dpd['nama_pasien'] : ''; ?>" readonly>
                  <?= form_error('nama_pasien', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="suami" class="form-label">Nama suami</label>
                  <input type="text" class="form-control" id="suami" name="suami" value="<?= isset($dpd['suami']) ? $dpd['suami'] : ''; ?>" readonly>
                  <?= form_error('suami', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?= isset($dpd['alamat']) ? $dpd['alamat'] : ''; ?>" readonly>
                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="id_dokter" class="form-label">Nama Dokter</label>
              <select name="id_dokter" id="id_dokter" class="form-select">
                <option value="">Pilih Dokter</option>
                <?php foreach ($daftar as $df) : ?>
                  <option value="<?= $df['id_pengguna']; ?>"><?= $df['nama']; ?></option>
                <?php endforeach; ?>
              </select>
              <?= form_error('id_dokter', '<small class="text-danger pl-3">', '</small>'); ?>
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