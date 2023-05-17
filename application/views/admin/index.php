<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card-deck">
        <div class="card">
            <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $user['name']; ?></h5>
                <p class="card-text"><?= $user['email']; ?></p>
            </div>
            <div class="card-footer">Member since <?= date('d F Y', $user['date_created']); ?></small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $user['name']; ?></h5>
                <p class="card-text"><?= $user['email']; ?></p>
            </div>
            <div class="card-footer">Member since <?= date('d F Y', $user['date_created']); ?></small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $user['name']; ?></h5>
                <p class="card-text"><?= $user['email']; ?></p>
            </div>
            <div class="card-footer">Member since <?= date('d F Y', $user['date_created']); ?></small>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->