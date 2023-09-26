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
    <link rel="stylesheet" href="../style/AlugarVeic.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/AdicionarV.css">
    
    
</head>
<header>
    <nav>
        <div id="Menu">
            <img src="../Imagens/Icones/menu.png" alt="" srcset="">
        </div>
        <h1>Alugar Veículo</h1>
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
        <section>
            <?php 
                $RegVeic = fopen("../Arquivos_json/Veiculos_Registrados.json" , "r");
                $definido = 0;
                $veiculoAtual = "Veiculo invalido";
                if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
                    $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/Veiculos_Registrados.json"));
                    $Veiculos = json_decode($jsonVeiculosReg, true);
                    $definido = 1;
                }

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
                fclose($RegVeic);
            ?>

        <div id="ContFts" >
            <div id="Veic_fotos" >
                <?php 
                     
                    if($veiculoAtual["imagens"][0]){
                        echo '<img src="'. $veiculoAtual['imagens'][0] .'" alt="">';    
                        
                    }elseif($veiculoAtual["imagens"][1]){
                        echo '<img src="'. $veiculoAtual['imagens'][1] .'" alt="">';
                        
                    }elseif($veiculoAtual["imagens"][2]){
                        echo '<img src="'. $veiculoAtual['imagens'][2] .'" alt="">';
                        
                    }else{
                        echo  "<p id='erroIMG'> SEM IMGEM</p>";
                    }
                ?>
            </div>
        <div>
        </section>
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
        </section>


    <main>    
</body>
<script  src="../JavaScript/exibirBtnSair.js">  </script>
<script  src="../JavaScript/jquery.js">         </script>
</html>