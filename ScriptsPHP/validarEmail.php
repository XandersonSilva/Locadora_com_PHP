<?php
//Gerando um numero de verificação

//número aleatório entre 0 e 999999.
$numero_aleatorio = mt_rand(0, 999999);

// Obtem o timestamp da hora atual.
$hora_atual = time();

// Multiplica o número aleatório pelo timestamp da hora atual.
$resultado = $numero_aleatorio * $hora_atual;

// Converte o resultado para uma string com exatamente 6 dígitos, preenchendo com zeros à esquerda, se necessário.
$cod = (string)$resultado;

// Se o resultado tiver menos de 6 dígitos, preencha com zeros à esquerda.
if (strlen($cod) < 6) {
    $cod = str_pad($cod, 6, '0', STR_PAD_LEFT);
} else if (strlen($cod) > 6) {
    // Se o resultado tiver mais de 6 dígitos, pegue os 6 primeiros dígitos.
    $cod = substr($cod, 0, 6);
}


// GAMBIARRA PRA GUARDAR OS DADOS DO USUARIO
date_default_timezone_set('America/Sao_Paulo');

session_start();
$_SESSION['nome'] = ucwords($_POST['nome']);
$_SESSION['email'] = $_POST['email'];
$_SESSION['endereco'] = $_POST['endereco'];
$_SESSION['CPF'] = password_hash($_POST['CPF'], PASSWORD_DEFAULT);
$_SESSION['nascimento'] = $_POST['nascimento'];
//CRIPTOGRAFA A SENHA DO USUÁRIO
$_SESSION['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$_SESSION['horario'] = date('d-m-Y H:i:s');

$nome = $_SESSION['nome'];

$definido = 0;
$pessoas = '';

$ArquivoUsers = fopen("../Arquivos_json/usuarios.json" , "r");

if (filesize("../Arquivos_json/usuarios.json") > 0){
    $jsonPessoas = fread($ArquivoUsers, filesize("../Arquivos_json/usuarios.json"));
    $pessoas = json_decode($jsonPessoas, true);
    $definido = 1;
}
if ($definido === 0){
    $$nome = array( array( 'cod' => $cod, 'email' => $_SESSION['email'], 'horario'=> $_SESSION['nome']));
}else{
    $$nome = array( 'cod' => $cod, 'email' => $_SESSION['email'], 'horario'=> $_SESSION['nome']);
}
$vazio0 = "";
$vazio1 = array();

if  (!($pessoas == $vazio0 or $pessoas == $vazio1 or $definido == 0)){ 
    foreach ($pessoas as $pessoa) {
        if ($pessoa['email'] ==  $$nome['email']) {
            header("Location: ../Cadastro_Login/cadastro.php?erro=userExistent");
            $usuarioValid = false;
            exit;
        }else{
            $usuarioValid = true;
        }  
    }
}

fclose($ArquivoUsers);
$ArquivoUsers = fopen("../Arquivos_json/CadastrosNaoFinalizados.json" , "r");

if (filesize("../Arquivos_json/CadastrosNaoFinalizados.json") > 0){
    $jsonPessoas = fread($ArquivoUsers, filesize("../Arquivos_json/CadastrosNaoFinalizados.json"));
    $pessoas = json_decode($jsonPessoas, true);
}
    fclose($ArquivoUsers);
$ArqSobresvr = fopen("../Arquivos_json/CadastrosNaoFinalizados.json", "w");

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


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




$UsrEmail = $_POST['email'] ?? 0;

$codigo = 000000;

//Mensagem a ser enviada :

$msg = '<table align="center" cellpadding="0" cellspacing="0" width="600"style="border-collapse: collapse; margin: 0 auto; font-family: Arial, sans-serif;"><tr>    <td bgcolor="#f7f7f7" align="center" style="padding: 40px 0;">        <h1>Verificação de E-mail</h1>    </td></tr><tr>    <td bgcolor="#ffffff" style="padding: 40px 30px;">        <p>Obrigado por se juntar à nossa plataforma. Para ativar a sua conta, utilize o código abaixo:</p>        <p style="display: inline-block; padding: 10px 20px; background-color: #0070c9; color: #ffffff; text-decoration: none; border-radius: 5px;">'.$cod.'</p>    </td></tr><tr>    <td bgcolor="#f7f7f7" style="padding: 20px 30px;">        <p>Se você não solicitou esta verificação, ignore este e-mail.</p>    </td></tr></table>';

$TxtMsg = "Verificação de E-mail .\n Obrigado por se juntar à nossa plataforma. Para ativar a sua conta, utilize o código abaixo: $cod .\n Se você não solicitou esta verificação, ignore este e-mail.";


//Carregar o Composer's autoloader
require '../lib/vendor/autoload.php';
//Criar uma instancia; pasando `true` enables exceptions
if ($UsrEmail){
    $mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Ativa o debug output
    $mail->isSMTP();                                              //Enviar com SMTP
    $mail->CharSet = 'UTF-8';
    $mail->Host       = 'smtp.gmail.com';                         //Especivicar o SMTP server para envio
    $mail->SMTPAuth   = true;                                     //Ativar SMTP authentication
    $mail->Username   = 'jxveiculos@gmail.com';                   //SMTP username
    $mail->Password   = '';                                       //SMTP password - Não forneciada publicamente por motivos de segurança
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;              //Enable implicit TLS encryption
    $mail->Port       = 465;                                      //Porta TCP para conexão;

    // Endereço envio e destinatario
    $mail->setFrom('JXveiculos@jxveiculos.com', 'JX Veiculos');
    //$mail->addAddress("$email", 'Usuário');     //Destinatario
    $mail->addAddress("$UsrEmail");               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    


    //Content
    $mail->isHTML(true);                                  //Acieita HTML
    $mail->Subject = 'Confirmação de email';
    $mail->Body    = $msg;
    $mail->AltBody = $TxtMsg;

    if($mail->send()){
        header('Location: ../Cadastro_Login/ValidarEmail.php');
    };
    echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
    header('Location: ../Cadastro_Login/cadastro.php?erroS=internalerror');
    }
}

