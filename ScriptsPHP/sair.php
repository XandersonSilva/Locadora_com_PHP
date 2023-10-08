<?php 
    //Limpa a sessão do usuário e faz logout
    session_start();
    unset($_SESSION['logado']);
    session_destroy();
    header('Location: ../Cadastro_Login/login.php');
?>