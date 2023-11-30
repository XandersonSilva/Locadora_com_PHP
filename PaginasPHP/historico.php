<?php 
 session_start();
 if ((!isset($_SESSION['logado']) == true)){
     unset($_SESSION['logado']);
     session_destroy();
     header('Location: ../Cadastro_Login/login.php');
 }

 $RegVeic = fopen("../Arquivos_json/Veiculos_Registrados.json" , "r");
 $definido = 0;
 if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
     $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/Veiculos_Registrados.json"));
     $Veiculos = json_decode($jsonVeiculosReg, true);
     $definido = 1;
 }
 fclose($RegVeic);
?>

<!DOCTYPE html>
<html lang="pt-BR" id="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/Index.css">
    <script  src="../JavaScript/exibirBtnSair.js">  </script>
    <script  src="../JavaScript/jquery.js">         </script>
    <script src="../JavaScript/tema.js">            </script>
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/historico.css">
    
</head>
<header onload="index()">
    <nav>
        <div id="Menu">
            <img src="../Imagens/Icones/menu.png" alt="" srcset="" onclick="retMenu()">
        </div>
        <h1>Histórico</h1>
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
</header>

<div id="menuLateral">
    <div id="temaDiv">
            <img src="../Imagens/Icones/menu.png" id="retMenu" onclick="retMenu()">
            <form action="../ScriptsPHP/tema.php" method="get">
                <input type="submit" value="Tema" id="btntema">
                <input id='noneD' value="<?=$_SERVER['PHP_SELF']?>" id="btntema"  name='back'>
            </form>
        </div>
        <div id="menu_list">
            <form action="../PaginasPHP/index.php">
                <input type="submit" value="Página principal" class="css-input">
            </form>
        </div>
        <div id="menu_list">
            <form action="historico.php">
                <input type="submit" value="Histórico" class="css-input">
            </form>
        </div>
        <div id="menu_list">
            <form action="../PaginasPHP/AdicionarVeiculo.php">
                <input type="submit" value="Adicionar veículo" class="css-input">
            </form>
        </div>
        <div id="menu_list">
            <form action="../PaginasPHP/info_user.php">
                <input type="submit" value="Perfil" class="css-input">
            </form>
        </div>
        <div id="menu_list">
            <form action="../ScriptsPHP/sair.php" method="post">
                <input type="submit" value="SAIR" class="css-input">
            </form>
        </div>
</div>

<body>

<div class="header-container light-mode">
    <h2 class="toggle-header"  onclick="toggleItems(this)">Veículos Recentes <span class="arrow up"></span></h2>
</div>
<div>
<section id="conteudo">
    <?php
        if(isset($Veiculos)){
            foreach($Veiculos as $veiculo){
                if($veiculo["alugante"] == $_COOKIE['userA_Email']){
                    $semcarros = 1;
                    
                    $FimVeicF = " </form>";
                    $Botão    = '<input class="alugarBTN" type="submit" value="Avaliar">';
                        $IniVeicF = "<form action='AvaliarVeiculo.php?id=".$veiculo['placa']."'method='get' class='veiculo'>";
                        $VecId = '<input style="display: none;" type="text" name="id" id="placaID" value="' . $veiculo['placa'] .'">';

                        if($veiculo["marca"]){
                            $veic = '<label>' .  $veiculo["marca"] . ' - ' . $veiculo["modelo"] . '</label>' ;    
                        }

                        if($veiculo["imagens"][0]){
                            $imagem = " <div class='DivVeicIMG'><img class='VeicIMG' src='".$veiculo["imagens"][0]."' alt=''> </div>";
                            
                        }elseif($veiculo["imagens"][1]){
                            $imagem = " <div class='DivVeicIMG'><img class='VeicIMG' src='".$veiculo["imagens"][1]."' alt=''> </div>";
                        }elseif($veiculo["imagens"][2]){
                            $imagem = " <div class='DivVeicIMG'><img class='VeicIMG' src='".$veiculo["imagens"][2]."' alt=''> </div>";
                        }else{
                            $imagem = "<p class='erroIMG'> SEM IMGEM</p>";

                        }

                        if (isset($veic)){
                            $veicF = $IniVeicF . $VecId . $imagem . $veic . $Botão . $FimVeicF;
                        }
                            if (isset($veicF)){
                            echo $veicF;
                        }
                        $semcarros = 0;
                    }
                }
                }else{
                    ?>
                        <h2 id="avisoINF" id="texto">Para Alugar um veiculo informe sua cidade de partida e sua cidade destino!</h2>
    
                    <?php }
                if ($semcarros == 1 && $partida){
                    $semcarros = 2;
                    ?>
                        <h2 id="avisoINF">Não há veiculos disponiveis na cidade de partida selecinada</h2>
                    <?php 
                    }
                    ?>
    
                
    </section>
</div>
<div class="header-container light-mode">
    <h2 class="toggle-header"  onclick="toggleItems(this)">Carros Compartilhados <span class="arrow up"></span></h2>
</div>
<div>
    <?php
        if(isset($Veiculos)){
            foreach($Veiculos as $veiculo){
                if($veiculo["proprietario"] == $_COOKIE['userA_Email']){   
            }
        }
    }
        //proprietario
    ?>
</div>

</body>
<script src="../JavaScript/historico.js"></script>
</html>