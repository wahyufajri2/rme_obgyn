<main>
    <div class="container-fluid px-3">
        <h1 class="mt-2"><?= $title; ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Beranda</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
        <hr>
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">Jumlah pasien hari ini</h2>
                        <h5 class="card-text">
                            <div class="card text-white" style="width: 18rem; background: linear-gradient(80deg, #13290d, #0abb01);">
                                <div class="card-body">
                                    <?= $jumlah_pendaftaran_hari_ini; ?> Pasien
                                </div>
                            </div>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Jumlah pasien keseluruhan</h2>
                        <h5 class="card-text">
                            <div class="card text-white" style="width: 18rem; background: linear-gradient(80deg, #13290d, #0abb01);">
                                <div class="card-body">
                                    <?= $jumlah_pendaftaran; ?> Pasien
                                </div>
                            </div>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center" style="font-weight: 700;">Selamat Datang Di <br>Rekam Medis Asesmen Obstetri dan Ginekologi <br>[RS PKU Muhammadiyah Gamping]</h2>
                    <hr>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/'); ?>img/pku-gamping.jpg" class="img-fluid rounded-start" alt="RS PKU Gamping">
                            </div>
                            <div class="col-md-8" style="background: linear-gradient(80deg, #13290d, #0abb01);">
                                <p class="card-text text-white p-2 fw-semibold" style="text-align: justify; font-size:16px;">Asesmen Obstetri dan Ginekologi adalah proses evaluasi komprehensif terhadap kesehatan reproduksi wanita, baik yang berkaitan dengan kehamilan (obstetri) maupun yang tidak berkaitan dengan kehamilan (ginekologi). Asesmen ini dilakukan oleh tenaga kesehatan profesional, seperti dokter spesialis kebidanan dan kandungan (obgyn) atau bidan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>