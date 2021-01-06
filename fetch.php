<?php
    include 'db.php';
    $desa = $_REQUEST["desa"];
    //Keseluruhan
    //$fetch_sql = "SELECT * FROM public.gresik_rumija_d WHERE kode_desa = $desa;";
    /*=========================================================Untuk Tabel Rumija============================================================*/ 
    $info_sql = "SELECT nama_desa, tahun FROM public.gresik_rumija_d WHERE kode_desa = $desa LIMIT 1;";
    $info = pg_fetch_all(pg_query($dbcon, $info_sql));
    foreach ($info as $info) : 
        $tahun = $info['tahun']; 
        $nama_desa = $info['nama_desa'];
    endforeach;

    $luas_sql = "SELECT SUM(luas) AS luas_total FROM public.gresik_rumija_d WHERE kode_desa = $desa;";
    $luas_result = pg_fetch_all(pg_query($dbcon, $luas_sql));
    foreach ($luas_result as $luas_result) : 
        $luas_total = $luas_result['luas_total']; 
    endforeach;

    $sesuai_sql = "SELECT SUM(luas) AS luas_sesuai FROM public.gresik_rumija_d WHERE kode_desa = $desa AND keterangan = 'SESUAI';";
    $sesuai_result = pg_fetch_all(pg_query($dbcon, $sesuai_sql));
    foreach ($sesuai_result as $sesuai_result) : 
        $sesuai_total = $sesuai_result['luas_sesuai']; 
    endforeach;

    $estimasi_sql = "SELECT SUM(luas) AS luas_estimasi FROM public.gresik_rumija_d WHERE kode_desa = $desa AND keterangan = 'ESTIMASI';";
    $estimasi_result = pg_fetch_all(pg_query($dbcon, $estimasi_sql));
    foreach ($estimasi_result as $estimasi_result) : 
        $estimasi_total = $estimasi_result['luas_estimasi']; 
    endforeach;

    $okupasi_sql = "SELECT SUM(luas) AS luas_okupasi FROM public.gresik_rumija_d WHERE kode_desa = $desa AND keterangan = 'OKUPASI';";
    $okupasi_result = pg_fetch_all(pg_query($dbcon, $okupasi_sql));
    foreach ($okupasi_result as $okupasi_result) : 
        $okupasi_total = $okupasi_result['luas_okupasi']; 
    endforeach;

    /*============================================================Untuk Tabel DT4============================================================*/
    // /*-----------------------------------------------------------DT4_Point----------------------------------------------------------------*/
    $dt4_point_sql = "SELECT layer, count(layer) AS total_unit FROM public.dt4_point WHERE kode_desa = $desa GROUP BY layer";
    $dt4_point_result = pg_fetch_all(pg_query($dbcon, $dt4_point_sql));
    
    // /*-----------------------------------------------------------DT4_Line----------------------------------------------------------------*/
    $dt4_line_sql = "SELECT layer, count(layer) AS total_unit FROM public.dt4_linestring WHERE kode_desa = $desa GROUP BY layer";
    $dt4_line_result = pg_fetch_all(pg_query($dbcon, $dt4_line_sql));
    
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
            <h2>Data Teknik 4</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Jenis Perlengkapan Jalan</th>
                        <!-- <th>KI</th>
                        <th>MID</th>
                        <th>KA</th> -->
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dt4_line_result as $dt4_line_result) :?>
                        <tr>
                            <td><?php echo htmlspecialchars($tahun); ?></td>
                            <td><?php echo htmlspecialchars($dt4_line_result['layer']); ?></td>
                            <!-- <td>2</td>
                            <td>-</td>
                            <td>1</td> -->
                            <td><?php echo htmlspecialchars($dt4_line_result['total_unit']); ?></td>
                        </tr>
                    <?php endforeach;?>
                    <?php foreach($dt4_point_result as $dt4_point_result) :?>
                        <tr>
                            <td><?php echo htmlspecialchars($tahun); ?></td>
                            <td><?php echo htmlspecialchars($dt4_point_result['layer']); ?></td>
                            <!-- <td>2</td>
                            <td>-</td>
                            <td>1</td> -->
                            <td><?php echo htmlspecialchars($dt4_point_result['total_unit']); ?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </body>
</html>
