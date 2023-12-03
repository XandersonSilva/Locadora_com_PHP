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

$prosseguir = false;
if  (!($Veiculos == $vazio0 or $Veiculos == $vazio1 or $definido == 0)){ 
    foreach ($Veiculos as $ind => $veiculo) {
        if ($veiculo['placa'] ==  $placa) {
            $prosseguir = true;
            $indice = $ind;
        }
    }
}
if(!($prosseguir)){
    header("Location: ../PaginasPHP/historico.php?erro=vieculoNaoRegistrado");
    exit;
}

unset($Veiculos[$indice]);
$Veiculos = json_encode($Veiculos);

$arquivo = fopen("../Arquivos_json/Veiculos_Registrados.json", 'w');
fwrite($arquivo, $Veiculos);
fclose($arquivo);
header("Location: ../PaginasPHP/historico.php?aviso=sucesso");




?>