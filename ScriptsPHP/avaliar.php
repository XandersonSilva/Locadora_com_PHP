<?php
    $placa = $_POST['placa'];
    $usuario = $_COOKIE['userA_Email'] ?? 'unknow';
    $avaliacao = $_POST['estrelasSlc'];
    
    $arquivoAbrir = fopen('../Arquivos_json/carros_alugados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/carros_alugados.json"));
    $CarrosAlugados = json_decode($arquivo, true);
    fclose($arquivoAbrir);
  
    
    $arquivoAbrir = fopen('../Arquivos_json/Veiculos_Registrados.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/Veiculos_Registrados.json"));
    $CarrosBrasileiros = json_decode($arquivo, true);
    $indice = false;
    fclose($arquivoAbrir);
    
    
    $avaliar = false;    
    foreach($CarrosAlugados as $ind => $carro){
        if ($placa == $carro['placa'] && $carro['usuario'] == $usuario && empty($carro['avaliacao'])){
            $indice = $ind;
            $CarrosAlugados[$indice] =  ['placa'=> $carro['placa'], 'usuario' => $carro['usuario'], 'propietario' => $carro['propietario'], 'avaliacao' => $avaliacao] ;
            $avaliar = true;
        } 
       
    }
    if ($avaliar === true) {
        $arquivo = fopen('../Arquivos_json/carros_alugados.json', 'w');
        $CarrosA = json_encode($CarrosAlugados);
        fwrite($arquivo, $CarrosA);
        fclose($arquivo);
        header("Location: ../PaginasPHP/historico.php?result=sucess");
    }

?>
