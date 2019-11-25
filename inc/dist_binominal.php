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
                    <form method='POST' action='./inc.indultiva/inc.distBinomial.php' class="form-descritiva">
                        <h2 class="titulo-form">Distribuição Binominal</h2>
    
                        <div class="area-info ">
                            <h4 class="titulos">Tamanho da Amostra(n)</h4>
                            <input type="text" placeholder="Ex:12" name='n' class="inputs" required>
                        </div>
    
                        <div class="area-info">
                            <h4 class="titulos">Evento(k)</h4>
                            <input type="text" placeholder="Ex:3.2" name='k' class="inputs" required>
                        </div>
    
                        <div class="area-info">
                            <h4 class="titulos">Sucesso(p)</h4>
                            <input type="text" placeholder="Ex:0.1" name='p' class="inputs" required>
                        </div>

                        <div class="area-info">
                            <h4 class="titulos">Fracasso(q)</h4>
                            <input type="text" placeholder="Ex:0.9" name='q' class="inputs" required>
                        </div>

                        <div class="enviar-form">
                            <button class="btns btn-verificar">Verificar</button>
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
</html>