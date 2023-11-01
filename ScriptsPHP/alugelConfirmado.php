<?php
$placa = $_POST['placa'];
echo $placa;
//exit;
$arquivoAbrir = fopen('../Arquivos_json/Veiculos_Registrados.json', 'r');
$arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/Veiculos_Registrados.json"));
$CarrosBrasileiros = json_decode($arquivo, true);
$indice;
    foreach($CarrosBrasileiros as $ind => $carro){
        if ($placa == $carro['placa']){

            $veiculo = $carro; 
            $carro['status'] = 'indisponivel';
            $indice = $ind;
        }
    }
    if (isset($indice)){
        $CarrosBrasileiros[$indice] = $carro;
        $ArqSobresvr = fopen("../Arquivos_json/Veiculos_Registrados.json", "w");


        $jsonVeiculosReg = json_encode($CarrosBrasileiros);
        fwrite($ArqSobresvr, $jsonVeiculosReg);
        header("Location: ../PaginasPHP/index.php?Msg=Alug");
        fclose($ArqSobresvr);    
    }
    else{
        header("Location: ../PaginasPHP/index.php?erro=''");
    }

    fclose($arquivoAbrir);


?>
