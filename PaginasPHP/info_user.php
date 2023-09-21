<!DOCTYPE html>
<?php 
    //VERIFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO NÃO ESTEJA, REDIRECIONA PARA LOGIN
    session_start();
    if ((!isset($_SESSION['logado']) == true)){
        unset($_SESSION['logado']);
        session_destroy();
        header('Location: ../Cadastro_Login/login.php');
    }
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar</title>
    <link rel="stylesheet" href="../style/style.css">
    <script  src="../JavaScript/exibirBtnSair.js">  </script>
    <script  src="../JavaScript/jquery.js">         </script>
    <link rel="stylesheet" href="../style/User_Page.css">
    
</head>
<header>
    <nav>
        <div id="Menu">
            <img src="../Imagens/Icones/menu.png" alt="" srcset="">
        </div>
        <h1>Perfil</h1>
        <div id="login" onclick="alternar()">
        <?php
            if(isset($_COOKIE['userA_Nome'])){
                $nomeUser = $_COOKIE['userA_Nome'];
                $inicial = strtoupper(substr($nomeUser,0,1));
                echo <<< LOGADO
                        $inicial
                        LOGADO;
                    }else{    
                        echo <<< LOGIN
                        <p>Login</p>
                        <img id="login" src="../Imagens/Icones/conecte-se.png" alt="Log in">
                        </nav>
                LOGIN;
                
            }
            ?>
    </nav>
    </div>
    <article id="SrBorda">
        <div id=sair>
            <form action="../ScriptsPHP/sair.php" method="post">
                <input type="submit" value="SAIR" id="sair">
            </form>
        </div>
        <div id="info_user">
            <form action="../PaginasPHP/index.php">
                <input type="submit" value="Principal" id="info_user">
            </form>
        </div>
    </article>
</header>


<body>
    <main>
        <div id="ImgUsr">
            <img src="../Imagens/Icones/user.png" alt="">
        </div>
        <?php
            echo'<p id="NameUsr"> ' . $name = $_COOKIE['userA_Nome'] . '</p>';
            echo'<p id="EmailUsr"> ' . $email = $_COOKIE['userA_Email'] . '</p>';
            //echo"<h1> CPF: " . $cpf = $_COOKIE['userA_CPF'];
        ?>
        <div id="classifc">
            <p>Classificação </p>
        
            <img id="Estrela" src="../Imagens/Icones/estrela0.png" alt="Estrela de classificação">
            <img id="Estrela" src="../Imagens/Icones/estrela0.png" alt="Estrela de classificação">
            <img id="Estrela" src="../Imagens/Icones/estrela0.png" alt="Estrela de classificação">
            <img id="Estrela" src="../Imagens/Icones/estrela0.png" alt="Estrela de classificação">
            <img id="Estrela" src="../Imagens/Icones/estrela0.png" alt="Estrela de classificação">
        </div>
        <hr>
        <p>Veículos</p>
        <div id="V_Imgs">
            <img id="seta" src="../Imagens/Icones/seta-esquerda.png" alt="">
            <div id="veiculoImg">
                <form action="AdicionarVeiculo.php" method="post">
                    <input type="submit" value="Adicionar Veículo">
                </form>
            </div>
            <img id="seta" src="../Imagens/Icones/seta-direita.png" alt="">
        </div>
        <form id="Dtlh" action="" method="post">
            <p for="Detalhes">
                Nome/Modelo
            </p>
            <input id="DetlhBtn" type="submit" value="Detalhes">
        </form>
    </main>
</body>
</html>