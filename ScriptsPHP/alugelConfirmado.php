<?php
function VeiculoIndisponivel(){
    $placa = $_COOKIE['placa'];

    $arquivoAbrir = fopen('../Arquivos_json/Veiculos_Registrados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/Veiculos_Registrados.json"));
    $CarrosBrasileiros = json_decode($arquivo, true);
    $indice = false;
    foreach($CarrosBrasileiros as $ind => $carro){
        if ($placa == $carro['placa'] && !($carro['status'] == 'indisponivel') ){

            $carro['status'] = 'indisponivel';
                $indice = $ind;
            }
        }
        if ($indice){
            $CarrosBrasileiros[$indice] = $carro;
            $ArqSobresvr = fopen("../Arquivos_json/Veiculos_Registrados.json", "w");


            $jsonVeiculosReg = json_encode($CarrosBrasileiros);
            fwrite($ArqSobresvr, $jsonVeiculosReg);
            fclose($ArqSobresvr);    
        }
        else{
            header("Location: ../PaginasPHP/index.php?erro='INdisp'");
        }

        fclose($arquivoAbrir);

}
?>
