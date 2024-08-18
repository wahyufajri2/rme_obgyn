<div id="layoutError">
    <div id="layoutError_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mt-4">
                            <img class="mb-4 img-error" src="<?= base_url('assets/'); ?>img/blocked.png" />
                            <p class="lead">Akses Terlarang</p>
                            <p class="text-gray-700 mb-0">Sepertinya Anda menemukan kesalahan dalam matriks. <br> <strong class="text-danger">Jangan masuk ke dalam tempat yang bukan hak Anda!</strong></p><br>
                            <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span><strong>Anda harus keluar!</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutError_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-center small">
                    <div class="text-muted">Copyright &copy; RME Asesmen Obgyn RS PKU Gamping <?= date('Y'); ?></div>
                </div>
            </div>
        </footer>
    </div>
</div>