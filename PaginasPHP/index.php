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
    <link rel="stylesheet" href="../style/Index.css">
    <script  src="../JavaScript/exibirBtnSair.js">  </script>
    <script  src="../JavaScript/jquery.js">         </script>
    
</head>
<header>
    <nav>
        <div id="Menu">
            <img src="../Imagens/Icones/menu.png" alt="" srcset="">
        </div>
        <h1>Alugar</h1>
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
            <form action="../PaginasPHP/info_user.php">
                <input type="submit" value="Perfil" id="info_user">
            </form>
        </div>
    </article>
</header>

<div id="Pesquisa">
    <input type="text" name="pesq_input" id="pesq_input">
   
    <svg id="pesqBtn" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24 "><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
</div>
<hr>
<body>
    <main>
            <section id="conteudo">
                
                
                <?php 
                    $RegVeic = fopen("../Arquivos_json/Veiculos_Registrados.json" , "r");

                    if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
                        $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/Veiculos_Registrados.json"));
                        $Veiculos = json_decode($jsonVeiculosReg, true);
                        $definido = 1;
                    }


                    $IniVeicF = "<form class='veiculo'>";
                    $FimVeicF = " </form>";
                    $Botão    = '<input class="alugarBTN" type="submit" value="Alugar">';
                    foreach ($Veiculos as $veiculo) {
                        if($veiculo["Marca"]){
                            $veic = '<label>' .  $veiculo["Marca"] . ' - ' . $veiculo["Modelo"] . '</label>' ;    
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
                            $veicF = $IniVeicF . $imagem . $veic . $Botão . $FimVeicF;
                        }
                            if (isset($veicF)){
                            echo $veicF;
                        };

                    };
                    fclose($RegVeic);
                ?>
            </section>

    </main>

</body>
</html>