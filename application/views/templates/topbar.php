<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="https://pkugamping.com/" target="_blank" style="display: flex; align-items: center;">
        <img src="<?= base_url('assets/'); ?>img/pku.png" width="35px" style="margin-right: 10px;">
        <div style="display: flex; flex-direction: column; width: 35px; /* Lebar sama dengan logo */">
            <span style="font-size: 0.7em; /* Atau sesuaikan ukuran font sesuai kebutuhan */">Asesmen</span>
            <span style="font-size: 0.7em;">Obstetri dan Ginekologi</span>
        </div>
    </a>
    <!-- Sidebar Toggle-->
    <button class=" btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-900 small"><?= $user['nama']; ?> </span>
                <img width="20px" src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a></li>
            </ul>
        </li>
    </ul>
</nav>