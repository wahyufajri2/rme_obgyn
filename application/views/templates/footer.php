<footer class="py-4 bg-dark mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-center small">
            <div class="text-muted">Copyright &copy; RME Asesmen Obgyn RS PKU Gamping <?= date('Y'); ?></div>
        </div>
    </div>
</footer>
</div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="logoutModalLabel">Apakah Anda ingin keluar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Pilih "<strong>Keluar</strong>" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-solid fa-circle-xmark" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;"></i> Batal</button>
                <a class="btn btn-primary fa-beat-fade" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.020;" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-solid fa-right-from-bracket"></i> Keluar</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('.alert').alert().delay(3000).slideUp('slow');
</script>
<script>
    flatpickr('.flatpickr', {
        dateFormat: 'Y-m-d',
        theme: 'material_blue'
    });
</script>
<script src="<?= base_url('assets/'); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/script-custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- Plugin Javascript -->
<script src="<?= base_url('assets/'); ?>js/jquery.easing.min.js"></script>

<!-- Javascript SBAdmin -->
<script src="<?= base_url('assets/'); ?>js/scripts.js"></script>

<!-- Chart JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/'); ?>demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>js/datatables-simple-demo.js"></script>
<script>
    $(".form-check-input").on("click", function() {
        const menuId = $(this).data("menu");
        const roleId = $(this).data("peran");

        $.ajax({
            url: "<?= base_url('pengaturan/ubahAkses'); ?>",
            type: "post",
            data: {
                menuId: menuId,
                roleId: roleId,
            },
            success: function() {
                document.location.href =
                    "<?= base_url('pengaturan/aksesAkun/'); ?>" + roleId;
            },
        });
    });
</script>

</body>

</html>