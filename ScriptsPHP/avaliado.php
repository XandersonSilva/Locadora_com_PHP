<?php
    $placa = $_POST['placa'];
    $usuario = $_COOKIE['userA_Email'] ?? 'unknow';
    $avaliacao = $_POST['estrelasSlc'];
    
    $arquivoAbrir = fopen('../Arquivos_json/carros_alugados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/carros_alugados.json"));
    
    $CarrosAlugados = json_decode($arquivo, true);
    
    
    $arquivoAbrir = fopen('../Arquivos_json/Veiculos_Registrados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/Veiculos_Registrados.json"));
    $CarrosBrasileiros = json_decode($arquivo, true);
    $indice = false;
    fclose($arquivoAbrir);
    
    
    
    foreach($CarrosAlugados as $ind => $carro){
        
        if ($placa == $carro['placa'] && $carro['usuario'] == $usuario){
            $indice = $ind;
        } 
    }
    if($indice!== false){
        $CarrosAlugados[$indice] =  ['placa'=> $carro['placa'], 'usuario' => $carro['usuario'], 'avaliacao' => $avaliacao, 'propietario' => $carro['propietario'] ] ;
        
    }
        /* print_r(json_encode($CarrosAlugados));
        echo($indice );
         */
        $arquivo = fopen('../Arquivos_json/carros_alugados.json', 'w');
       $CarrosA = json_encode($CarrosAlugados);
       
         print_r($CarrosA);
        fwrite($arquivo, $CarrosA);

?>
