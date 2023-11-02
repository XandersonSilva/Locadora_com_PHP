<?php 

    require '../lib/vendor/autoload.php';

    use Mpdf\QrCode\QrCode;
    use Mpdf\QrCode\Output;

    //VERIFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO NÃO ESTEJA, REDIRECIONA PARA LOGIN
    $partida = $_POST['partida'] ?? '';
    $destino = $_POST['destino'] ?? '';
    session_start();
    if ((!isset($_SESSION['logado']) == true)){
        unset($_SESSION['logado']);
        session_destroy();
        header('Location: ../Cadastro_Login/login.php');
    }

    //Abrir o arquivo de pagamentos
    $caminhoArq = "../Arquivos_json/Pagamentos.json";
    $PagPendente = fopen($caminhoArq  , "r");

    //Verifica se o arquivo está em branco
    if (filesize($caminhoArq ) > 0){
        $jsonPagamento = fread($PagPendente, filesize($caminhoArq ));
        $pagamentos = json_decode($jsonPagamento, true);
    }else{
        header('Location: ../PaginasPHP/index.php');
    }

    fclose($PagPendente);

    foreach($pagamentos as $pag){
        if($pag['placa'] == $_COOKIE['placa']){
            $pagamento = $pag;
            $encontrado = 1;
        }
    }
    if(!isset($encontrado)){
    header('Location: ../PaginasPHP/index.php');
    }
    
    
    $chave = $pagamento['chave'];
    
    //Qr code
    $obQrcode = new Qrcode($chave);
    
    $qrImage = (new Output\Png)->output($obQrcode, 300);

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
    <title>Pagamento PIX</title>
    
</head>
<header onload="index()">
    <nav>
        <div id="Menu">
            <img src="../Imagens/Icones/menu.png" alt="" srcset="" onclick="retMenu()">
        </div>
        <h1>Pagamento PIX</h1>
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
    <img src="../Imagens/Icones/menu.png" id="retMenu" onclick="retMenu()">
        <div id="menu_list">
            <form action="../PaginasPHP/index.php">
                <input type="submit" value="Página principal" class="css-input">
            </form>
        </div>
        <div id="menu_list">
            <form action="#">
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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            width: 340px;
            margin: 0 auto;
            padding: 5px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .qr-code {
            margin: auto;
        }
        .copiar-texto {
            display: block;
            background-color: #0074cc;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .copiar-texto:hover {
            background-color: #005ea7;
        }
        #chave{
            border-radius: 5px;
    padding: 2px;
    border: 10px solid #70bb8999;
    background: #70bb8999;
    user-select: none;
    font-family: monospace;
        }
        #chave_pix{
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Escaneie o QR Code com o aplicativo do seu banco</p>
        <div class="qr-code">
            <img src="data:image/png;base64, <?=base64_encode($qrImage)?>" alt="QR Code PIX">
        </div>
        <p>Ou copie o código abaixo:</p>
        <p id="chave_pix"><?=$pagamento['chave']?></p>
        <p id="chave"><?=wordwrap($pagamento['chave'], 40, "\n", true)?></p>
        

        <a class="copiar-texto" href="#">Copiar Chave PIX</a>
    </div>

    <script>
        // JavaScript para copiar o texto para a área de transferência
        document.querySelector(".copiar-texto").addEventListener("click", function () {
            var chavePix = document.getElementById("chave_pix").textContent;
            var input = document.createElement("textarea");
            input.value = chavePix;
            document.body.appendChild(input);
            input.select();
            document.execCommand("copy");
            document.body.removeChild(input);
            alert("Chave PIX copiada para a área de transferência: " + chavePix);
        });
    </script>
</body>
</html>
