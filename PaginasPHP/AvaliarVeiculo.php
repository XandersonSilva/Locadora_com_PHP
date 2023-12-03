<?php 
    //VERIFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO NÃO ESTEJA, REDIRECIONA PARA LOGIN
    session_start();
   
    if ((!isset($_SESSION['logado']) == true)){
        unset($_SESSION['logado']);
        session_destroy();
        header('Location: ../Cadastro_Login/login.php');
    }
   

    $RegVeic = fopen("../Arquivos_json/carros_alugados.json" , "r");
    $definido = 0;
    $veiculoAtual = "Veiculo invalido";
    if (filesize("../Arquivos_json/carros_alugados.json") > 0){
        $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/carros_alugados.json"));
        $VeiculosAvaliados = json_decode($jsonVeiculosReg, true);
        $definido = 1;
    }
    fclose($RegVeic);

    $RegVeic = fopen("../Arquivos_json/Veiculos_Registrados.json" , "r");
    $definido = 0;
    $veiculoAtual = "Veiculo invalido";
    if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
        $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/Veiculos_Registrados.json"));
        $Veiculos = json_decode($jsonVeiculosReg, true);
        $definido = 1;
    }
    
    fclose($RegVeic);
    if (isset($_GET['id'])){
        $placa = $_GET['id'];
        if ($definido == 1){
            foreach ($Veiculos as $veiculo) {
                if($veiculo['placa'] == $placa){
                    $veiculoAtual = $veiculo; 
                }
            }
        }
    }
    
        foreach($VeiculosAvaliados as $veiculo){
            if(!empty($veiculo['avaliacao']) && $veiculo['placa'] == $placa ){
                ?>
                <script>
                    alert("Esse veículo já foi avaliado!");
                </script>
                <?php 
                header("Location: historico.php?err=jaRej");
            }
        }

        
    $quant = 0;
    $indicesVal = [];
    for ($i = 0; $i < 3; $i++){
        if($veiculoAtual["imagens"][$i] != ''){
            array_push($indicesVal, $i+1);
            $quant++;        
        }
        else{
            array_push($indicesVal, 0);
        }
    }

    $indicesVal = implode(', ', $indicesVal);
    ?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar</title>
    <link rel="stylesheet" href="../style/AlugarVeic.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/AdicionarV.css" >
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/Index.css">
    <link rel="stylesheet" href="../style/avaliarVeiculo.css">
    <script src="../JavaScript/tema.js"></script>
    <script  src="../JavaScript/exibirBtnSair.js">  </script>
    <script  src="../JavaScript/jquery.js">         </script>
    <script  src="../JavaScript/AlugarVeiculo.js">  </script>
    
    
</head>
<style>
    .NVeiw{
        display: none   ;
    }
</style>
<header onload="user()">
    <nav>
        <div id="Menu">
            <img src="../Imagens/Icones/menu.png" alt="" srcset="" onclick="retMenu()">
        </div>
        <h1>Avaliar Veículo</h1>
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
                <input id='noneD' value="<?=$_SERVER['PHP_SELF'].'?id='.$placa?>" id="btntema"  name='back'>
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
    <main id="main">
        <section>
            <div id="ContFts" >
    <br>
    <div id="Veic_fotos" >
        
        
        <?php 
        
            if ($quant > 1){
                echo '<img id="seta" src="..\Imagens\Icones\seta-esquerda.png" onclick="Anterior('.$indicesVal.')"> ';
            }
            if($veiculoAtual["imagens"][0]){
                echo '<img id="veic1" class="imgVisvel" src="'. $veiculoAtual['imagens'][0] .'" alt="">';    
                
            }elseif($veiculoAtual["imagens"][1]){
                echo '<img id="veic2" class="imgVisvel" src="'. $veiculoAtual['imagens'][1] .'" alt="">';
                
            }elseif($veiculoAtual["imagens"][2]){
                echo '<img id="veic3" class="imgVisvel" src="'. $veiculoAtual['imagens'][2] .'" alt="">';
                
            }else{
                echo  "<p id='erroIMG'> SEM IMGEM</p>";
            }
            if ($quant > 1){        
                echo ' <img id="seta" src="..\Imagens\Icones\seta-direita.png" onclick="Proximo('.$indicesVal.')">';
            }
                    ?>
            </div>
 
            <?php $plc = $_GET['id']?>
            <div> <p>Diaria: R$<?php $tt = $veiculoAtual["valor_diaria"]; echo $tt?></p> </div>
        </section>
            <form action="../ScriptsPHP/avaliar.php" method="post" id="alugar">
            <div class="avaliacao" id="avaliacao-container" >
                <img src="../Imagens/Icones/estrela0.png" alt="Estrela Vazia" name="e1" id="est1" class="estrela" data-value="1">
                <img src="../Imagens/Icones/estrela0.png" alt="Estrela Vazia" name="e2" id="est2" class="estrela" data-value="2">
                <img src="../Imagens/Icones/estrela0.png" alt="Estrela Vazia" name="e3" id="est3" class="estrela" data-value="3">
                <img src="../Imagens/Icones/estrela0.png" alt="Estrela Vazia" name="e4" id="est4" class="estrela" data-value="4">
                <img src="../Imagens/Icones/estrela0.png" alt="Estrela Vazia" name="e5" id="est5" class="estrela" data-value="5">
            </div>

                <input type="button" onclick="verificarValor()" value="Avaliar" id="alugarBTN">
                <input type="text" name="nome"  id="" value="<?=$nomeUser?>" class="NVeiw">
                <input type="number" name="estrelasSlc" id="estrelasSlc" value="0"  class="NVeiw" >
                <input type="text" name="placa" id="" value="<?=$plc?>" class="NVeiw">
            </form>
        <section id="dadosV">
            <div class='dado'>
                <p>Marca</p>
                <?php 
                echo "<p>".$veiculoAtual["marca"]."</p>";
                ?>
            </div>
            <div class='dado'>
                <p>Modelo</p>
                <?php 
                echo "<p>".$veiculoAtual["modelo"]."</p>";
                ?>
            </div>
            <div class='dado'>
                <p>Capacidade</p>
                <?php 
                echo "<p>".$veiculoAtual["capacidade"]."</p>";
                ?>
            </div>
            <div class='dado'>
                <p>Combustivel</p>
                <?="<p>".$veiculoAtual["combustivel"]."</p>"?>
            </div> 
            <div class='dado'>
                <p>Quilometros por litro </p>
                <?="<p>".$veiculoAtual["KM_por_Litro"]."</p>"?>
            </div>
            <div class='dado'>
                <p>Quilometros por litro </p>
                <?="<p>".$veiculoAtual["proprietario"]."</p>"?>
            </div>
            <div id='detalhes'>
                <p>Detalhes </p>
                <?="<p>".$veiculoAtual["detalhes"]."</p>"?>
            </div>
        </section>
    </main>    
</body>
<script src="../JavaScript/AvaliarVeiculo.js"></script>
</html>