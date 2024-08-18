<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>assets/img/logo-unisa.png" type="image/x-icon">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/'); ?>css/styles-print.css" rel="stylesheet" />
</head>

<body>
    <main>
        <div class="bg-custom">
            <table class="table table-striped table-bordered" id="dataTables" style="opacity: 0.85;">
                <?php for ($i = 0; $i < count($hotspotUserData); $i++) : ?>
                    <?php if ($i % 3 == 0) : ?>
                        <tr>
                        <?php endif; ?>
                        <th>
                            <h7 style="color: black; text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);">
                                upas hotspot UNISA Yogyakarta <br>
                                username: <?php echo $hotspotUserData[$i]->id_tamu ?? '-'; ?> <br>
                                password: <?php echo $hotspotUserData[$i]->password ?? '-'; ?> <br>
                                upas berlaku <?php echo $hotspotUserData[$i]->hari ?? '-'; ?> hari dari waktu login
                            </h7>
                        </th>
                        <?php if ($i % 3 == 2) : ?>
                        </tr>
                    <?php endif; ?>
                <?php endfor; ?>
            </table>
        </div>
    </main>


    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>