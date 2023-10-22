<?php 
    session_start();
    $usuarioValid = false;
    $codCorreto = 0;

    $nome       = $_SESSION['nome']      ;
    $email      = $_SESSION['email']     ;
    $endereco   = $_SESSION['endereco']  ;
    $cpf        = $_SESSION['CPF']       ;
    $nascimento = $_SESSION['nascimento'];
    $senha      = $_SESSION['senha']     ;


    //Verifica se o código inserido pelo usr é o mesmo enviado por email

    //Abre o arquivo com os cadastros pendentes
    $ArquivoUsersTemp = fopen("../Arquivos_json/CadastrosNaoFinalizados.json" , "r");

    //Caso o arquivo esteja em branco redireciona o usr pra tela de cadastro
    if (filesize("../Arquivos_json/CadastrosNaoFinalizados.json") > 0){
        $jsonPessoas = fread($ArquivoUsersTemp, filesize("../Arquivos_json/CadastrosNaoFinalizados.json"));
        $pessoas = json_decode($jsonPessoas, true);
    }else{
        header("Location: ../Cadastro_Login/cadastro.php?erroW=write");
        exit;
    }

    fclose($ArquivoUsersTemp);

    foreach ($pessoas as $pessoa) {
        //Verifica se os códigos são iguais
        print_r($pessoa);
        if ($pessoa['cod'] ==  $_POST['cod']) {
            $codCorreto += 1;
        }  
    }
    if ($codCorreto == 0){
        //Se não forem iguais envia o usr para a tela de inserir o código 
        header("Location: ../Cadastro_Login/ValidarEmail.php?erro=incorreto");
        exit;
    }else{
        //Se forem iguais vai retira-lo da lista usuários pendentes e cadastra-lo
        $listaAtu = array();
        foreach ($pessoas as $pessoa) {
            if (!($pessoa['email'] ==  $email)) {
                array_push($listaAtu, $pessoa);
            }  
        }
        $ArquivoUsersTemp = fopen("../Arquivos_json/CadastrosNaoFinalizados.json" , "w");
        fwrite($ArquivoUsersTemp, json_encode($listaAtu));
        fclose($ArquivoUsersTemp);
    }

    $definido = 0;
    $pessoas = '';

    $ArquivoUsers = fopen("../Arquivos_json/usuarios.json" , "r");

    if (filesize("../Arquivos_json/usuarios.json") > 0){
        $jsonPessoas = fread($ArquivoUsers, filesize("../Arquivos_json/usuarios.json"));
        $pessoas = json_decode($jsonPessoas, true);
        $definido = 1;
    }
    if ($definido === 0){
        $$nome = array( array( 'nome' => $nome, 'Email' => $email, 'Endereco' => $endereco, 'CPF' => $cpf, 'Nascimento' => $nascimento, 'Senha' => $senha, 'tema' => 'W'));
    }else{
        $$nome = array( 'nome' => $nome, 'Email' => $email, 'Endereco' => $endereco, 'CPF' => $cpf, 'Nascimento' => $nascimento, 'Senha' => $senha, 'tema' => 'W');
    }
    $vazio0 = "";
    $vazio1 = array();

    if  (!($pessoas == $vazio0 or $pessoas == $vazio1 or $definido == 0)){ 
        foreach ($pessoas as $pessoa) {
            if ($pessoa['Email'] ==  $$nome['Email']) {
                header("Location: ../Cadastro_Login/cadastro.php?erro=userExistent");
                $usuarioValid = false;
                exit;
            }else{
                $usuarioValid = true;
            }  
        }
    }

    fclose($ArquivoUsers);
    
    $ArqSobresvr = fopen("../Arquivos_json/usuarios.json", "w");

    if($usuarioValid == true){
        array_push($pessoas, $$nome);
        $jsonPessoas = json_encode($pessoas);
        fwrite($ArqSobresvr, $jsonPessoas);

        header("Location: ../Cadastro_Login/login.php");

    }
    if ( $pessoas == ""){
        $jsonPessoas = json_encode($$nome);
        fwrite($ArqSobresvr, $jsonPessoas);

        header("Location: ../Cadastro_Login/login.php");
    }

    fclose($ArqSobresvr);

?>
