<?php
date_default_timezone_set('America/Sao_Paulo'); 
$tipoVar = $_POST['descritiva'];
// echo "<script>var tipoVar = document.write('$tipoVar')</script>";
$processo = $_POST['processo'];
$nomeVar = $_POST['nomeVar'];
$nomeFreq = $_POST['nomeFreq'];
$medSep = $_POST['medidas'];
$valMedSep = $_POST['pointer'];
$ordem = "";
if(isset($_POST['ordemOrd'])){
    $ordem = $_POST['ordemOrd'];
}
$dados = $_POST['dado'];
$data = date('Y-m-d H:i:s');

include("./../inc.db_connection.php");
$sql = mysqli_query($conexao, "INSERT INTO logs(processo, ordemOrdinal, nomeVar, nomeFreq, tipoVar, medSep, valMedSep, data, dados) VALUES('$processo', '$ordem', '$nomeVar', '$nomeFreq', '$tipoVar', '$medSep', '$valMedSep', '$data', '$dados')");

if($sql){

}

function random_color() {
    $letters = '0123456789ABCDEF';
    $color = '#';
    for($i = 0; $i < 6; $i++) {
        $index = rand(0,15);
        $color .= $letters[$index];
    }
    return $color;
}

$nomeRep = [];
$auxCont = 0;
$auxContVet = [];
$ordenados = [];
// $tamanho = 0;

function ordenaOrdinais($dado, $ordem){
    $tipoVar = $_POST['descritiva'];
    $processo = $_POST['processo'];
    $nomeVar = $_POST['nomeVar'];
    $nomeFreq = $_POST['nomeFreq'];
    $medSep = $_POST['medidas'];
    $valMedSep = $_POST['pointer'];
    $dados = $_POST['dado'];

    $nomeRep = [];
    $auxCont = 0;
    $auxContVet = [];
    $ordenados = [];
    $aux = 0;
    // echo sizeof($ordem);
    
    for($i = 0; $i < sizeof($ordem); $i++){
        for($j = 0; $j < sizeof($dado); $j++){
            if($dado[$j] == $ordem[$i]){
                $ordenados[$aux] = $dado[$j];
                // echo $ordenados[$aux].";";
                $aux++;
                
            }
        }
    }

    $nomeRep[0] = $ordenados[0];
    // echo $nomeRep[0];
    $aux = 0;

    for($i = 0; $i < sizeof($ordenados); $i++){
        if($ordenados[$i] == $nomeRep[$aux]){
            $auxCont++;
            $auxContVet[$aux] = $auxCont;
        }else{
            $auxCont = 1;
            $aux++;
            $nomeRep[$aux] = strval($ordenados[$i]);
            $auxContVet[$aux] = $auxCont;
        }
    }

    $total = 0;
    $fr = [];

    for($i = 0; $i<sizeof($auxContVet); $i++){
        $total += $auxContVet[$i];
    }

    for($i = 0; $i<sizeof($auxContVet); $i++){
        $fr[$i] = ($auxContVet[$i]*100)/$total;
        // echo $fr[$i]."<br>";
    }

    $total = 0;
    $fac = [];
    $fac[0] = $auxContVet[0];

    for($i = 1; $i<sizeof($auxContVet); $i++){
        $fac[$i] = $fac[$i-1] + $auxContVet[$i];
    }

    $total = 0;
    $facP = [];
    
    for($i = 0; $i<sizeof($auxContVet); $i++){
        $total += $auxContVet[$i];
    }

    $facP[0] = ($auxContVet[0]*100)/$total;

    for($i = 1; $i<sizeof($auxContVet); $i++){
        $facP[$i] = $facP[$i-1]+(($auxContVet[$i]*100)/$total);
    }

    // echo $fac[1];
    // echo $fr[0];
    // echo $nomeRep[0]."<br>";
    // echo $auxContVet[0];
    
    // echo $nomeRep[0];

    //crie uma variável para receber o código da tabela
    $tabela = '<table border="1">';//abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    $tabela .= '<th>'.$nomeVar.'</th>'; // colunas do cabeçalho
    $tabela .= '<th>'.$nomeFreq.'</th>';
    $tabela .= '<th>fr%</th>';
    $tabela .= '<th>Fac</th>';
    $tabela .= '<th>Fac%</th>';
    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela

    for($i = 0; $i < sizeof($nomeRep);$i++){
        $tabela .= '<tr>'; // abre uma linha
        $tabela .= '<td>'.$nomeRep[$i].'</td>'; // coluna nomeVar
        $tabela .= '<td>'.$auxContVet[$i].'</td>'; //coluna Freq
        $tabela .= '<td>'.number_format($fr[$i], 2, '.', '').'%</td>'; // coluna fr%
        $tabela .= '<td>'.$fac[$i].'</td>'; //coluna Fac
        $tabela .= '<td>'.number_format($facP[$i], 2, '.', '').'%</td>';//coluna Fac%
        $tabela .= '</tr>'; // fecha linha
    }

    // $tamanho = sizeof($nomeRep);

    $tabela .='</tbody>'; //fecha corpo
    $tabela .= '</table>';//fecha tabela
    echo "<script> var tamanho = ".sizeof($nomeRep)."</script>";
    echo $tabela;
    echo '<div class="area-result-contas">';

    //=============================================   MMM   =========================================================================
    $moda = "";
    $auxMaior = $auxContVet[0];
    for($i = 0; $i < sizeof($auxContVet); $i++){
        if($auxMaior <= $auxContVet[$i]){
            $auxMaior = $auxContVet[$i];
            $moda = $nomeRep[$i];
        }
    }

    echo '<div class="results">
            <h3>Moda</h3>
            <span>'.$moda.'</span>
        </div>';
    
    $mediana0 = "";
    $mediana1 = "";
    $auxMediana = floor(sizeof($dado)/2);
    if(sizeof($dado)%2 == 0){
        $auxMed1 = $auxMediana+1;
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMediana){
                $mediana0 = $nomeRep[$i];
                break;
            }
            
        }
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMed1){
                $mediana1 = $nomeRep[$i];
                break;
            }
        }
        // echo $auxMediana. "<br>";
        echo '<div class="results">
                <h3>Mediana 01</h3>
                <span>'.$mediana0.'</span>
            </div>
            <div class="results">
                <h3>Mediana 02</h3>
                <span>'.$mediana1.'</span>
            </div>';
        // echo "A mediana 1 é: " . $mediana0 . "<br>E a mediana 2 é: ". $mediana1."<br";

    }else{
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMediana){
                $mediana0 = $nomeRep[$i];
                break;
            }
        }
        echo '<div class="results">
                <h3>Mediana</h3>
                <span>'.$mediana0.'</span>
            </div>';
        // echo "A mediana é: ". $mediana0."<br>";
    }
    //====================================Medidas separatrizes=====================================
    $md = (($fac[sizeof($fac)-1]) / (100/$valMedSep));
    for($i = 0; $i < sizeof($dado); $i++){
        if($fac[$i] >= $md){
            // echo $nomeRep[$i]."<br>";
            if($medSep == "quartil"){
                $medSep = "Q";
            }else if($medSep == "quintil"){
                $medSep = "K";
            }else if($medSep == "decil"){
                $medSep = "D";
            }else if($medSep == "porcentil"){
                $medSep = "P";
            }
            echo '<div class="results">
                    <h3>'.$medSep.'<small style="font-size: 10px;">'.$valMedSep.'</small></h3>
                    <span>'.$nomeRep[$i].'</span>
                </div>';
            break;
        }
    }
    
    echo "
    <script>
        var dado = [];
        var background = [];
        var labels = [];
    ";
    for($i = 0; $i < sizeof($nomeRep); $i++){
        echo "
            dado[".$i."]=".$auxContVet[$i]."
            background[".$i."]='".random_color()."'
            labels[".$i."] = '".$nomeRep[$i]."'
            ";
    }
    echo "</script>";
    echo '</div>';

}

if($tipoVar == 'nominal'){
    $dado = preg_split("[;]", strval(strtolower($dados)));
    
    // for($i = 0; $i < sizeof($dado); $i++){
    //     if(empty($dado[$i])){
    //         unset($dado[$i]);
    //     }
    // }

    sort($dado);
    $nomeRep[0] = $dado[0];
    // echo $nomeRep[0];
    $aux = 0;

    for($i = 0; $i < sizeof($dado); $i++){
        if($dado[$i] == $nomeRep[$aux]){
            $auxCont++;
            $auxContVet[$aux] = $auxCont;
        }else{
            $auxCont = 1;
            $aux++;
            $nomeRep[$aux] = strval($dado[$i]);
            $auxContVet[$aux] = $auxCont;
        }
    }

    $total = 0;
    $fr = [];

    for($i = 0; $i<sizeof($auxContVet); $i++){
        $total += $auxContVet[$i];
    }

    for($i = 0; $i<sizeof($auxContVet); $i++){
        $fr[$i] = ($auxContVet[$i]*100)/$total;
        // echo $fr[$i]."<br>";
    }

    $total = 0;
    $fac = [];
    $fac[0] = $auxContVet[0];

    for($i = 1; $i<sizeof($auxContVet); $i++){
        $fac[$i] = $fac[$i-1] + $auxContVet[$i];
    }

    $total = 0;
    $facP = [];
    
    for($i = 0; $i<sizeof($auxContVet); $i++){
        $total += $auxContVet[$i];
    }

    $facP[0] = ($auxContVet[0]*100)/$total;

    for($i = 1; $i<sizeof($auxContVet); $i++){
        $facP[$i] = $facP[$i-1]+(($auxContVet[$i]*100)/$total);
    }

    // echo $fac[1];
    // echo $fr[0];
    // echo $nomeRep[0]."<br>";
    // echo $auxContVet[0];
    
    // echo $nomeRep[0];

    //crie uma variável para receber o código da tabela
    $tabela = '<table border="1">';//abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    $tabela .= '<th>'.$nomeVar.'</th>'; // colunas do cabeçalho
    $tabela .= '<th>'.$nomeFreq.'</th>';
    $tabela .= '<th>fr%</th>';
    $tabela .= '<th>Fac</th>';
    $tabela .= '<th>Fac%</th>';
    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela

    for($i = 0; $i < sizeof($nomeRep);$i++){
        $tabela .= '<tr>'; // abre uma linha
        $tabela .= '<td>'.$nomeRep[$i].'</td>'; // coluna nomeVar
        $tabela .= '<td>'.$auxContVet[$i].'</td>'; //coluna Freq
        $tabela .= '<td>'.number_format($fr[$i], 2, '.', '').'%</td>'; // coluna fr%
        $tabela .= '<td>'.$fac[$i].'</td>'; //coluna Fac
        $tabela .= '<td>'.number_format($facP[$i], 2, '.', '').'%</td>';//coluna Fac%
        $tabela .= '</tr>'; // fecha linha
    }

    $tabela .='</tbody>'; //fecha corpo
    $tabela .= '</table>';//fecha tabela

    echo $tabela;
    echo '<div class="area-result-contas">';
    
    //=======================================  MMM  ==================================================================== 
    $moda = "";
    $auxMaior = $auxContVet[0];
    for($i = 0; $i < sizeof($auxContVet); $i++){
        if($auxMaior <= $auxContVet[$i]){
            $auxMaior = $auxContVet[$i];
            $moda = $nomeRep[$i];
        }
    }

    echo '<div class="results">
            <h3>Moda</h3>
            <span>'.$moda.'</span>
        </div>';
    // echo "A moda é: ".$moda."<br>";
    
    $mediana0 = "";
    $mediana1 = "";
    $auxMediana = floor(sizeof($dado)/2);
    if(sizeof($dado)%2 == 0){
        $auxMed1 = $auxMediana+1;
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMediana){
                $mediana0 = $nomeRep[$i];
                break;
            }
            
        }
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMed1){
                $mediana1 = $nomeRep[$i];
                break;
            }
        }
        // echo $auxMediana. "<br>";
        echo '<div class="results">
                <h3>Mediana 1</h3>
                <span>'.$mediana0.'</span>
            </div>
            <div class="results">
                <h3>Mediana 2</h3>
                <span>'.$mediana1.'</span>
            </div>';
        // echo "A mediana 1 é: " . $mediana0 . "<br>E a mediana 2 é: ". $mediana1."<br>";

    }else{
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMediana){
                $mediana0 = $nomeRep[$i];
                break;
            }
        }

        echo '<div class="results">
                <h3>Mediana</h3>
                <span>'.$mediana0.'</span>
            </div>';
        // echo "A mediana é: ". $mediana0."<br>";
    }
    
    //======================================= Medidas separatrizes =======================================
    $md = (($fac[sizeof($fac)-1]) / (100/$valMedSep));
    for($i = 0; $i < sizeof($dado); $i++){
        if($fac[$i] >= $md){
            if($medSep == "quartil"){
                $medSep = "Q";
            }else if($medSep == "quintil"){
                $medSep = "K";
            }else if($medSep == "decil"){
                $medSep = "D";
            }else if($medSep == "porcentil"){
                $medSep = "P";
            }
            echo '<div class="results">
                    <h3>'.$medSep.'<small style="font-size: 10px;">'.$valMedSep.'</small></h3>
                    <span>'.$nomeRep[$i].'</span>
                </div>';
            // echo $nomeRep[$i]."<br>";
            break;
        }
    }
    echo "
    <script>
        var dado = [];
        var background = [];
        var labels = [];
    ";
    for($i = 0; $i < sizeof($nomeRep); $i++){
        echo "
            dado[".$i."]=".$auxContVet[$i]."
            background[".$i."]='".random_color()."'
            labels[".$i."] = '".$nomeRep[$i]."'
        ";
    }
    echo "</script>";
    echo '</div>';

}else if($tipoVar == 'ordinal'){
    $ordem = $_POST['ordemOrd'];
    $dados = $_POST['dado'];

    $dadoOrdem = preg_split("[;]", strval(strtolower($ordem)));
    $saida = preg_split("[;]", strval(strtolower($dados)));
    
    for($i = 0; $i < sizeof($dadoOrdem); $i++){
        if(empty($dadoOrdem[$i])){
            unset($dadoOrdem[$i]);
        }
    }

    for($i = 0; $i < sizeof($saida); $i++){
        if(empty($saida[$i])){
            unset($saida[$i]);
        }
    }

    ordenaOrdinais($saida ,$dadoOrdem);
    
}else if($tipoVar == 'discreta'){
    $dado = preg_split("[;]", strval(strtolower($dados)));
    
    // for($i = 0; $i < sizeof($dado); $i++){
    //     if(empty($dado[$i])){
    //         unset($dado[$i]);
    //     }
    // }

    sort($dado);
    $nomeRep[0] = $dado[0];
    // echo $nomeRep[0];
    $aux = 0;

    for($i = 0; $i < sizeof($dado); $i++){
        if($dado[$i] == $nomeRep[$aux]){
            $auxCont++;
            $auxContVet[$aux] = $auxCont;
        }else{
            $auxCont = 1;
            $aux++;
            $nomeRep[$aux] = strval($dado[$i]);
        }
    }

    $total = 0;
    $fr = [];

    for($i = 0; $i<sizeof($auxContVet); $i++){
        $total += $auxContVet[$i];
    }

    for($i = 0; $i<sizeof($auxContVet); $i++){
        $fr[$i] = ($auxContVet[$i]*100)/$total;
        // echo $fr[$i]."<br>";
    }

    $total = 0;
    $fac = [];
    $fac[0] = $auxContVet[0];

    for($i = 1; $i<sizeof($auxContVet); $i++){
        $fac[$i] = $fac[$i-1] + $auxContVet[$i];
    }

    $total = 0;
    $facP = [];
    
    for($i = 0; $i<sizeof($auxContVet); $i++){
        $total += $auxContVet[$i];
    }

    $facP[0] = ($auxContVet[0]*100)/$total;

    for($i = 1; $i<sizeof($auxContVet); $i++){
        $facP[$i] = $facP[$i-1]+(($auxContVet[$i]*100)/$total);
    }

    // echo $fac[1];
    // echo $fr[0];
    // echo $nomeRep[0]."<br>";
    // echo $auxContVet[0];
    
    // echo $nomeRep[0];

    //crie uma variável para receber o código da tabela
    $tabela = '<table border="1">';//abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    $tabela .= '<th>'.$nomeVar.'</th>'; // colunas do cabeçalho
    $tabela .= '<th>'.$nomeFreq.'</th>';
    $tabela .= '<th>fr%</th>';
    $tabela .= '<th>Fac</th>';
    $tabela .= '<th>Fac%</th>';
    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela

    for($i = 0; $i < sizeof($nomeRep);$i++){
        $tabela .= '<tr>'; // abre uma linha
        $tabela .= '<td>'.$nomeRep[$i].'</td>'; // coluna nomeVar
        $tabela .= '<td>'.$auxContVet[$i].'</td>'; //coluna Freq
        $tabela .= '<td>'.number_format($fr[$i], 2, '.', '').'%</td>'; // coluna fr%
        $tabela .= '<td>'.$fac[$i].'</td>'; //coluna Fac
        $tabela .= '<td>'.number_format($facP[$i], 2, '.', '').'%</td>';//coluna Fac%
        $tabela .= '</tr>'; // fecha linha
    }

    $tabela .='</tbody>'; //fecha corpo
    $tabela .= '</table>';//fecha tabela

    echo $tabela;
    echo '<div class="area-result-contas">';

    //=======================================  MMM  ====================================================================
    $media = 0;
    $aux = 0;

    for($i = 0; $i < sizeof($nomeRep); $i++){
        $aux += ($nomeRep[$i]*$auxContVet[$i]);
        $auxDiv = $fac[$i];
    }

    $media = $aux/$auxDiv;

    echo '<div class="results">
            <h3>Média</h3>
            <span>'.$media.'</span>
        </div>';
    // echo "A média é: ".$media."<br>";
    
    $moda = "";
    $auxMaior = $auxContVet[0];
    for($i = 0; $i < sizeof($auxContVet); $i++){
        if($auxMaior <= $auxContVet[$i]){
            $auxMaior = $auxContVet[$i];
            $moda = $nomeRep[$i];
        }
    }
    echo '<div class="results">
            <h3>Moda</h3>
            <span>'.$moda.'</span>
        </div>';
    // echo "A moda é: ".$moda."<br>";
    
    $mediana0 = "";
    $mediana1 = "";
    $auxMediana = floor(sizeof($dado)/2);
    if(sizeof($dado)%2 == 0){
        $auxMed1 = $auxMediana+1;
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMediana){
                $mediana0 = $nomeRep[$i];
                break;
            }
            
        }
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMed1){
                $mediana1 = $nomeRep[$i];
                break;
            }
        }
        // echo $auxMediana. "<br>";
        echo '<div class="results">
                <h3>Mediana</h3>
                <span>'.(($mediana0 + $mediana1)/2).'</span>
            </div>';
        // echo "A mediana é: ".(($mediana0 + $mediana1)/2)."<br>";

    }else{
        for($i = 0; $i < sizeof($nomeRep); $i++){
            if($fac[$i] >= $auxMediana){
                $mediana0 = $nomeRep[$i];
                break;
            }
        }

        echo '<div class="results">
                <h3>Mediana</h3>
                <span>'.$mediana0.'</span>
            </div>';
        // echo "A mediana é: ". $mediana0;
    }

    //======================================= Medidas separatrizes =======================================
    $md = (($fac[sizeof($fac)-1]) / (100/$valMedSep));
    for($i = 0; $i < sizeof($dado); $i++){
        if($fac[$i] >= $md){
            if($medSep == "quartil"){
                $medSep = "Q";
            }else if($medSep == "quintil"){
                $medSep = "K";
            }else if($medSep == "decil"){
                $medSep = "D";
            }else if($medSep == "porcentil"){
                $medSep = "P";
            }
            echo '<div class="results">
                    <h3>'.$medSep.'<small style="font-size: 10px;">'.$valMedSep.'</small></h3>
                    <span>'.$nomeRep[$i].'</span>
                </div>';
            // echo $nomeRep[$i];
            break;
        }
    }
    //====================================DP E CV======================================================
    if($processo == "amostra"){
        $somatorioX = 0;
        $somatorioF = 0;
        for($i = 0; $i < sizeof($nomeRep); $i++){
            $somatorioX += (pow(($nomeRep[$i] - $media),2)*$auxContVet[$i]);
            $somatorioF += $auxContVet[$i];
        }
        $dp = sqrt($somatorioX/($somatorioF-1));
        echo '<div class="results">
                    <h3>DP</h3>
                    <span>'.number_format($dp, 2, '.', '').'</span>
                </div>';
        $cv = ($dp/$media)*100;
        echo '<div class="results">
                <h3>CV</h3>
                <span>'.number_format($cv, 2, '.', '').'%</span>
            </div>';
        // echo ."<br>";
        // echo $somatorioF-1;
    }else if($processo == "populacao"){
        $somatorioX = 0;
        $somatorioF = 0;
        for($i = 0; $i < sizeof($nomeRep); $i++){
            $somatorioX += (pow(($nomeRep[$i] - $media),2)*$auxContVet[$i]);
            $somatorioF += $auxContVet[$i];
        }
        $dp = sqrt($somatorioX/($somatorioF));
        echo '<div class="results">
                    <h3>DP</h3>
                    <span>'.number_format($dp, 2, '.', '').'</span>
                </div>';
        $cv = ($dp/$media)*100;
        echo '<div class="results">
                <h3>CV</h3>
                <span>'.number_format($cv, 2, '.', '').'%</span>
            </div>';
        // echo ."<br>";
        // echo $somatorioF-1;
    }

    echo "
    <script>
        var dado = [];
        var background = [];
        var labels = [];
    ";
    for($i = 0; $i < sizeof($nomeRep); $i++){
        echo "
            dado[".$i."]=".$auxContVet[$i]."
            background[".$i."]='".random_color()."'
            labels[".$i."] = '".$nomeRep[$i]."'
        ";
    }
    echo "</script>";
    echo '</div>';

        // echo $nomeRep[$md];  
    
    // echo $md;
    //2000;2000;2000;2000;3000;3000;3000;3000;3000;3000;3000;3000;4000;4000;4000;4000;4000;4000;5000;5000;

}else if($tipoVar == 'continua'){
    $dado = preg_split("[;]", strval(strtolower($dados)));
    
    // for($i = 0; $i < sizeof($dado); $i++){
    //     if(empty($dado[$i])){
    //         unset($dado[$i]);
    //     }
    // }

    sort($dado);
    

    $xmax = $dado[0];
    $xmin = $dado[0];

    for($i = 0; $i < sizeof($dado); $i++){
        if($xmax < $dado[$i]){
            $xmax = $dado[$i];
        }
        if($xmin > $dado[$i]){
            $xmin = $dado[$i];
        }
    }
    // echo $xmax;
    $at = $xmax - $xmin;
    // echo $at;
    
    $k = floor(sqrt(sizeof($dado)));
    // echo $k;
    $kMe = $k - 1;
    $kMa = $k + 1;
    $aux = 0; 
    $ic = 0;
    $atIc = $at+1;
    $nLinhas = 0;

    while($aux == 0){
        if($atIc%$kMe == 0){
            $ic = $atIc/$kMe;
            $nLinhas = $kMe;
            $aux++;
        }else if($atIc%$k == 0){
            $ic = $atIc/$k;
            $nLinhas = $k;
            $aux++;
        }else if($atIc%$kMa == 0){
            $ic = $atIc/$kMa;
            $nLinhas = $kMa;
            $aux++;
        }
        // echo $at."<br>";
        $atIc++;
        // echo $at."<br>";
    }
    // echo $nLinhas;
    $nMin = [];
    $nMax = [];

    for($i = 0; $i < $nLinhas; $i++){
        if($i == 0){
            $nMin[$i] = $xmin;
            $nMax[$i] = $xmin + $ic;
        }else{
            $nMin[$i] = $nMax[$i - 1];
            $nMax[$i] = $nMin[$i] + $ic;
        }
    }

    $colunaP = [];
    for($i = 0; $i < $nLinhas; $i++){
        $colunaP[$i] = $nMin[$i]." |--- ".$nMax[$i];
        // echo $colunaP[$i]."<br>";
    }

    $colunaFi = [];
    for($i = 0; $i < $nLinhas; $i++){
        for($j = 0; $j < sizeof($dado); $j++){
            if($dado[$j] >= $nMin[$i] && $dado[$j] < $nMax[$i]){
                if(empty($colunaFi[$i])){
                    $colunaFi[$i] = 0;
                }
                $colunaFi[$i]++;
            }
        }
        if(empty($colunaFi[$i])){
            $colunaFi[$i] = 0;
        }
    }

    $colunaFr = [];
    $qtdFi = sizeof($dado);
    // echo $qtdFi;
    for($i = 0; $i < $nLinhas; $i++){
        $colunaFr[$i] = ($colunaFi[$i]*100)/$qtdFi;
    }

    $colunaFac = [];
    for($i = 0; $i < $nLinhas; $i++){
        if($i == 0){
            $colunaFac[$i] = $colunaFi[$i];
        }else{
            $colunaFac[$i] = $colunaFi[$i] + $colunaFac[$i - 1];
        }
        
    }

    $colunaFacP = [];
    for($i = 0; $i < $nLinhas; $i++){
        $colunaFacP[$i] = ($colunaFac[$i]*100)/$qtdFi;
    }

    //cria tabela
    $tabela = '<table border="1">';//abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    $tabela .= '<th>'.$nomeVar.'</th>'; // colunas do cabeçalho
    $tabela .= '<th>'.$nomeFreq.'</th>';
    $tabela .= '<th>fr%</th>';
    $tabela .= '<th>Fac</th>';
    $tabela .= '<th>Fac%</th>';
    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela

    for($i = 0; $i < $nLinhas; $i++){
        $tabela .= '<tr>'; // abre uma linha
        $tabela .= '<td>'.$colunaP[$i].'</td>'; // coluna nomeVar
        $tabela .= '<td>'.$colunaFi[$i].'</td>'; //coluna Freq
        $tabela .= '<td>'.number_format($colunaFr[$i], 2, '.', '').'%</td>'; // coluna fr%
        $tabela .= '<td>'.$colunaFac[$i].'</td>'; //coluna Fac
        $tabela .= '<td>'.number_format($colunaFacP[$i], 2, '.', '').'%</td>';//coluna Fac%
        $tabela .= '</tr>'; // fecha linha
    }

    $tabela .='</tbody>'; //fecha corpo
    $tabela .= '</table>';//fecha tabela
    // echo "maximo: ". $xmax."<br> minimo: ". $xmin;
    // 20;20;20;27;27;27;28;28;28;28;35;35;35;35;36;36;36;36;36;43;43;43;43;43;44;44;44;44;51;51;51;51;52;52;52;59;59;59;60;60;67;67; 
    echo $tabela;
    echo '<div class="area-result-contas">';   
    
    //=======================================  MMM  ====================================================================
    $media = 0;
    $aux = 0;

    for($i = 0; $i < sizeof($colunaP); $i++){
        $aux += ((($nMin[$i]+$nMax[$i])/2)*$colunaFi[$i]);
        $auxDiv = $colunaFac[$i];
    }

    $media = $aux/$auxDiv;
    $media2 = number_format($media, 2, '.', '');

    echo '<div class="results">
            <h3>Média</h3>
            <span>'.$media2.'</span>
        </div>';
    // echo "A média é: ".$media2."<br>";

    $moda = "";
    $auxMaior = $colunaFi[0];
    for($i = 0; $i < sizeof($colunaFi); $i++){
        if($auxMaior <= $colunaFi[$i]){
            $auxMaior = $colunaFi[$i];
            $moda = ($nMin[$i] + $nMax[$i])/2;
        }
    }

    echo '<div class="results">
            <h3>Moda</h3>
            <span>'.$moda.'</span>
        </div>';
    // echo "A moda é: ".$moda."<br>";
    $auxMed = $colunaFac[sizeof($colunaP) - 1];

    $mediana0 = $auxMed/2;
    // $mediana1 = $mediana0+1;
    $posicao = 0;

    for($i = 0; $i < sizeof($colunaP); $i++){
        if($colunaFac[$i] >= $mediana0){
            $posicao = $i;
            break;
        }
    }

    if($posicao == 0){
        $limiteDiv = $nMax[$posicao];
        $facAnt = $colunaFac[$posicao]; 
    }else{
        $limiteDiv = $nMax[$posicao - 1];
        $facAnt = $colunaFac[$posicao - 1];
    }
    
    $fiMd = $colunaFi[$posicao];
    $md = ($limiteDiv+(($mediana0-$facAnt)/$fiMd)*$ic);
    
    echo '<div class="results">
            <h3>Mediana</h3>
            <span>'.$md.'</span>
        </div>';
    // echo $md."<br>";
    // echo $facAnt;
    // echo $limiteDiv;
    // echo $posicao;
    // echo $mediana1;
    // echo $at;
    //=================================================== Medidas separatrizes ===========================================================

    // echo $valMedSep;

    $mediana0 = ($colunaFac[sizeof($colunaFac) - 1] / 100) * $valMedSep;
    // $mediana1 = $mediana0+1;
    $posicao = 0;

    for($i = 0; $i < sizeof($colunaP); $i++){
        if($colunaFac[$i] >= $mediana0){
            $posicao = $i;
            break;
        }
    }

    if($posicao == 0){
        $limiteDiv = $nMax[$posicao];
        $facAnt = $colunaFac[$posicao]; 
    }else{
        $limiteDiv = $nMax[$posicao - 1];
        $facAnt = $colunaFac[$posicao - 1];
    }
    
    
    $fiMd = $colunaFi[$posicao];
    $md = ($limiteDiv+(($mediana0-$facAnt)/$fiMd)*$ic);

    if($medSep == "quartil"){
        $medSep = "Q";
    }else if($medSep == "quintil"){
        $medSep = "K";
    }else if($medSep == "decil"){
        $medSep = "D";
    }else if($medSep == "porcentil"){
        $medSep = "P";
    }
    echo '<div class="results">
            <h3>'.$medSep.'<small style="font-size: 10px;">'.$valMedSep.'</small></h3>
            <span>'.$md.'</span>
        </div>';

    // echo $md."<br>";
    //====================================DP E CV======================================================
    if($processo == "amostra"){
        $somatorioX = 0;
        $somatorioF = 0;
        $pm = [];
        for($i = 0; $i < sizeof($colunaP); $i++){
            $pm[$i] = (($nMin[$i]+$nMax[$i])/2);
        }
        for($i = 0; $i < sizeof($colunaP); $i++){
            $somatorioX += (pow(($pm[$i] - $media2),2)*$colunaFi[$i]);
            $somatorioF += $colunaFi[$i];
        }
        $dp = sqrt($somatorioX/($somatorioF-1));
        echo '<div class="results">
                    <h3>DP</h3>
                    <span>'.number_format($dp, 2, '.', '').'</span>
                </div>';
        $cv = ($dp/$media)*100;
        echo '<div class="results">
                <h3>CV</h3>
                <span>'.number_format($cv, 2, '.', '').'%</span>
            </div>';
        // echo ."<br>";
        // echo $somatorioF-1;
    }else if($processo == "populacao"){
        $somatorioX = 0;
        $somatorioF = 0;
        $pm = [];
        for($i = 0; $i < sizeof($colunaP); $i++){
            $pm[$i] = (($nMin[$i]+$nMax[$i])/2);
        }
        for($i = 0; $i < sizeof($colunaP); $i++){
            $somatorioX += (pow(($pm[$i] - $media2),2)*$colunaFi[$i]);
            $somatorioF += $colunaFi[$i];
        }
        $dp = sqrt($somatorioX/($somatorioF));
        echo '<div class="results">
                    <h3>DP</h3>
                    <span>'.number_format($dp, 2, '.', '').'</span>
                </div>';
        $cv = ($dp/$media)*100;
        echo '<div class="results">
                <h3>CV</h3>
                <span>'.number_format($cv, 2, '.', '').'%</span>
            </div>';
    }
    echo "
    <script>
        var dado = [];
        var background = [];
        var labels = [];
    ";
    for($i = 0; $i < sizeof($colunaP); $i++){
        echo "
            dado[".$i."]=".$colunaFi[$i]."
            background[".$i."]='".random_color()."'
            labels[".$i."] = '".$colunaP[$i]."'
        ";
    }
    echo "</script>";
    echo '</div>';

}
?>