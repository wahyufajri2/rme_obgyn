<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('pendaftaran'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex">
                    <p class="fw-semibold">*Jika NIK belum ada, <strong><a href="<?= base_url('pendaftaran/masterPasien'); ?>">daftarkan pasein!</a></strong>. Jika sudah ada, <strong><a href="<?= base_url('pendaftaran'); ?>">daftarkan periksa!</a></strong></p>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor pendaftaran</th>
                            <th scope="col">Tanggal periksa</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($daftar as $i => $daftar): ?>
                            <tr>
                                <th scope="row"><?= $i + 1; ?></th>
                                <td><?= $daftar['nama_pasien']; ?></td>
                                <td><?= $daftar['no_rg']; ?></td>
                                <td><?= $daftar['tgl_periksa']; ?></td>
                                <td><?= $daftar['tgl_pendaftaran']; ?></td>
                                <td><?= $daftar['nama']; ?></td>
                                <td><?= $daftar['status']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detailDataPasien_<?= $daftar['nik']; ?>">
                                        <i class="fas fa-solid fa-file-lines fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Detail
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahPeriksaPasien">
                                        <i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Ubah
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