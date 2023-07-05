<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr class="table-active">
                <th>No</th>
                <th>No Rg</th>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($Kebidanan as $kbd) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $kbd['no_rg']; ?></td>
                    <td><?= $kbd['no_rm']; ?></td>
                    <td><?= $kbd['nama_pasien']; ?></td>
                    <td><?= $kbd['alamat']; ?></td>
                    <td><?= $kbd['status']; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>