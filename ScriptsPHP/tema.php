<?php 
if ($_COOKIE['tema'] == 'D'){
    setcookie('tema', 'W', 0, '/');
    header("Location: $_GET[back]");
}
if ($_COOKIE['tema'] == 'W'){
    setcookie('tema', 'D', 0, '/');
    header("Location: $_GET[back]");
}
?>