<?php 
    session_cache_expire(65);
    session_start();
    if(empty($_SESSION)){
        header("Location: ./../index.php");
    }
    // echo $_POST['medidas']; 
    echo "<script> var erro = 2</script>";
    if(isset($_POST['verificar'])){
        $pMax = $_POST['pMax'];
        $pMin = $_POST['pMin'];
        $med = $_POST['medidas'];

        if($med == 'maior'){
            $a = $_POST['a'];
            $int = $pMax - $a;
            $f = (1/($pMax - $pMin))*$int;
            $med = ($pMax + $pMin)/2;
            // $dp = pow((pow(($pMax-$pMin),2))/12 , 1/2);
            $dp1 = pow($pMax-$pMin, 2);
            $dp = sqrt($dp1/12);
            $cv = ($dp/$med)*100;
        }
        if($med == 'menor'){
            $a = $_POST['a'];
            $int = $a - $pMin;
            $f = (1/($pMax - $pMin))*$int;
            $med = ($pMax + $pMin)/2;
            // $dp = pow((pow(($pMax-$pMin),2))/12 , 1/2);
            $dp1 = pow($pMax-$pMin, 2);
            $dp = sqrt($dp1/12);
            $cv = ($dp/$med)*100;
        }
        if($med == 'entre'){
            $b = $_POST['b'];
            $c = $_POST['c'];

            
            $int = $c - $b;
            $f = (1/($pMax - $pMin))*$int;

            // $intc = $c - $pMin;
            // $fc = (1/($pMax - $pMin))*$intc;

            // $f = $fb - $fc;

            $med = ($pMax + $pMin)/2;
            // $dp = pow((pow(($pMax-$pMin),2))/12 , 1/2);
            $dp1 = pow($pMax-$pMin, 2);
            $dp = sqrt($dp1/12);
            $cv = ($dp/$med)*100;
            //Perguntar MALU sobre como calcular entre

            // $int = $a - $pMax;
            // $f = (1/($pMax - $pMin))*$int;
        }

        // $int;

    }else{
        header("Location: ./../dist_uniforme.php");
    }
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
                        //f(x)
                        echo '<div class="area-result-contas">';
                        echo '<div class="results">';
                        echo '<span>Resultado</span>';
                        echo '<h3> '. $f*100 .'% </h3>';
                        echo '</div>';
                        
                        //media
                        echo '<div class="results">';
                        echo '<span>Média</span>';
                        echo '<h3> '.$med.' </h3>';
                        echo '</div>';
                       
                        //dp
                        echo '<div class="results">';
                        echo '<span>Desvio Padrão</span>';
                        echo '<h3>'.number_format($dp, 2, ',', '.').'</h3>';
                        echo '</div>';
                       
                        //Cv
                        echo '<div class="results">';
                        echo '<span>Coeficiente da variância</span>';
                        echo '<h3>'.number_format($cv, 2, ',', '.').'%</h3>';
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