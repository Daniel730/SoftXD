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
        <link rel="stylesheet" href="./../css/tabela.css">
        <style>
        .btn-analise{
            outline: none;
            border: none;
            border-radius: 5px;
            padding: 5px;
            color: white;
            background-color: blue;
            cursor: pointer;
        }
        </style>
        <title>Programa de Estatistica</title>
    </head>
    <body>
        <?php
            include("./navbar.php");
        ?>
        <div class="container-geral" onclick="menuFecha()">
            <section class="area-result">
                <div class="table-result">
                    <h1 class="title-table">Resultado</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>Processo estatístico</th>
                                    <th>Nome da variável</th>
                                    <th>Nome da Frequência</th>
                                    <th>Tipo da variável</th>
                                    <th>Medida separatriz</th>
                                    <th>Val. Med. Sep.</th>
                                    <th>Data da análise</th>
                                    <th>Dado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <?php
                                        include("./inc.db_connection.php");
                                        $sql = mysqli_query($conexao, "SELECT * FROM logs");
                                        while($row = mysqli_fetch_assoc($sql)){
                                            echo "
                                            <tr>
                                                <td>".$row['processo']."</td>
                                                <td>".$row['nomeVar']."</td>
                                                <td>".$row['nomeFreq']."</td>
                                                <td>".$row['tipoVar']."</td>
                                                <td>".$row['medSep']."</td>
                                                <td>".$row['valMedSep']."%</td>
                                                <td>".$row['data']."</td>
                                                <td>".$row['dados']."</td>
                                                <td><a href='verLog.php?id=".$row['id']."'><button class='btn-analise'>Ver análise</button></a></td>
                                            </tr>
                                            ";
                                        }
                                    ?>
                                    <!-- <td></td> -->
                                
                            </tbody>
                        </table>
                    </div>
                </div>
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
    <script src="./menu.js"></script>
</html>