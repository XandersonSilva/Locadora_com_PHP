<?php 
    $usuarioValid = false;

    $nome = $_GET['nome'];
    $nome = ucwords($nome);
    $email = $_GET['email'];
    $endereco = $_GET['endereco'];
    $cpf = $_GET['CPF'];
    $nascimento = $_GET['nascimento'];
    $senha = $_GET['senha'];

    $definido = 0;

    $ArquivoUsers = fopen("../Arquivos_json/usuarios.json" , "r");

    if (filesize("../Arquivos_json/usuarios.json") > 0){
        $jsonPessoas = fread($ArquivoUsers, filesize("../Arquivos_json/usuarios.json"));
        $pessoas = json_decode($jsonPessoas, true);
        $definido = 1;
    }
    if ($definido === 0){
        $$nome = array( array( 'nome' => $nome, 'Email' => $email, 'Endereco' => $endereco, 'CPF' => $cpf, 'Nascimento' => $nascimento, 'Senha' => $senha));
    }else{
        $$nome = array( 'nome' => $nome, 'Email' => $email, 'Endereco' => $endereco, 'CPF' => $cpf, 'Nascimento' => $nascimento, 'Senha' => $senha);
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
