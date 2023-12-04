<!DOCTYPE html>
<?php 
    //VERIFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO NÃO ESTEJA, REDIRECIONA PARA LOGIN
    session_start();
    if ((!isset($_SESSION['logado']) == true)){
        unset($_SESSION['logado']);
        session_destroy();
        header('Location: ../Cadastro_Login/login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera os dados do formulário
        $nome = $_POST["nome"]         ?? 0;
        $email = $_COOKIE["userA_Email"]       ?? 0;
        $preco = $_POST["preco"]       ?? 0;
        $dias = $_POST["dias"]         ?? 0;
        $placa = $_POST["placa"]       ?? 0;

        // Calcular o total
        $total = $dias * $preco;
    }
    $RegVeic = fopen("../Arquivos_json/Veiculos_Registrados.json" , "r");
    $definido = 0;
    $veiculoAtual = "Veiculo invalido";
    if (filesize("../Arquivos_json/Veiculos_Registrados.json") > 0){
        $jsonVeiculosReg = fread($RegVeic, filesize("../Arquivos_json/Veiculos_Registrados.json"));
        $Veiculos = json_decode($jsonVeiculosReg, true);
        $definido = 1;
    }

    if ($definido == 1){
        foreach ($Veiculos as $veiculo) {
            if($veiculo['placa'] == $placa){
                $veiculoAtual = $veiculo;
                    }
                }
            }
    

    fclose($RegVeic);
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
<html lang="pt-BR" id="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/Index.css">
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/pagamento.css">
    <script  src="../JavaScript/exibirBtnSair.js">  </script>
    <script  src="../JavaScript/jquery.js">         </script>
    <link rel="shortcut icon" href="../Imagens/Favicon/favicon.png" type="image/png">
    
</head>
<header onload="index()">
    <nav>
        <div id="Menu">
            <img  id="logotipo" src="../Imagens/Logotipo/logo_Locadora.png" alt="">
            <img id="menuIco" src="../Imagens/Icones/menu.png" alt="" srcset="" onclick="retMenu()">
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
</header>

<div id="menuLateral">
        <div id="temaDiv">
            <img src="../Imagens/Icones/menu.png" id="retMenu" onclick="retMenu()">
            
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
        <h1>Confirmação de aluguel</h1>
        
        <!--<p>Obrigado, <?// echo $nome; ?>!</p>-->
    
<div id="Veic_fotos" >
        
        
        <?php 
        
            
            if($veiculoAtual["imagens"][0]){
                echo '<img id="veic1" class="imgVisvel" src="'. $veiculoAtual['imagens'][0] .'" alt="">';    
                
            }elseif($veiculoAtual["imagens"][1]){
                echo '<img id="veic2" class="imgVisvel" src="'. $veiculoAtual['imagens'][1] .'" alt="">';
                
            }elseif($veiculoAtual["imagens"][2]){
                echo '<img id="veic3" class="imgVisvel" src="'. $veiculoAtual['imagens'][2] .'" alt="">';
                
            }else{
                echo  "<p id='erroIMG'> SEM IMGEM</p>";
            }
                    ?>
        <div id="Fpag">
    
            <form action="../ScriptsPHP/realizarPagamento.php" method="post">
                <input class="modern-button" type="submit" value="Pagar com pix">
                <input type="text" style="display: none;" name="placa" value="<?=$placa ?>">
                <input type="text" style="display: none;" name="preco" value="<?= $total?>">
            </form>
</div>

    </div>
 

<table id='TbInfo'>
    <tr>
        <th colspan="2">Detalhes da compra</th>
    </tr>
    <tr>
        <td>Nome:</td>
            <td><?php echo $nome; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <td>Diária:</td>
            <td><?php echo 'R$ '. number_format($preco, 2, ',', '.')?></td>
        </tr>
        <tr>
            <td>Quantidade de dias:</td>
            <td><?php echo $dias; ?></td>
        </tr>
        <tr>
            <td>Total:</td>
            <td><?php echo 'R$ '. number_format($total, 2, ',', '.')?></td>
        </tr>
    </table>


</main>
</body>
<script src="../JavaScript/tema.js"> </script>
</html>