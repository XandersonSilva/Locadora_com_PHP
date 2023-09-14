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
    if($pessoa['Senha'] == $senha and $pessoa['Email'] == $email) {
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
    header("Location: ../Paginas_PHP/index.php");
    setcookie("userA_Nome"    , $usserName     ,0, '/');
    setcookie("userA_Email"   , $usserEmail    ,0, '/');    
    setcookie("userA_Endereco", $usserEndereco ,0, '/');
    setcookie("userA_CPF"     , $usserCPF ,0, '/');
}


fclose($ArquivoUsers);

?>

