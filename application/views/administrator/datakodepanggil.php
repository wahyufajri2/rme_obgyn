<main>
    <div class="container-fluid px-4">
        <h1 class="my-1"><?= $title; ?></h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item">
                <a href="<?= base_url('administrator'); ?>">
                    <?php foreach ($role as $rl) : ?>
                        <?php if ($rl['id'] == 1) : ?>
                            <span value="<?= $rl['id']; ?>"><?= $rl['role']; ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </a>
            </li>
            <li class="breadcrumb-item active"><a href="<?= base_url('administrator/dataPengguna'); ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active">Data Hotspot | Kode Panggil</li>
        </ol>
        <div class="row">
            <div class="col-lg">
                <a href="<?= base_url('administrator/dataPengguna'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
                <a href="<?= base_url('administrator/printKodePanggil'); ?>" class="btn btn-warning mb-3" target="_blank"><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="card mb-2">
            <div class="card-body">
                <table class="table table-dark table-hover text-center" id="datatablesSimple">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Upas Berlaku</th>
                            <th>Jumlah Device</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($hotspotUserData as $row) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row->id_tamu ?? '-'; ?></td>
                                <td><?= $row->password ?? '-'; ?></td>
                                <td><?= $row->tgl_akhir ?? '-'; ?></td>
                                <td><?= $row->jumlah_device ?? '-'; ?></td>
                                <td>
                                    <a href="<?= base_url('administrator/editDataPengguna/' . $row->id_tamu); ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('administrator/hapusDataPengguna/' . $row->id_tamu); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <br>
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <?php for ($i = 0; $i < count($hotspotUserData); $i++) : ?>
                                <?php if ($i % 3 == 0) : ?>
                                    <tr>
                                    <?php endif; ?>
                                    <th>
                                        <h4> upas hotspot UNISA Yogyakarta <br>
                                            username: <?php echo $hotspotUserData[$i]->id_tamu ?? '-'; ?> <br>
                                            password: <?php echo $hotspotUserData[$i]->password ?? '-'; ?> <br>
                                            upas berlaku <?php echo $hotspotUserData[$i]->hari ?? '-'; ?> hari dari waktu login </h4>
                                    </th>
                                    <?php if ($i % 3 == 2) : ?>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</main>