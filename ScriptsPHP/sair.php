<?php 
    //Limpa a sessão do usuário e faz logout
    session_start();
    unset($_SESSION['logado']);
    session_destroy();
    header('Location: ../Cadastro_Login/login.php');
    unset($_COOKIE['userA_Nome']);
    setcookie('userA_Nome', null, -1, '/');
    unset($_COOKIE['userA_CPF']);
    setcookie('userA_CPF', null, -1, '/');
    unset($_COOKIE['userA_Endereco']);
    setcookie('userA_Endereco', null, -1, '/');
    unset($_COOKIE['userA_Email']);
    setcookie('userA_Email', null, -1, '/');
    unset($_COOKIE['teste']);
    setcookie('teste', null, -1, '/');
    unset($_COOKIE['PHPSESSID']);
    setcookie('PHPSESSID', null, -1, '/');
?>