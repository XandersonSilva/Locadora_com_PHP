<?php
$email = trim($_POST['Email']);
$senha = trim($_POST['Senha']);


$definido = 0;
$ArquivoUsers = fopen("../Arquivos_json/usuarios.json" , "r");

if (filesize("../Arquivos_json/usuarios.json") > 0){
    $jsonPessoas = fread($ArquivoUsers, filesize("../Arquivos_json/usuarios.json"));
    $definido = 1;
}

$usuarioValid = 0;

// Decodificar o JSON para um array
$pessoas = json_decode($jsonPessoas, true);

$vazio0 = '';
$vazio1 = array();


if ($pessoas == $vazio0 or $pessoas == $vazio1 or $definido == 0){
    header("Location: ../Cadastro_Login/login.php?erro=Nregistrado");
    exit;
}

// Percorrer os objetos do array e fazer verificações
foreach ($pessoas as $pessoa) {
    if(password_verify($senha, $pessoa['Senha']) and $pessoa['Email'] == $email) {
        $usuarioValid ++;
        $usserAtu = $pessoa['nome'];
        $usserName     = $pessoa['nome']    ;
        $usserEmail    = $pessoa['Email']   ;
        $usserEndereco = $pessoa['Endereco'];
        $usserCPF      = $pessoa['CPF']     ;
    }
}

$usserAtu = urlencode($usserAtu);


if ($usuarioValid == 0){
    header("Location: ../Cadastro_Login/login.php?erro=Nregistrado");
}else{
    //Define os cookies de sessão necessários, e confirma que o usuário está logado através de sessão
    session_start();
    $_SESSION['logado'] = true;
    header("Location: ../PaginasPHP/index.php");
    setcookie("userA_Nome"    , $usserName     ,0, '/');
    setcookie("userA_Email"   , $usserEmail    ,0, '/');    
    setcookie("userA_Endereco", $usserEndereco ,0, '/');
    setcookie("userA_CPF"     , $usserCPF      ,0, '/');
    setcookie("SSID"          , session_id()   ,0, '/');
}


fclose($ArquivoUsers);

?>

