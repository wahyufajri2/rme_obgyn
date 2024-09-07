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
          <p class="fw-semibold">*Jika NIK sudah ada, <strong><a type="button" data-bs-toggle="modal" data-bs-target="#daftarPeriksaPasien">daftarkan periksa</a></strong>. Jika belum ada, bisa <strong><a type="button" data-bs-toggle="modal" data-bs-target="#daftarMasterPasien">daftarkan pasien!</a></strong></p>
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
              <th scope="col">No RM</th>
              <th scope="col">NIK</th>
              <th scope="col">Tanggal lahir</th>
              <th scope="col">Alamat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataMasterPasien as $i => $dmp) : ?>
              <tr>
                <th scope="row"><?= $i + 1; ?></th>
                <td><?= $dmp['nama_pasien']; ?></td>
                <td><?= $dmp['no_rm']; ?></td>
                <td><?= $dmp['nik']; ?></td>
                <?php
                // Mengatur lokal ke bahasa Indonesia
                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                ?>

                <td><?= $formatter->format($dmp['tgl_lahir']); ?></td>
                <td><?= $dmp['alamat']; ?></td>
                <td>
                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detailDataPasien_<?= $dmp['no_rm']; ?>">
                    <i class="fas fa-solid fa-file-lines fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Detail
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahDataPasien_<?= $dmp['no_rm']; ?>">
                    <i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Ubah
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#daftarPeriksaPasien_<?= $dmp['no_rm']; ?>">
                    <i class="fas fa-solid fa-bed fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Daftar periksa
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<!-- AWAL MODAL -->
<!-- Awal modal tambah data pasien di master data pasien -->
<div class="modal fade" id="daftarMasterPasien" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="daftarMasterPasienLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="daftarMasterPasienLabel">Daftarkan pasien di master data pasien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('pendaftaran/tambahMasterPasien'); ?>" method="post">
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
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
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
<!-- Akhir modal tambah data pasien di master data pasien -->

<!-- Awal modal untuk melihat detail master data pasien -->
<?php foreach ($dataMasterPasien as $dmp) : ?>
  <div class="modal fade" id="detailDataPasien_<?= $dmp['no_rm']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailDataPasienLabel_<?= $dmp['no_rm']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailDataPasienLabel_<?= $dmp['no_rm']; ?>">Detail Master Data Pasien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <span>Nomor RM</span>
                <div class="card p-1">
                  <?= $dmp['no_rm']; ?>
                </div>
              </div>
              <div class="mb-3">
                <span>Nomor NIK</span>
                <div class="card p-1">
                  <?= $dmp['nik']; ?>
                </div>
              </div>
              <div class="mb-3">
                <span>Jenis kelamin</span>
                <div class="card p-1">
                  <?= $dmp['jenis_kelamin']; ?>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <span>Nama pasien</span>
                <div class="card p-1">
                  <?= $dmp['nama_pasien']; ?>
                </div>
              </div>
              <div class="mb-3">
                <span>Tanggal lahir</span>
                <div class="card p-1">
                  <?php
                  // Mengatur lokal ke bahasa Indonesia
                  $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                  ?>
                  <?= $formatter->format($dmp['tgl_lahir']); ?>
                </div>
              </div>
              <div class="mb-3">
                <span>Nomor handphone</span>
                <div class="card p-1">
                  <?= $dmp['no_hp']; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <span>Alamat</span>
                <div class="card p-1">
                  <?= $dmp['alamat']; ?>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <span>Nama suami</span>
                <div class="card p-1">
                  <?= $dmp['suami']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir modal untuk melihat detail master data pasien -->

  <!-- Awal modal ubah data master pasien -->
  <div class="modal fade" id="ubahDataPasien_<?= $dmp['no_rm']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahDataPasienLabel_<?= $dmp['no_rm']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ubahDataPasienLabel_<?= $dmp['no_rm']; ?>">Ubah Data Master Pasien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('pendaftaran/ubahMasterPasien/' . $dmp['no_rm']); ?>" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="no_rm" class="form-label">No RM</label>
                  <input type="text" class="form-control" id="no_rm" name="no_rm" value="<?= isset($dmp['no_rm']) ? $dmp['no_rm'] : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="number" class="form-control" id="nik" name="nik" value="<?= isset($dmp['nik']) ? $dmp['nik'] : ''; ?>">
                  <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                  <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= isset($dmp['jenis_kelamin']) ? $dmp['jenis_kelamin'] : ''; ?>">
                  <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?= isset($dmp['alamat']) ? $dmp['alamat'] : ''; ?>">
                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nama_pasien" class="form-label">Nama pasien</label>
                  <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= isset($dmp['nama_pasien']) ? $dmp['nama_pasien'] : ''; ?>">
                  <?= form_error('nama_pasien', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="tgl_lahir" class="form-label">Tanggal lahir</label>
                  <input type="text" class="form-control flatpickr" id="tgl_lahir" name="tgl_lahir" value="<?php
                                                                                                            $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                                                                                            ?>
                <?= isset($dmp['tgl_lahir']) ? $formatter->format($dmp['tgl_lahir']) : ''; ?>">
                  <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="no_hp" class="form-label">Nomor handphone</label>
                  <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= isset($dmp['no_hp']) ? $dmp['no_hp'] : ''; ?>">
                  <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="suami" class="form-label">Nama suami</label>
                  <input type="text" class="form-control" id="suami" name="suami" value="<?= isset($dmp['suami']) ? $dmp['suami'] : ''; ?>">
                  <?= form_error('suami', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
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
  <!-- Akhir modal ubah data master pasien -->

  <!-- Awal modal tambah periksa pasien di pendaftaran -->
  <div class="modal fade" id="daftarPeriksaPasien_<?= $dmp['no_rm']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="daftarPeriksaPasienLabel_<?= $dmp['no_rm']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="daftarPeriksaPasienLabel_<?= $dmp['no_rm']; ?>">Daftarkan periksa pasien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('pendaftaran/tambahPeriksaPasien/' . $dmp['no_rm']); ?>" method="post">
            <div class="mb-3">
              <label for="no_rm" class="form-label">No RM</label>
              <input type="text" class="form-control" id="no_rm" name="no_rm" value="<?= isset($dmp['no_rm']) ? $dmp['no_rm'] : ''; ?>" readonly>
              <?= form_error('no_rm', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="number" class="form-control" id="nik" name="nik" value="<?= isset($dmp['nik']) ? $dmp['nik'] : ''; ?>" readonly>
                  <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="nama_pasien" class="form-label">Nama pasien</label>
                  <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= isset($dmp['nama_pasien']) ? $dmp['nama_pasien'] : ''; ?>" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="suami" class="form-label">Nama suami</label>
                  <input type="text" class="form-control" id="suami" name="suami" value="<?= isset($dmp['suami']) ? $dmp['suami'] : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?= isset($dmp['alamat']) ? $dmp['alamat'] : ''; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="id" class="form-label">Nama Dokter</label>
              <select name="id" id="id" class="form-select">
                <option value="">Pilih Dokter</option>
                <?php foreach ($daftar_dokter as $dk) : ?>
                  <option value="<?= $dk['id']; ?>"><?= $dk['nama']; ?></option>
                <?php endforeach; ?>
              </select>
              <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="mb-3">
              <label for="bangsal" class="form-label">Bangsal</label>
              <select class="form-select" id="bangsal" name="bangsal">
                <option selected>Pilih bangsal</option>
                <option value="IGD">IGD</option>
                <option value="Rawat Jalan">Rawat Jalan</option>
                <option value="Rawat Inap">Rawat Inap</option>
              </select>
              <?= form_error('bangsal', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="mb-3">
              <label for="asuransi" class="form-label">Asuransi</label>
              <select class="form-select" id="asuransi" name="asuransi">
                <option selected>Pilih asuransi</option>
                <option value="BPJS">BPJS</option>
                <option value="Umum">Umum</option>
              </select>
              <?= form_error('asuransi', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="mb-3">
              <label for="tgl_periksa" class="form-label">Tanggal periksa</label>
              <input type="date" class="form-control flatpickr" id="tgl_periksa" name="tgl_periksa" value="<?= set_value('tgl_periksa'); ?>">
              <?= form_error('tgl_periksa', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="modal-footer justify-content-between">
              <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                <button type="reset" class="btn btn-warning"><i class="fas fa-solid fa-rotate-left fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Reset</button>
              </div>
              <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- Akhir modal tambah periksa pasien di pendaftaran -->
<!-- AKHIR MODAL -->