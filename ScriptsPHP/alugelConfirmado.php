<?php
function VeiculoIndisponivel(){
    $placa = $_COOKIE['placa'];
    $usuario = $_COOKIE['userA_Email'] ?? 'unknow';

    $arquivoAbrir = fopen('../Arquivos_json/carros_alugados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/carros_alugados.json"));
    $CarrosAlugados = json_decode($arquivo, true);
    
    
    $arquivoAbrir = fopen('../Arquivos_json/Veiculos_Registrados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/Veiculos_Registrados.json"));
    $CarrosBrasileiros = json_decode($arquivo, true);
    $indice = false;
    fclose($arquivoAbrir);
    foreach($CarrosBrasileiros as $ind => $carro){
        if ($placa == $carro['placa'] && !($carro['status'] == 'indisponivel') ){
            
            $carro['status'] = 'indisponivel';
            $indice = $ind;
        }
    }
    if ($indice !== false){
        $CarrosBrasileiros[$indice] = $carro;
        $ArqSobresvr = fopen("../Arquivos_json/Veiculos_Registrados.json", "w");
        
        
        $jsonVeiculosReg = json_encode($CarrosBrasileiros);
            fwrite($ArqSobresvr, $jsonVeiculosReg);
            fclose($ArqSobresvr);    
        }
        else{
            echo $ind;
            exit;
        }
        header("Location: ../PaginasPHP/index.php?erro='INdisp'");

        foreach($CarrosAlugados as $carro){
            if ($placa == $carro['placa']){
                $novo_item = ['placa'=> $carro['placa'], 'usuario'=> $usuario];
            }
        }
        array_push($CarrosAlugados, $novo_item);
}
?>
