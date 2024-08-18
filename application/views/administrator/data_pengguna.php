<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Cek Password Pengguna</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('administrator'); ?>">
                    <?php foreach ($role as $rl) : ?>
                        <?php if ($rl['id'] == 1) : ?>
                            <span value="<?= $rl['id']; ?>"><?= $rl['role']; ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="cekBerdasarkanID-tab" data-bs-toggle="tab" data-bs-target="#cekBerdasarkanID" type="button" role="tab" aria-controls="cekBerdasarkanID" aria-selected="true">Cek Berdasarkan ID</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cekBerdasarkanKodePanggil-tab" data-bs-toggle="tab" data-bs-target="#cekBerdasarkanKodePanggil" type="button" role="tab" aria-controls="cekBerdasarkanKodePanggil" aria-selected="false">Cek Berdasarkan Kode Panggil</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cekBerdasarkanTanggalGenerate-tab" data-bs-toggle="tab" data-bs-target="#cekBerdasarkanTanggalGenerate" type="button" role="tab" aria-controls="cekBerdasarkanTanggalGenerate" aria-selected="false">Cek Berdasarkan Tanggal Generate</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="cekBerdasarkanID" role="tabpanel" aria-labelledby="cekBerdasarkanID-tab">
                <div class="row mt-3">
                    <div class="col-lg">
                        <div class="marquee-container">
                            <div class="marquee-wrapper">
                                <span id="marqueeText" class="marquee-text"><strong>Silakan Cek Password Berdasarkan ID</strong></span>
                            </div>
                        </div>
                        <form action="<?= base_url('administrator/hotspotUserID'); ?>" method="POST">
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2">
                                    <label for="id_tamu" class="col-form-label"><b>User ID</b></label>
                                </div>
                                <div class="col-lg">
                                    <input type="text" id="id_tamu" name="id_tamu" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2">
                                    <label for="kode_enkripsi" class="col-form-label"><b>Kode Enkripsi</b></label>
                                </div>
                                <div class="col-lg">
                                    <input type="text" id="kode_enkripsi" name="kode_enkripsi" class="form-control" value="f1515859-8a5f-11ed-9761-80c16e7478f0">
                                </div>
                            </div>
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2"></div>
                                <div class="col-lg">
                                    <button type="submit" class="btn btn-primary">Tampil Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="cekBerdasarkanKodePanggil" role="tabpanel" aria-labelledby="cekBerdasarkanKodePanggil-tab">
                <div class="row mt-3">
                    <div class="col-lg">
                        <div class="marquee-container">
                            <div class="marquee-wrapper">
                                <span id="marqueeText1" class="marquee-text"><strong>Silakan Cek Password Berdasarkan Kode Panggil</strong></span>
                            </div>
                        </div>
                        <form action="<?= base_url('administrator/hotspotUserPanggil'); ?>" method="post">
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2">
                                    <label for="kode_panggil" class="col-form-label"><b>Kode Panggil</b></label>
                                </div>
                                <div class="col-lg">
                                    <input type="text" id="kode_panggil" name="kode_panggil" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2">
                                    <label for="kode_enkripsi" class="col-form-label"><b>Kode Enkripsi</b></label>
                                </div>
                                <div class="col-lg">
                                    <input type="text" id="kode_enkripsi" name="kode_enkripsi" class="form-control" value="f1515859-8a5f-11ed-9761-80c16e7478f0">
                                </div>
                            </div>
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2"></div>
                                <div class="col-lg">
                                    <button type="submit" class="btn btn-primary"> Tampil Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="cekBerdasarkanTanggalGenerate" role="tabpanel" aria-labelledby="cekBerdasarkanTanggalGenerate-tab">
                <div class="row mt-3">
                    <div class="col-lg">
                        <div class="marquee-container">
                            <div class="marquee-wrapper">
                                <span id="marqueeText2" class="marquee-text"><strong>Silakan Cek Password Berdasarkan Tanggal Generate</strong></span>
                            </div>
                        </div>
                        <form action="<?= base_url('administrator/hotspotUserTgl'); ?>" method="post">
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2">
                                    <label for="tgl_generate" class="col-form-label"><b>Tanggal Generate</b></label>
                                </div>
                                <div class="col-lg">
                                    <input type="text" id="tgl_generate" name="tgl_generate" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2">
                                    <label for="kode_enkripsi" class="col-form-label"><b>Kode Enkripsi</b></label>
                                </div>
                                <div class="col-lg">
                                    <input type="text" id="kode_enkripsi" name="kode_enkripsi" class="form-control" value="f1515859-8a5f-11ed-9761-80c16e7478f0">
                                </div>
                            </div>
                            <div class="row g-3 mt-1 align-items-center">
                                <div class="col-lg-2"></div>
                                <div class="col-lg">
                                    <button type="submit" class="btn btn-primary"> Tampil Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>