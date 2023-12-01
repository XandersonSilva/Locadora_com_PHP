<?php 

$placa = $_POST['placa'] ?? '';

$definido = 0;

$arquivo = fopen("../Arquivos_json/Veiculos_Registrados.json", 'r');

if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
    $jsonVeiculosReg = fread($arquivo, filesize("../Arquivos_json/Veiculos_Registrados.json"));
    $Veiculos = json_decode($jsonVeiculosReg, true);
    $definido = 1;
}

fclose($arquivo);


$vazio0 = "";
$vazio1 = array();

if  (!($Veiculos == $vazio0 or $Veiculos == $vazio1 or $definido == 0)){ 
    foreach ($Veiculos as $indice => $veiculo) {
        if ($veiculo['placa'] ==  $placa) {
            $prosseguir = true;
        }else{
            header("Location: ../PaginasPHP/AdicionarVeiculo.php?erro=vieculoNaoRegistrado");
            $prosseguir = false;
            exit;
        }  
    }
}
echo $prosseguir;
?>