<?php
function VeiculoIndisponivel($placa){
    $gravarAluguel = true;
    $usuario = $_COOKIE['userA_Email'] ?? 'unknow';


    $arquivoAlugPont = fopen('../Arquivos_json/carros_alugados.json', 'r');
    $tamanhoAlugados = filesize("../Arquivos_json/carros_alugados.json");
        
    if($tamanhoAlugados > 0){
        $arquivo = fread($arquivoAlugPont, $tamanhoAlugados);
        $CarrosAlugados = json_decode($arquivo, true);
    }
    fclose($arquivoAlugPont);

        
    $arquivoAbrir = fopen('../Arquivos_json/Veiculos_Registrados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/Veiculos_Registrados.json"));
    $CarrosBrasileiros = json_decode($arquivo, true);
    $indice = false;
    fclose($arquivoAbrir);
   
    
    foreach($CarrosBrasileiros as $ind => $carro){
        if ($placa == $carro['placa'] && !($carro['status'] == 'indisponivel') ){
            
            $carro['status'] = 'indisponivel';
            $indice = $ind;


            foreach($CarrosAlugados as $log){
                if(($placa == $log['placa'] && $log['usuario'] == $usuario)){
                    $gravarAluguel = false;
                }
            }
            if ($gravarAluguel){    
                $novo_item = ['placa'=> $carro['placa'], 'usuario'=> $usuario, 'proprietario'=> $carro['email'], 'avalialiacao'=>''];

                $arquivoAlugPont = fopen('../Arquivos_json/carros_alugados.json', 'w');
        
                if ( $tamanhoAlugados > 0){
                    array_push($CarrosAlugados, $novo_item);
                    fwrite($arquivoAlugPont, json_encode($CarrosAlugados));
                }else{
                    fwrite($arquivoAlugPont, json_encode(array($novo_item)));
                    
                }

                fclose($arquivoAlugPont);
            } 
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
            header("Location: ../PaginasPHP/index.php?erro='INdisp'");
            exit;
        }

        
}
?>
