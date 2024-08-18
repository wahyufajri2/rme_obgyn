<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title ?? ''; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="<?= base_url('administrator'); ?>">
                    <?php foreach ($role as $rl) : ?>
                        <?php if ($rl['id'] == 1) : ?>
                            <span value="<?= $rl['id']; ?>"><?= $rl['role']; ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </a>
            </li>
            <li class="breadcrumb-item active"><?= $title ?? ''; ?></li>
        </ol>
        <?= $this->session->flashdata('message'); ?>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <br>
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <?php foreach ($view_data as $row) : ?>
                                <tr>
                                    <th>
                                        <h4>upas hotspot UNISA Yogyakarta <br>
                                            username: <?= $row->id_tamu ?? '-'; ?> <br>
                                            password: <?= $row->password ?? '-'; ?> <br>
                                            upas berlaku <?= $row->tgl_akhir ?? '-'; ?> hari dari waktu login
                                        </h4>
                                    </th>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>