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
        <link rel="stylesheet" href="./../css/index.css">
        <link rel="stylesheet" href="./../css/descritiva.css">
        <link rel="stylesheet" href="./../css/animate.css">
        <link rel="stylesheet" href="./../photon/dist/css/photon.min.css">
        <title>Programa de Estatistica</title>
    </head>
    <body onload="initialize()">
        <?php
            include("./navbar.php");
        ?>
        <div class="container-geral" onclick="menuFecha()">
                <section class="conteudo-principal animated fadeIn">
                    <form action="./inc.descritiva/inc.descritiva.php" method="POST">
                        <div class="area-principal-descritiva">
                            <div class="form-descritiva">
                                <h2 class="titulo-form">Estatística Descritiva</h2>
                                <!-- Tipo de variavel -->
                                <div class="titulo-variavel">
                                    <h4>Tipo de Variável</h4>
                                </div>
                                <div class="area-radio-btn" name="radio">
                                    <div class="container-radio">
                                        <input type="radio" onclick="habilita()" class="btn-radio" name="descritiva" id="nominal" value="nominal" checked>
                                        <label class="text-radio" for="nominal">Qualitativa Nominal</label>
                                    </div>
                                    <div class="container-radio">
                                        <input type="radio" onclick="habilita()" class="btn-radio" name="descritiva" id="ordinal" value="ordinal">
                                        <label class="text-radio" for="ordinal">Qualitativa Ordinal</label>
                                    </div>
                                    <div class="container-radio">
                                        <input type="radio" onclick="habilita()" class="btn-radio" name="descritiva" id="discreta" value="discreta">
                                        <label class="text-radio" for="discreta">Quantitativa Discreta</label>
                                    </div>
                                    <div class="container-radio">
                                        <input type="radio" onclick="habilita()" class="btn-radio" name="descritiva" id="continua" value="continua">
                                        <label class="text-radio" for="continua">Quantitativa Contínua</label>
                                    </div>
                                </div>
                                <!-- Ordenação da variavel ordinal -->
                                <div class="area-info" id="ordinais" style="display: none;">
                                    <h4 class="titulos">Ordenação das variáveis ordinais</h4>
                                    <input type="text" placeholder="Ex:bom;regular;pessimo" class="inputs" name="ordemOrd">
                                </div>
                                <!-- Processo estatístico -->
                                <div class="titulo-variavel">
                                    <h4>Processo Estatístico</h4>
                                </div>
                                <div class="area-radio-btn">
                                    <div class="container-radio">
                                        <input type="radio" class="btn-radio" name="processo" id="amostra"  value="amostra" checked>
                                        <label class="text-radio" for="amostra">Amostra (Estimação)</label>
                                    </div>  
                                    <div class="container-radio">
                                        <input type="radio" class="btn-radio" name="processo" id="populacao" value="populacao">
                                        <label class="text-radio" for="populacao">Censo (População)</label>
                                    </div>
                                </div>
                                <!-- Nome da variavel -->
                                <div class="area-info">
                                    <h4 class="titulos">Nome da Variável</h4>
                                    <input type="text" placeholder="Ex:Número de vendas" class="inputs" name ="nomeVar" id="" required>
                                </div>
                                <!-- Nome da frequência -->
                                <div class="area-info">
                                    <h4 class="titulos">Nome da Frequência</h4>
                                    <input type="text" placeholder="Ex:Quantidade de Representantes" class="inputs" name="nomeFreq" id="" required>
                                </div>
                                <!-- Medida separatrizes -->
                                <div class="titulo-variavel">
                                    <h4>Medidas Separatrizes</h4>
                                </div>
                                <div class="area-radio-btn">
                                    <div class="container-radio">
                                        <input type="radio" class="btn-radio" name="medidas" id="quartil" value="quartil">
                                        <label class="text-radio" for="quartil">Quartil</label>
                                    </div>  
                                    <div class="container-radio">
                                        <input type="radio" class="btn-radio" name="medidas" id="quintil" value="quintil">
                                        <label class="text-radio" for="quintil">Quintil</label>
                                    </div>
                                    <div class="container-radio">
                                        <input type="radio" class="btn-radio" name="medidas" id="decil" value="decil">
                                        <label class="text-radio" for="decil">Decil</label>
                                    </div>
                                    <div class="container-radio">
                                        <input type="radio" class="btn-radio" name="medidas" id="porcentil" value="porcentil">
                                        <label class="text-radio" for="porcentil">Porcentil</label>
                                    </div>
                                </div>
                                <!-- input range -->
                                <div class="area-radio-btn" id="range" style="display: none">
                                    <div class="container-radio pointer-range" style="max-width: 500px; width: 100%">
                                        <label id="teste" class="txt-pointer">0%</label>
                                        <input class="input-range" type="range" onchange="arrasta()" oninput="arrasta()" id="pointer" name="pointer" min="0" max="100" step="25" value="0"> 
                                    </div>
                                </div>
                                <!-- Inserir quantidade de variavel -->
                                <form>
                                    <div class="area-info">
                                        <h4 class="titulos">Informe a quantidade de dados</h4>
                                        <input type="text" class="inputs input-qtd-dados" id="var">
                                        <input type="number" class="inputs input-qtd-dados" id="qtdVar">
                                        <input type="button" class="es btns" onclick="adicionar()" value="Adicionar">
                                    </div>
                                </form>
                                <!-- Entrada de dados -->
                                <div class="area-info">
                                    <h4 class="titulos">Entrada de dados</h4>
                                    <input type="text" placeholder="Ex:8;30;15;7" required class="inputs input-dados" name="dado" id="dados">
                                    <button class="es btns">Escolha um Arquivo</button>
                                </div>
                                <div class="enviar-form">
                                    <button class="ver btns btn-verificar">Verificar</button>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </form>
                </section>
            <footer class="footer">
                <h3>SoftXD - Daniel</h3>
            </footer>
        </div>
    </body>
    <script src="./../js/jquery/jquery-3.4.1.slim.min.js"></script>
    <script src="./../js/js.js"></script>
    <script src="./../js/efeitos.js"></script>
    <script src="./../js/nav.js"></script>
    <script src="./../js/menu.js"></script>
    <script>
        function adicionar(){
            var quantidade = document.getElementById("qtdVar").value;
            var dado = document.getElementById("var").value;

            for(var i = 0; i < quantidade; i++){
                if(document.getElementById("dados").value != ""){
                    document.getElementById("dados").value += ";"+dado;
                }else{
                    document.getElementById("dados").value += dado;
                }
                
            }
        }
        function arrasta(){
            document.getElementById("teste").innerHTML = document.getElementById("pointer").value +"%";
        }

        $("#quartil").click(function(){
            if(document.getElementById("quartil").checked == true){
                $("#range").css("display", "flex");
                $("#pointer").attr("step", "25");
                $("#pointer").addClass("animated fadeIn");
            }
        })
        $("#quintil").click(function(){
            if(document.getElementById("quintil").checked == true){
                $("#range").css("display", "flex");
                $("#pointer").attr("step", "20");
                $("#pointer").addClass("animated fadeIn");
            }
        })
        $("#decil").click(function(){
            if(document.getElementById("decil").checked == true){
                $("#range").css("display", "flex");
                $("#pointer").attr("step", "10");
                $("#pointer").addClass("animated fadeIn");
            }
        })
        $("#porcentil").click(function(){
            if(document.getElementById("porcentil").checked == true){
                $("#range").css("display", "flex");
                $("#pointer").attr("step", "1");
                $("#pointer").addClass("animated fadeIn");
            }
        })
        function habilita(){
            if(document.getElementById("nominal").checked == true){
                $("#dados").attr("placeholder", "Ex:cor dos olhos/sexo/doente");
            }
            if(document.getElementById("ordinal").checked == true){
                $("#dados").attr("placeholder", "Ex:EM;EF;ES;PG");
            }
            if(document.getElementById("discreta").checked == true){
                $("#dados").attr("placeholder", "Ex:8;30;15;7");
            }
            if(document.getElementById("continua").checked == true){
                $("#dados").attr("placeholder", "Ex:8;30;15;7");
            }

            if(document.getElementById("ordinal").checked == true){
                $("#ordinais").css("display", "block");
            }else{
                $("#ordinais").css("display", "none");
            }
        }
        function initialize(){
            habilita();
            arrasta();
        }
    </script>
    
    
</html>