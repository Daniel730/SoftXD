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
                    <form method='POST' action='./inc.indultiva/inc.distUniforme.php' class="form-descritiva">
                        <h2 class="titulo-form">Distribuição Uniforme</h2>
    
                        <div class="area-info ">
                            <h4 class="titulos">Ponto Máximo</h4>
                            <input type="text" placeholder="Ex:12" name='pMax' class="inputs">
                        </div>
    
                        <div class="area-info">
                            <h4 class="titulos">Ponto Mínimo</h4>
                            <input type="text" placeholder="Ex:3.2" name='pMin' class="inputs">
                        </div>
    
                        <div class="titulo-variavel">
                            <h4>Intervalo da Análise</h4>
                        </div>
                        <div class="area-radio-btn">
                            <div class="container-radio">
                                <input onclick='verifica(this.value)' value='menor' type="radio" class="btn-radio" id='menorq' name="medidas">
                                <label class="text-radio" for='menorq'>Menor que</label>
                            </div>
                            <div class="container-radio">
                                <input onclick='verifica(this.value)' value='entre' type="radio" class="btn-radio" id='entre' name="medidas">
                                <label class="text-radio" for='entre'>Entre</label>
                            </div>
                            <div class="container-radio">
                                <input onclick='verifica(this.value)' value='maior' type="radio" class="btn-radio" id='maiorq' name="medidas">
                                <label class="text-radio" for='maiorq'>Maior que</label>
                            </div>
                        </div>
                        <div id='mm' class="area-info" style='display:none'>
                            <h4 id='titM' class="titulos"></h4>
                            <input type="text" placeholder="Ex:8" name='a' class="inputs input-dados">
                            <!-- <input type="text" placeholder="Ex:8" class="inputs input-dados"> -->
                            <!-- <button class="btns">Escolha um Arquivo</button> -->
                        </div>
                        <div id='ent' class="area-info entre-div" style='display:none'>
                            <h4 class="titulos entre-text">Entre</h4>
                            <input type="text" placeholder="Ex:1" name='b' class="inputs input-dados entre">
                            <h4 class="titulos entre-text">e</h4>
                            <input type="text" placeholder="Ex:8" name='c' class="inputs input-dados entre">
                            <!-- <button class="btns">Escolha um Arquivo</button> -->
                        </div>
                        <div class="enviar-form">
                            <button class="btns btn-verificar" name='verificar'>Verificar</button>
                        </div>
                    </form>
                </div>
                <div>
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
    function verifica(dado){
        // alert(dado)
        if(dado == 'menor'){
            // alert(dado)
            document.getElementById('titM').innerHTML = "Menor que:";
            $('#ent').css('display', 'none');
            $('#mm').css('display', 'block');
        }
        if(dado == 'entre'){
            // alert(dado)
            $('#mm').css('display', 'none');
            $('#ent').css('display', 'flex');
        }
        if(dado == 'maior'){
            document.getElementById('titM').innerHTML = "Maior que:";
            $('#ent').css('display', 'none');
            $('#mm').css('display', 'block');
            // $('#mm').css('display', 'flex');
        }
    }
    </script>
</html>