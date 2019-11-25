<?php 
    session_cache_expire(65);
    session_start();
    if(empty($_SESSION)){
        header("Location: ./../index.php");
    }
    echo "<script> var erro = 2</script>";
    $n = $_POST['n'];
    $k = $_POST['k'];
    $p = $_POST['p'];
    $q = $_POST['q'];
    $comN = 1;
    $comK = 1;
    $subNK = $n - $k;
    $comSubNK = 1;
    $comNK = 1;
    $media = 0;
    $dp = 0;
    $PK = pow($p, $k);
    $qnk = pow($q, $subNK);
    $f = 0;

    for($i = $n; $i != 0; $i--){
        // echo $i;
        $comN = $comN * $i; 
    }

    for($i = $k; $i != 0; $i--){
        $comK = $comK * $i; 
    }

    for($i = $subNK; $i != 0; $i--){
        $comSubNK = $comSubNK * $i; 
    }
    // echo $comN;
    $comNK = ($comN/($comK*$comSubNK));
    $media = $n*$p;
    $dp = sqrt($n*$p*$q);
    $f = number_format(($comNK * $PK * $qnk)*100, 2);


    // echo $f;
    // echo $comNK;
?>
<!DOCTYPE html>
<html lang="pt-br" style="overflow: auto !important">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./../../css/index.css">
        <link rel="stylesheet" href="./../../css/descritiva.css">
        <link rel="stylesheet" href="./../../css/animate.css">
        <link rel="stylesheet" href="./../../photon/dist/css/photon.min.css">
        <link rel="stylesheet" href="./../../css/tabela.css">
        <link rel="stylesheet" href="./../../node_modules/chart.js/dist/Chart.css">
        
        <title>Programa de Estatistica</title>
    </head>
    <body>
        <?php
            include("./../inc.descritiva/navbarD.php");
        ?>
        <div class="container-geral" onclick="menuFecha()">
            <section class="area-result">
                <div class="table-result">
                    <h1 class="title-table">Resultado</h1>
                    <?php
                        echo '<div class="area-result-contas">';
                        echo '<div class="results">';
                        echo '<h3> '.$f.'% </h3>';
                        echo '</div>';
                        echo '</div>';
                    ?>
                </div>
                
            </section>
            <footer class="footer">
                <h3>SoftXD - Daniel</h3>
            </footer>
        </div>
    </body>
    <script src="./../../js/jquery/jquery-3.4.1.slim.min.js"></script>
    <script src="./../../js/efeitos.js"></script>
    <script src="./../../js/nav.js"></script>
    <script src="./../inc.descritiva/menu.js"></script>
    <script src="./../../node_modules/chart.js/dist/Chart.js"></script>
    <script src="./../../js/js.js"></script>
</html>