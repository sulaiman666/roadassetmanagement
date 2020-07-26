<?php
    include 'db.php';
    $desa = $_REQUEST["desa"];

    $fetch_sql = "SELECT * FROM public.clean WHERE kode_desa = $desa;";
    $result = pg_fetch_all(pg_query($dbcon,$fetch_sql));
?>
<!DOCTYPE html>
    <html>
    <head>
        <title>Ledger Desa</title>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Data Rumija <?php echo ($result['nama_desa'])?></h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Administrasi</th>
                        <th>Kode Provinsi</th>
                        <th>Nama Provinsi</th>
                        <th>Kode Kabupaten</th>
                        <th>Nama Kabupaten</th>
                        <th>Kode Kecamatan</th>
                        <th>Nama Kecamatan</th>
                        <th>Kode Desa</th>
                        <th>Nama Desa</th>
                        <th>Tahun</th>
                        <th>Luas</th>
                        <th>Keterangan</th>
                        <th>Ket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $result) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['gid']) ?></td>
                            <td><?php echo htmlspecialchars($result['fid_admin']); ?></td>
                            <td><?php echo htmlspecialchars($result['kode_prov']); ?></td>
                            <td><?php echo htmlspecialchars($result['nama_prov']) ?></td>
                            <td><?php echo htmlspecialchars($result['kode_kab']); ?></td>
                            <td><?php echo htmlspecialchars($result['nama_kab']); ?></td>
                            <td><?php echo htmlspecialchars($result['kode_kec']) ?></td>
                            <td><?php echo htmlspecialchars($result['nama_kec']); ?></td>
                            <td><?php echo htmlspecialchars($result['kode_desa']); ?></td>
                            <td><?php echo htmlspecialchars($result['nama_desa']) ?></td>
                            <td><?php echo htmlspecialchars($result['tahun']); ?></td>
                            <td><?php echo htmlspecialchars($result['luas']); ?></td>
                            <td><?php echo htmlspecialchars($result['keterangan']) ?></td>
                            <td><?php echo htmlspecialchars($result['ket']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
