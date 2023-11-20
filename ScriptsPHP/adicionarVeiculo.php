<?php 

    $estados = ["AC"=>"Acre", "AL"=>"Alagoas", "AP"=>"Amapá", "AM"=>"Amazonas", "BA"=>"Bahia", "CE"=>"Ceará", "DF"=>"Distrito Federal", "ES"=>"Espírito Santo", "GO"=>"Goiás", "MA"=>"Maranhão", "MT"=>"Mato Grosso", "MS"=>"Mato Grosso do Sul", "MG"=>"Minas Gerais", "PA"=>"Pará", "PB"=>"Paraíba", "PR"=>"Paraná", "PE"=>"Pernambuco", "PI"=>"Piauí", "RJ"=>"Rio de Janeiro", "RN"=>"Rio Grande do Norte", "RS"=>"Rio Grande do Sul", "RO"=>"Rondônia", "RR"=>"Roraima", "SC"=>"Santa Catarina", "SP"=>"São Paulo", "SE"=>"Sergipe", "TO"=>"Tocantins", ''=>''];


    $prosseguir = false;
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $Qpassageiros = $_POST['passageiros'];
    $combustivel = $_POST['combustivel'];
    $placa =  strtoupper($_POST['placa']);
    $KmL = $_POST['KmL'];
    $diariaS =  $_POST['diaria'];
    $detalhes = $_POST['detalhes'];
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['uf']     ?? '';
    $localizacao_Atu = $cidade . ' - ' . $estados[$estado];
    
    $arquivoAbrir = fopen('../Arquivos_json/Carros_Brasileiros.json', 'r');
    $arquivo = fread($arquivoAbrir, filesize("../Arquivos_json/Carros_Brasileiros.json"));
    $CarrosBrasileiros = json_decode($arquivo, true);

    foreach($CarrosBrasileiros as $carro){
        if ($marca == $carro['Marca']){

            $preco_Dia = $carro['preco_Dia']; 
        }
    }
    fclose($arquivoAbrir);


    if (isset($_COOKIE['userA_CPF'])){
        $cpf = $_COOKIE['userA_CPF'];
    }else{
        $cpf = 'ERRO';
    }
    $definido = 0;
    
    $CaminhofotoA = "";
    $CaminhofotoB = "";
    $CaminhofotoC = "";


    if(isset($_FILES['fotoB']) && !empty($_FILES['fotoB']) && !$_FILES['fotoB']['error']){
        move_uploaded_file($_FILES['fotoB']["tmp_name"] , "../Armazenamento/CarroImagens/". $placa . 'fotoB'. $_FILES['fotoB']["name"]);
        
        $CaminhofotoB = "../Armazenamento/CarroImagens/". $placa . 'fotoB'. $_FILES['fotoB']["name"];

    }; 
    if(isset($_FILES['fotoA']) && !empty($_FILES['fotoA']) && !$_FILES['fotoA']['error']){
        move_uploaded_file($_FILES['fotoA']["tmp_name"] , "../Armazenamento/CarroImagens/". $placa . 'fotoA'. $_FILES['fotoA']["name"]);
        
        $CaminhofotoA = "../Armazenamento/CarroImagens/". $placa . 'fotoA'. $_FILES['fotoA']["name"];

    };
    if(isset($_FILES['fotoC']) && !empty($_FILES['fotoC']) && !$_FILES['fotoC']['error']){
        move_uploaded_file($_FILES['fotoC']["tmp_name"] , "../Armazenamento/CarroImagens/". $placa . 'fotoC'. $_FILES['fotoC']["name"]);
        
        $CaminhofotoC = "../Armazenamento/CarroImagens/". $placa . 'fotoC'. $_FILES['fotoC']["name"];

    }; 





    $RegVeic = fopen("../Arquivos_json/Veiculos_Registrados.json" , "r");

    if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
        $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/Veiculos_Registrados.json"));
        $Veiculos = json_decode($jsonVeiculosReg, true);
        $definido = 1;
    }
    
    if ($definido === 0){
        $Novo_veic = array(array('marca'=>$marca,'modelo'=>$modelo,'capacidade'=>$Qpassageiros,'placa'=>$placa,'combustivel'=>$combustivel,'KM_por_Litro'=>$KmL,'valor_diaria'=>"$diariaS",'data_saida'=>"",'data_retorno'=>"",'localizacao_Atu'=>$localizacao_Atu,'destino_Atu'=>"",'status'=>"disponivel",'CPF_cliente'=>"",'CPF_proprietario'=>$cpf,'detalhes'=>$detalhes, 'preco_Dia'=>$preco_Dia, 'imagens' => [$CaminhofotoA, $CaminhofotoB, $CaminhofotoC]));
    }else{
        $Novo_veic = array('marca'=>$marca,'modelo'=>$modelo,'capacidade'=>$Qpassageiros,'placa'=>$placa,'combustivel'=>$combustivel,'KM_por_Litro'=>$KmL,'valor_diaria'=>"$diariaS",'data_saida'=>"",'data_retorno'=>"",'localizacao_Atu'=>$localizacao_Atu,'destino_Atu'=>"",'status'=>"disponivel",'CPF_cliente'=>"",'CPF_proprietario'=>$cpf,'detalhes'=>$detalhes, 'preco_Dia'=>$preco_Dia, 'imagens' => [$CaminhofotoA, $CaminhofotoB, $CaminhofotoC]);
    };

    $vazio0 = "";
    $vazio1 = array();

    if  (!($Veiculos == $vazio0 or $Veiculos == $vazio1 or $definido == 0)){ 
        foreach ($Veiculos as $veiculo) {
            if ($veiculo['placa'] ==  $Novo_veic['placa']) {
                header("Location: ../PaginasPHP/AdicionarVeiculo.php?erro=vieculoJaRegistrado");
                $prosseguir = false;
                exit;
            }else{
                $prosseguir = true;
            }  
        }
    }

    fclose($RegVeic);
    
    $ArqSobresvr = fopen("../Arquivos_json/Veiculos_Registrados.json", "w");

    if($prosseguir == true){
        array_push($Veiculos, $Novo_veic);
        $jsonVeiculosReg = json_encode($Veiculos);
        fwrite($ArqSobresvr, $jsonVeiculosReg);

        header("Location: ../PaginasPHP/index.php");

    }
    if ( $Veiculos == ""){
        $jsonVeiculosReg = json_encode($Novo_veic);
        fwrite($ArqSobresvr, $jsonVeiculosReg);

        header("Location: ../PaginasPHP/index.php");
    }

    fclose($ArqSobresvr);
    //header('../PaginasPHP/index.php')

?>
