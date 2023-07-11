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
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= $this->session->flashdata('message'); ?>
                    <!-- /.card -->
                    <form class="user" method="post" action="<?= base_url('admin/addAccount'); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group input-group">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" style="border-top-left-radius: 0px; border-top-right-radius: 100px; border-bottom-right-radius: 100px; border-bottom-left-radius: 0px;">
                                    <a href="#" id="show_password1" class="text-decoration-none text-gray-700"><i class="fa-solid fa-eye" id="icon"></i></a>
                                </span>
                            </div>
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group input-group">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" style="border-top-left-radius: 0px; border-top-right-radius: 100px; border-bottom-right-radius: 100px; border-bottom-left-radius: 0px;">
                                    <a href="#" id="show_password2" class="text-decoration-none text-gray-700"><i class="fa-solid fa-eye" id="icon"></i></a>
                                </span>
                            </div>
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-user btn-block  fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;">
                            <i class="fas fa-solid fa-arrow-right"></i> Daftarkan Akun
                        </button>
                    </form>
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
</div>
<!-- /.container-fluid -->
</section>

</div>
<!-- End of Main Content -->