<div class="content-wrapper bg-gray-200">
    <!-- Begin Page Content -->
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

        <div class="row">
            <div class="col-lg">
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

                <?= $this->session->flashdata('message'); ?>

                <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>

                <table class="table table-hover">
                    <thead>
                        <tr class="table-active">
                            <th scope="col">No</th>
                            <th scope="col">Menu</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['menu']; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-success btn-sm"><i class=" fas fa-solid fa-pen-to-square"></i> Edit</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"><i class=" fas fa-solid fa-trash-can"></i> Delete</button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name='menu' placeholder="Menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-solid fa-circle-xmark"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-solid fa-circle-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>