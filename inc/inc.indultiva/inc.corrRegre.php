<?php 
    session_cache_expire(65);
    session_start();
    if(empty($_SESSION)){
        header("Location: ./../index.php");
    }
    if(isset($_POST['calc'])){
        //Calculo Correlação
        // $nomeX = $_POST['nomeX'];
        // $nomeY = $_POST['nomeY'];
        $varX = $_POST['varX'];
        $varY = $_POST['varY'];


        $varInd = preg_split( "[;]", $varX);
        $varDep = preg_split( "[;]", $varY);
        $n = sizeof($varDep);
        $somXY = 0;
        $somX = 0;
        $somY = 0;
        $somXq = 0;
        $somYq = 0;
        for($i = 0; $i < sizeof($varInd); $i++){
            // echo "Var dependente: ".$varDep[$i]."<br>";
            // echo "Var independente: ".$varInd[$i]."<br>";
            $somXY += round($varDep[$i] * $varInd[$i], 2);
            // echo "Dep*Ind: ".$varDep[$i]*$varInd[$i]."<br>";
            $somX += $varInd[$i];
            $somY += $varDep[$i];
            $somXq += round((pow($varInd[$i], 2)), 2);
            $somYq += round((pow($varDep[$i], 2)), 2);
        }
        // echo "Soma de Xi: ". $somX . "<br>";
        // echo "Soma de Yi: ". $somY . "<br>";
        // echo "Soma de Xi*Yi: ". $somXY . "<br>";
        // echo "Soma de Xi quadrado: ". $somXq . "<br>";
        // echo "Soma de Yi quadrado: ". $somYq . "<br>";
        $r = round((($n*$somXY)-($somX*$somY))/sqrt((($n*$somXq)-(pow($somX, 2)))*($n*$somYq-(pow($somY, 2)))), 2);
        // echo $r;
        $correlacao = '';
        if(abs($r) > 0 && abs($r) < 0.3){
            if(abs($r) == 0){
                $correlacao = "Inexistente";
            }else{
                $correlacao = "Fraca";
            }
        }
        if(abs($r) > 0.3 && abs($r) < 0.6){
            if(abs($r) == 0.3){
                $correlacao = "Fraca";
            }else{
                $correlacao = "Média";
            }
        }
        if(abs($r) > 0.6 && abs($r) < 1){
            if(abs($r) == 0.6){
                $correlacao = "Média";
            }else{
                $correlacao = "Forte";
            }
        }
        // abs$rT = abs(number_format($r, 2)) * 100;
        // echo $rT."%<br>";
        // echo number_format($r, 2)."<br>";
        
        //Cálculo Regrassão

        $a = round((($n*$somXY)-($somX*$somY))/(($n * $somXq) - (pow($somX, 2))), 2);
        // echo round($a,2)."<br>";
        // echo $a."<br>";
        $y = round(($somY/$n), 2);
        $x = round(($somX/$n), 2);
        $b = round(($y-$a*$x), 2);
        // echo round($b,2)."<br>";
        $dadoXY = [];
        for($i = 0; $i < sizeof($varDep); $i++){
            array_push($dadoXY, "{x: $varInd[$i], y:$varDep[$i]}");
        }

        $maior = $varDep[0];
        $menor = $varDep[0];
        // $linha = [];
        for($i = 0; $i < sizeof($varDep); $i++){
            // echo "Var:".$varDep[$i]."<br>";
            // echo "Maior:".$maior."<br>";
            // echo "Menor:".$menor."<br>";
            if($maior < $varDep[$i]){
                $maior = $varDep[$i];
                // echo "maior:".$maior."<br>";
            }
            if($menor > $varDep[$i]){
                $menor = $varDep[$i];
                // echo "menor:".$menor."<br>";
            }
        }
        // $linha = ["{x:($menor - $b)/$a,y: $menor},{x:($maior - $b)/$a,y: $maior}"];
        // echo $dadoXY[0];
    }else{
        header("Location: ./../correlacao.php");
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
    <body onload="grafico()">
        <?php
            include("./../inc.descritiva/navbarD.php");
        ?>
        <div class="container-geral" onclick="menuFecha()">
            <section class="area-result">
                <div class="table-result">
                    <h1 class="title-table">Resultado</h1>
                    <?php 
                        // include("./inc.corrContas.php");
                        
                        echo '<div class="area-result-contas">';
                        echo '  <div class="results result-correla">
                                    <h3>Correlação</h3>
                                    <span>'.$correlacao.'</span>
                                </div>';
                        echo '  <div class="results result-correla">
                                    <h3>Coeficiente Linear</h3>
                                    <span>'.number_format($r, 2).'</span>
                                </div>';
                        echo '  <div class="results result-correla">
                                    <h3>Equação da Reta</h3>
                                    <span>Y = '.round($a,2).'X+'.round($b,2).'</span>
                                </div>';
                        echo '  <div class="results result-correla">
                                    <h3>Projeção Futura</h3>
                                    <span><input onkeyup="calcY(this.value)" type="number" class="input-xy"  placeholder="Y" id="y"> = '.round($a,2).'<input  onkeyup="calcX(this.value)" type="number" class="input-xy" placeholder="X" id="x">+'.round($b,2).'</span>
                                    <span id="resposta"></span>
                                </div>';
                        
                        echo '</div>'
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
    <script src="./../inc.descritiva/menu.js"></script>
    <script src="./../../node_modules/chart.js/dist/Chart.js"></script>
    <script src="./../../js/js.js"></script>
    <script>
        var dado = [];
        var linha = [{
            x: <?php echo ($menor - $b)/$a ?>,
            y: <?php echo $menor?>
        },
        {
            x: <?php echo ($maior - $b)/$a?>,
            y: <?php echo $maior?>
        }];
        function juntaDadoXY(dadoXY){
            dado.push(dadoXY)
        }
        var x = 0;
        var y = 0;
        var a = <?php echo $a;?>;
        var b = <?php echo $b;?>;
        var pfxy = 0;
        var resposta = "";
        function calcX(cx){
            x = cx;
            if(y != 0 && x != 0){
                resposta = "Projeção futura ilógica! Informe somente o X ou Y!";
                document.getElementById('resposta').innerHTML = resposta;
            }else{
                pfxy = (a*x)+b;
                resposta = "Projeção futura de x = "+x+" é y = "+pfxy.toFixed(2);
                document.getElementById('resposta').innerHTML = resposta;
            }
            if(y == 0 & x == 0){
                document.getElementById('resposta').innerHTML = '';
            }
        }
        function calcY(cy){
            y = cy;
            if(y != 0 && x != 0){
                resposta = "Projeção futura ilógica! Informe somente o X ou Y!";
                document.getElementById('resposta').innerHTML = resposta;
            }else{
                pfxy = (y-b)/a;
                resposta = "Projeção futura de y = "+y+" é x = "+pfxy.toFixed(2);
                document.getElementById('resposta').innerHTML = resposta;
            }
            if(y == 0 & x == 0){
                document.getElementById('resposta').innerHTML = '';
            }
        }
        function grafico(){
            var ctx = document.getElementById("myChart");
            var mixedChart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: [{
                        label: 'Correlação x y',
                        data: dado,
                        backgroundColor: "rgba(42,18,197,1)"
                    },
                    {
                        type: 'line',
                        label: 'Reta',
                        data: linha,
                        showLine: true,
                        fill: false,
                        backgroundColor: "black",
                        pointBorderColor: "black",                
                        borderColor: "black"                
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            beginAtZero: true
                        }],
                        xAxes: [{
                            beginAtZero: true    
                        }],
                    },
                    elements: {
                        line: {
                            tension: 0
                        }
                    }
                }
            });
        }
        <?php
            for($i = 0; $i < sizeof($dadoXY); $i++){
                echo "juntaDadoXY($dadoXY[$i]);";
            }
        ?>
    </script>
</html>