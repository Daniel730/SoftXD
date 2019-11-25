<?php 
    session_cache_expire(65);
    session_start();
    if(empty($_SESSION)){
        header("Location: ./../index.php");
    }
    echo "<script> var erro = 2</script>";
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
            include("./navbarD.php");
        ?>
        <div class="container-geral" onclick="menuFecha()">
            <section class="area-result">
                <div class="table-result">
                    <h1 class="title-table">Resultado</h1>
                    <?php 
                        include("./inc.descritiva.contas.php");
                    ?>
                </div>
                <div>
                    <canvas id="myChart" width="400" height="400"></canvas>
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
    <script src="./menu.js"></script>
    <script src="./../../node_modules/chart.js/dist/Chart.js"></script>
    <script src="./../../js/js.js"></script>
    <script>
        
        <?php
            echo "initialize(dado, background, labels, '$tipoVar')";
        ?>
        
    </script>
</html>