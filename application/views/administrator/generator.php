<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
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
        <?= $this->session->flashdata('message'); ?>
        <hr>
        <div class="row">
            <div class="col-lg">
                <div class="marquee-container">
                    <div class="marquee-wrapper">
                        <span id="marqueeText" class="marquee-text"><strong>Silakan Melakukan Generate Username dan Password!</strong></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">

                <form action="<?= base_url('administrator/hotspotGenerator'); ?>" method="post">
                    <div class="mb-3">
                        <label for="jumlah_device" class="form-label">Jumlah User</label>
                        <input type="number" class="form-control" id="jumlah_user" name="jumlah_user">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_device" class="form-label">Jumlah Device</label>
                        <select class="form-control" name="jumlah_device" id="jumlah_device">
                            <option value="1">1</option>
                            <option value="500">500</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kode_enkripsi" class="form-label">Kode Enkripsi</label>
                        <input type="text" class="form-control" id="kode_enkripsi" name="kode_enkripsi" value="f1515859-8a5f-11ed-9761-80c16e7478f0">
                    </div>
                    <div class="mb-3">
                        <label for="masa_berlaku" class="form-label">Masa Berlaku</label>
                        <input type="number" class="form-control" id="masa_berlaku" name="masa_berlaku">
                    </div>
                    <div class="mb-3">
                        <label for="kode_panggil" class="form-label">Kode Panggil</label>
                        <input type="text" class="form-control" id="kode_panggil" name="kode_panggil">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kadaluarsa" class="form-label">Tgl Kadaluwarsa</label>
                        <input type="date" class="form-control flatpickr" id="tgl_kadaluarsa" name="tgl_kadaluarsa">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary"><strong>Generate</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>