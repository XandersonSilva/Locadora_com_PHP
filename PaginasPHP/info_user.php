<!DOCTYPE html>
<?php 
    //VERIFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO NÃO ESTEJA, REDIRECIONA PARA LOGIN
    session_start();
    if ((!isset($_SESSION['logado']) == true)){
        unset($_SESSION['logado']);
        session_destroy();
        header('Location: ../Cadastro_Login/login.php');
    }

    $Veiculos = [];


    $RegVeic = fopen("../Arquivos_json/Veiculos_Registrados.json" , "r");
    $definido = 0;
    $veiculoAtual = "Veiculo invalido";
    if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
        $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/Veiculos_Registrados.json"));
        $Veiculos = json_decode($jsonVeiculosReg, true);
        $definido = 1;
    }else{
        header('Location: ../PaginasPHP/index.php');
        exit;
    }
    fclose($RegVeic);
    



    $arquivo = file_get_contents("../Arquivos_json/carros_alugados.json");
    $CarrosAvaliados = json_decode($arquivo, true);
   


    function classificacao($PropEmail, $CarrosAvaliados){
        //print_r($CarrosAvaliados);
        $classificacao = 0;
        $contador = 0;

             foreach($CarrosAvaliados as $CarrosAva){
               if(!empty($CarrosAva['avaliacao'])){
                    $Propeml =$CarrosAva['proprietario'];
                    if($PropEmail == $Propeml){
                        $AvaAtu=intval($CarrosAva['avaliacao']);
                        $classificacao  += $AvaAtu;
                        $contador++;
                    }
               }
            } 
            if($contador == 0){
                $contador =1;
            }
             
        $estrelasFull = '';
        $classificacao =  intval($classificacao/$contador);
        for($i =0 ; $i< $classificacao; $i++ ){
            $estrelasFull .=  '<img id="Estrela" src="../Imagens/Icones/estrela2.png" alt="">';
            
        }
        for($i =0 ; $i< 5 - $classificacao; $i++ ){
            $estrelasFull .=  '<img id="Estrela" src="../Imagens/Icones/estrela0.png" alt="">';
        }
        echo $estrelasFull;
        
    }
    function infoProp($CarrosAvaliados){
        $RegProp = fopen("../Arquivos_json/usuarios.json" , "r");
        $definido = 0;
        if (filesize("../Arquivos_json/usuarios.json") > 0){
            $jsonVeiculosReg = fread($RegProp, filesize("../Arquivos_json/usuarios.json"));
            $usuarios = json_decode($jsonVeiculosReg, true);
            $definido = 1;
        }else{
            header('Location: ../PaginasPHP/index.php');
            exit;
        }
        fclose($RegProp);
    
        if (isset($_GET['prop'])){
            $prietario = $_GET['prop'];
            if ($definido == 1){
                foreach ($usuarios as $usuario) {
                    if($usuario['Email'] == $prietario){
                        $propietarioAtual = $usuario; 
                        }
                    }
                }
                echo'<p id="NameUsr"> ' . $propietarioAtual['nome'] . '</p>';
                echo'<p id="EmailUsr"> ' .$propietarioAtual['Email'] . '</p>';
                echo'
                <div id="classifc">
                <p>Classificação </p>';
                echo classificacao($propietarioAtual['Email'],$CarrosAvaliados);
                echo '</div>
                <hr>
                ';
    
            }else{
                echo'<p id="NameUsr"> ' . $name = $_COOKIE['userA_Nome'] . '</p>';
                echo'<p id="EmailUsr"> ' . $email = $_COOKIE['userA_Email'] . '</p>';
                echo'
                <div id="classifc">
                <p>Classificação </p>';
                echo classificacao($_COOKIE['userA_Email'] ,$CarrosAvaliados);
                echo '</div>
                <hr>
                ';
            }
    }
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Proprietario </title>
    <link rel="stylesheet" href="../style/style.css">
    <script  src="../JavaScript/exibirBtnSair.js">  </script>
    <script  src="../JavaScript/jquery.js">         </script>
    <script src="../JavaScript/tema.js">            </script>
    <link rel="stylesheet" href="../style/User_Page.css">
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/Index.css">
    <link rel="shortcut icon" href="../Imagens/Favicon/favicon.png" type="image/png">
    
</head>
<header onload="index()">
    <nav>
        <div id="Menu">
            <img  id="logotipo" src="../Imagens/Logotipo/logo_Locadora.png" alt="">
            <img id="menuIco" src="../Imagens/Icones/menu.png" alt="" srcset="" onclick="retMenu()">
        </div>
        <h1>Informações do Proprietario</h1>
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
    <main id='main'>
       
        
        <?php
            infoProp($CarrosAvaliados)
        ?>
       
    </main>
    
</body>
</html>