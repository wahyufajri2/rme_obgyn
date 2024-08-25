<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('pengaturan/kelolaAkun'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr class="table-active">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gambar profil</th>
                            <th scope="col">Peran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Daftar sejak</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($akun as $i => $ak) : ?>
                            <tr>
                                <th scope="row"><?= $i + 1; ?></th>
                                <td><?= $ak['nama']; ?></td>
                                <td><?= $ak['email']; ?></td>
                                <td><img width="30px" src="<?= base_url('assets/img/profile/') . $ak['gambar']; ?>" alt="Gambar Profil" style="border-radius: 50%;"></td>
                                <td><?= $ak['peran']; ?></td>
                                <td>
                                    <span class="badge rounded-pill text-bg-<?= ($ak['apakah_aktif'] == 1) ? 'warning' : 'secondary'; ?>"><?= ($ak['apakah_aktif'] == 1) ? 'Aktif' : 'Nonaktif'; ?></span>
                                </td>
                                <td>
                                    <?php
                                    $bulan_indo = array(
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember'
                                    );

                                    $tanggal = date('d', $ak['tgl_dibuat']);
                                    $bulan = $bulan_indo[date('n', $ak['tgl_dibuat'])];
                                    $tahun = date('Y', $ak['tgl_dibuat']);
                                    $jam = date('H:i', $ak['tgl_dibuat']); // Mendapatkan jam dan menit

                                    echo $tanggal . ' ' . $bulan . ' ' . $tahun . ', jam ' . $jam;
                                    ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahDataAkun_<?= $ak['id']; ?>">
                                        <i class="fas fa-solid fa-pen-to-square fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Ubah
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="<?= base_url('pengaturan/tambahAkun'); ?>" class="btn btn-primary" aria-describedby="Pindah ke halaman tambah akun"><i class="fas fa-solid fa-circle-plus fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tambah Akun </a>
            </div>
        </div>
    </div>
</main>

<!-- Modal untuk mengubah data akun -->
<?php foreach ($akun as $ak) : ?>
    <div class="modal fade" id="ubahDataAkun_<?= $ak['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahDataAkunLabel_<?= $ak['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataAkunLabel_<?= $ak['id']; ?>">Ubah Data Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open_multipart('pengaturan/ubahDataAkun/' . $ak['id']); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama akun</label>
                        <input type="text" class="form-control" id="nama_<?= $ak['id']; ?>" name="nama" value="<?= $ak['nama']; ?>">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat email</label>
                        <input type="text" class="form-control" id="email_<?= $ak['id']; ?>" name="email" value="<?= $ak['email']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar profil</label>
                        <input type="file" class="form-control" id="gambar_<?= $ak['id']; ?>" name="gambar">

                        <?php if (!empty($ak['gambar'])): ?>
                            <small class="form-text text-muted">File saat ini: <?= $ak['gambar']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="id_peran" class="form-label">Pilih peran</label>
                        <select name="id_peran" id="id_peran_<?= $ak['id']; ?>" class="form-select">
                            <option value="">Pilih peran</option>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['id']; ?>" <?= ($r['id'] == $ak['id_peran']) ? 'selected' : ''; ?>><?= $r['peran']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="apakah_aktif_<?= $ak['id']; ?>" value="1" name='apakah_aktif'
                            <?php if ($ak['apakah_aktif'] == 1) echo 'checked'; ?>>
                        <label for="apakah_aktif_<?= $ak['id']; ?>" class="form-check-label">Akun ini aktif?</label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Tutup</button>
                    </div>
                    <button type="submit" class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;"><i class="fas fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>