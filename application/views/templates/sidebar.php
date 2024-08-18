<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">

                        <!-- Melakukan query menu -->
                        <?php
                        $roleId = $this->session->userdata('role_id');
                        $queryMenu = "SELECT `user_menu`.`id`, `menu`
                                    FROM `user_menu` JOIN `user_access_menu`
                                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                                    WHERE `user_access_menu`.`role_id` = $roleId
                                    ORDER BY `user_access_menu`.`menu_id` ASC
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
                                            FROM `user_sub_menu` JOIN `user_menu`
                                            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                            WHERE `user_sub_menu`.`menu_id` = $menuId
                                            AND `user_sub_menu`.`is_active` = 1
                                            ";
                            $subMenu = $this->db->query($querySubMenu)->result_array();
                            ?>

                            <?php foreach ($subMenu as $sm) : ?>
                                <?php if ($title == $sm['title']) : ?>
                                    <a class="nav-link active" href="<?= base_url($sm['url']); ?>">
                                    <?php else : ?>
                                        <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                                        <?php endif; ?>
                                        <div class="sb-nav-link-icon"><i class="<?= $sm['icon']; ?>"></i></div>
                                        <?= $sm['title']; ?>
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
                $loggedInRoleId = isset($_SESSION['role_id']) ? $_SESSION['role_id'] : null;

                foreach ($role as $rl) {
                    if ($rl['id'] == $loggedInRoleId) {
                        echo '<span value="' . $rl['id'] . '">' . $rl['role'] . '</span>';
                    };
                };
                ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">