<?php
    include 'db.php';
    $desa = $_REQUEST["desa"];
    //Keseluruhan
    //$fetch_sql = "SELECT * FROM public.clean WHERE kode_desa = $desa;";

    $info_sql = "SELECT nama_desa, tahun FROM public.clean WHERE kode_desa = $desa LIMIT 1;";
    $info = pg_fetch_all(pg_query($dbcon, $info_sql));
    foreach ($info as $info) : 
        $tahun = $info['tahun']; 
        $nama_desa = $info['nama_desa'];
    endforeach;

    $luas_sql = "SELECT SUM(luas) AS luas_total FROM public.clean WHERE kode_desa = $desa;";
    $luas_result = pg_fetch_all(pg_query($dbcon, $luas_sql));
    foreach ($luas_result as $luas_result) : 
        $luas_total = $luas_result['luas_total']; 
    endforeach;

    $sesuai_sql = "SELECT SUM(luas) AS luas_sesuai FROM public.clean WHERE kode_desa = $desa AND keterangan = 'SESUAI';";
    $sesuai_result = pg_fetch_all(pg_query($dbcon, $sesuai_sql));
    foreach ($sesuai_result as $sesuai_result) : 
        $sesuai_total = $sesuai_result['luas_sesuai']; 
    endforeach;

    $estimasi_sql = "SELECT SUM(luas) AS luas_estimasi FROM public.clean WHERE kode_desa = $desa AND keterangan = 'ESTIMASI';";
    $estimasi_result = pg_fetch_all(pg_query($dbcon, $estimasi_sql));
    foreach ($estimasi_result as $estimasi_result) : 
        $estimasi_total = $estimasi_result['luas_estimasi']; 
    endforeach;

    $okupasi_sql = "SELECT SUM(luas) AS luas_okupasi FROM public.clean WHERE kode_desa = $desa AND keterangan = 'OKUPASI';";
    $okupasi_result = pg_fetch_all(pg_query($dbcon, $okupasi_sql));
    foreach ($okupasi_result as $okupasi_result) : 
        $okupasi_total = $okupasi_result['luas_okupasi']; 
    endforeach;
    
?>
<!DOCTYPE html>
    <html>
    <head>
        <title>Ledger Jalan</title>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    </head>
    <body>
        <h1>Ledger Jalan Desa <?php echo $nama_desa?></h1>
        <div class="container">
            <h2>Data Rumija</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Luas Total (M^2)</th>
                        <th>Luas Lahan Sesuai (M^2)</th>
                        <th>Luas Lahan Estimasi (M^2)</th>
                        <th>Luas Lahan Okupasi (M^2)</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($tahun); ?></td>
                            <td><?php echo htmlspecialchars($luas_total); ?></td>
                            <td><?php echo htmlspecialchars($sesuai_total); ?></td>
                            <td><?php echo htmlspecialchars($estimasi_total); ?></td>
                            <td><?php echo htmlspecialchars($okupasi_total); ?></td>
                        </tr>
                    
                </tbody>
            </table>
        </div>
    </body>
</html>
