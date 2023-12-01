<?php 
 session_start();
 if ((!isset($_SESSION['logado']) == true)){
     unset($_SESSION['logado']);
     session_destroy();
     header('Location: ../Cadastro_Login/login.php');
 }


 $erroDiv = '<div id="erroReg"><div><div id="extiAvisoErro">
 <p  onclick="esconderAviso()" tabindex="0">x</p>
</div>
 <p>O veículo não está em nossa posse!</p>
</div></div>';
$sucesso = '<script> alert("Veiculo Removido com sucesso!")</script>';

if (isset($_GET['erro']) and $_GET['erro'] == 'vieculoNaoRegistrado'){
 echo $erroDiv;
}
if (isset($_GET['aviso']) and $_GET['aviso'] == 'sucesso'){
 echo $sucesso;
}


 if(isset($_GET['result']) && $_GET['result'] == 'sucess' ){
    echo "<script>alert('Veiculo avaliado com Sucesso')</script>";
 }elseif(isset($_GET['err']) && $_GET['err'] == 'jaRej'){
    echo "<script>alert('O veiculo foi avaliado anteriormente!')</script>";
 }

 $RegVeic = fopen("../Arquivos_json/carros_alugados.json" , "r");
 $Ja_Alugou = 0;
 if (filesize("../Arquivos_json/carros_alugados.json") > 0){
     $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/carros_alugados.json"));
     $VeiculosAvaliados = json_decode($jsonVeiculosReg, true);
     $Ja_Alugou = 1;
 }
 fclose($RegVeic);

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

<div class="Topcontainer">
    <h2  id="hist">Veículos Recentes </h2>
    <button id="histBTN" class="btn" onclick="ocutarItensHistorico(1)" data-value="norm">Ocutar</button>
</div>
<div>
<div  id="contH" class="cont ">
    <?php
        $semcarros = 1;
        if($Ja_Alugou !== 0 && $definido !== 0){    
            foreach($VeiculosAvaliados as $veicAva){
                foreach($Veiculos as $veiculo){
                    if($veicAva['placa'] == $veiculo['placa']){
                        if($veicAva["usuario"] == $_COOKIE['userA_Email']){
                            
                            $FimVeicF = " </form>";
                            $Botão    = '<input class="alugarBTN" type="submit" value="Avaliar">';
                                $IniVeicF = "<form action='AvaliarVeiculo.php?id=".$veiculo['placa']."'method='get' class='veiculo' class='historico'>";
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
                    }
                }
                }else{
                    ?>
                        <h2 id="avisoINF" id="texto">Assim que você alugar um veiculo ele estará disponivel para avaliação aqui!</h2>
    
                    <?php }
                if ($semcarros == 1 && $partida){
                    $semcarros = 2;
                    ?>
                        <h2 id="avisoINF">Não há veiculos disponiveis na cidade de partida selecinada</h2>
                    <?php 
                    }
    ?>                
        </div>
</div>
<div class="Topcontainer">
    <h2 class="comp" data-value="ativado" >Carros Compartilhados </h2>
    <button id="compBTN" class="btn" onclick="ocutarItensCompartilhados(2)" data-value="norm">Ocutar</button>
</div>
<div id="contC" class="cont">
    <?php
        if(isset($Veiculos)){
            foreach($Veiculos as $veiculo){
                if($veiculo["proprietario"] == $_COOKIE['userA_Email']){   
            }
        }
    }
    
    
    if(isset($Veiculos)){
        foreach($Veiculos as $veiculo){
            if($veiculo["proprietario"] == $_COOKIE['userA_Email']){   
                        
                        $FimVeicF = " </form>";
                        $Botão    = '<input class="alugarBTN" type="submit" value="Retirar">';
                            $IniVeicF = "<form action='RetirarVeiculo.php?id=".$veiculo['placa']."'method='get' class='veiculo' class='historico'>";
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
                }
            else{
                ?>
                    <h2 id="avisoINF" id="texto">Assim que você alugar um veiculo ele estará disponivel para avaliação aqui!</h2>

                <?php }
            if ($semcarros == 1 && $partida){
                $semcarros = 2;
                ?>
                    <h2 id="avisoINF">Não há veiculos disponiveis na cidade de partida selecinada</h2>
                <?php 
                }
?>                
    </div>
</div>

</body>
<script src="../JavaScript/historico.js"></script>
<script src="../JavaScript/AdicionarVeiculo.js"></script>

</html>