<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card o-hidden border-0.5 border-dark shadow-lg py-4 my-5 bg-transparent">
                    <div class="card-body py-5 my-5">
                        <div class="row">
                            <div class="col-lg">
                                <div class="pt-0 pl-0 pr-0 pb-5 mt-5">
                                    <div class="text-center mt-5 mb-5">
                                        <h1 class="h3 text-gray-500 font-weight-bold mb-1">Login</h1>
                                        <h1 class="h4 text-gray-500 mb-4 mt-0">RS PKU Gamping</h1>
                                    </div>

                                    <?= $this->session->flashdata('message') ?>
                                    <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user border-0.5 border-dark shadow-lg bg-transparent" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?php if (isset($_COOKIE["email"])) {
                                                                                                                                                                                                                                                            echo $_COOKIE["email"];
                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                            echo set_value('email');
                                                                                                                                                                                                                                                        }  ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user border-0.5 border-dark shadow-lg bg-transparent" id="password" name="password" placeholder="Password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                                                                                                                                                            echo $_COOKIE["password"];
                                                                                                                                                                                                                        } ?>">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="save_id" name="save_id" <?php if (isset($_COOKIE["email"])) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                                <label class="custom-control-label text-gray-500" for="save_id">
                                                    Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary btn-user btn-block fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;">
                                            <i class="fa-solid fa-right-to-bracket"></i> Masuk
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>