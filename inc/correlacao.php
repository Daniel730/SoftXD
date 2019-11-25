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
        <link rel="stylesheet" href="./../photon/dist/css/photon.min.css">
        <title>Programa de Estatistica</title>
    </head>
    <body>
        <?php
            include("./navbar.php");
        ?>
        <div class="container-geral">
            <section class="conteudo-principal">
                <div class="area-principal-descritiva">
                    <form action="./inc.indultiva/inc.corrRegre.php" method="POST" class="form-descritiva">
                        <h2 class="titulo-form">Correlação e Regressão</h2>
                        <!-- <div class="area-info ">
                            <h4 class="titulos">Nome da variável Independente(X)</h4>
                            <input type="text" placeholder="Nome" name="nomeX" class="inputs">
                        </div>
                        <div class="area-info">
                            <h4 class="titulos">Nome da variável Dependente(Y)</h4>
                            <input type="text" placeholder="Ex:Número de vendas" name="nomeY" class="inputs">
                        </div> -->
                        <div class="area-info">
                            <h4 class="titulos">Histórico da variável Independente(X)</h4>
                            <input type="text" placeholder="Ex:10;20;30" name="varX" id="vI" class="inputs">
                        </div>
                        <div class="area-info">
                            <h4 class="titulos">Histórico da variável Dependente(Y)</h4>
                            <input type="text" placeholder="Ex:8;30;15;7" name="varY" id="vD" class="inputs input-dados">
                            <label class="text-selecao" for="selecao-arquivo">Selecione um arquivo</label>
                            <input id="selecao-arquivo" class="es btns seleciona-arq" type="file" onchange="pegaCSV(this)" accept=".csv , .txt" >
                        </div>
                        <div class="enviar-form">
                            <button class="btns btn-verificar" name="calc">Calcular</button>
                        </div>
                    </form>
                </div>
            </section>
            <footer class="footer">
                <h3>SoftXD - Daniel</h3>
            </footer>
        </div>
    </body>
    <script src="./../js/jquery/jquery-3.4.1.slim.min.js"></script>
    <script src="./../js/nav.js"></script>
    <script src="./../js/menu.js"></script>
    <script>
        var leitorDeCSV = new FileReader()
        window.onload = function init() {
            leitorDeCSV.onload = leCSV;
        }

        function pegaCSV(inputFile) {
            var file = inputFile.files[0];
            leitorDeCSV.readAsText(file);
        }

        function leCSV(evt) {
            var fileArr = evt.target.result;
            fileArr =  fileArr.split("\n")
            document.getElementById("vI").value = fileArr[0]
            document.getElementById("vD").value = fileArr[1]

        }
    </script>
</html>