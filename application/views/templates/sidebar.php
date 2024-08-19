<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading"><br>
                        <?php $current_uri = $this->uri->segment(1); ?>

                        <a class="nav-link <?= ($current_uri == 'admin') ? 'active' : ''; ?>" href="<?= base_url('admin'); ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-columns"></i></div>
                            Dashboard
                        </a>
                        <hr>

                        <!-- Melakukan query menu -->
                        <?php
                        $roleId = $this->session->userdata('id_peran');
                        $queryMenu = "SELECT `menu_pengguna`.`id`, `menu`
                                    FROM `menu_pengguna` JOIN `menu_akses_pengguna`
                                    ON `menu_pengguna`.`id` = `menu_akses_pengguna`.`id_menu`
                                    WHERE `menu_akses_pengguna`.`id_peran` = $roleId
                                    ORDER BY `menu_akses_pengguna`.`id_menu` ASC
                                    ";
                        $menu = $this->db->query($queryMenu)->result_array();
                        ?>

                        <!-- Looping menu -->
                        <?php foreach ($menu as $m) : ?>
                            <?= $m['menu']; ?>

                            <!-- Melakukan query submenu -->
                            <?php
                            $menuId = $m['id'];
                            $querySubMenu = "SELECT *
                                            FROM `submenu_pengguna` JOIN `menu_pengguna`
                                            ON `submenu_pengguna`.`id_menu` = `menu_pengguna`.`id`
                                            WHERE `submenu_pengguna`.`id_menu` = $menuId
                                            AND `submenu_pengguna`.`apakah_aktif` = 1
                                            ";
                            $subMenu = $this->db->query($querySubMenu)->result_array();
                            ?>

                            <?php foreach ($subMenu as $sm) : ?>
                                <?php if ($title == $sm['judul']) : ?>
                                    <a class="nav-link active" href="<?= base_url($sm['url']); ?>">
                                    <?php else : ?>
                                        <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                                        <?php endif; ?>
                                        <div class="sb-nav-link-icon"><i class="<?= $sm['ikon']; ?>"></i></div>
                                        <?= $sm['judul']; ?>
                                        </a>
                                    <?php endforeach; ?>
                                    <hr>
                                <?php endforeach; ?>
                    </div>

                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-solid fa-right-from-bracket"></i></div>
                        Keluar
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Masuk sebagai:</div>
                <?php
                $loggedInRoleId = isset($_SESSION['id_peran']) ? $_SESSION['id_peran'] : null;

                foreach ($role as $rl) {
                    if ($rl['id'] == $loggedInRoleId) {
                        echo '<span value="' . $rl['id'] . '">' . $rl['peran'] . '</span>';
                    };
                };
                ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">