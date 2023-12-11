<?php 
$preco = $_POST['preco'] ?? '';
$placa = $_POST['placa'] ?? '';
if(!$preco && !$placa){
    header("Location: ../Cadastro_Login/login.php");
    exit;
}

require '../lib/vendor/autoload.php';

use \App\Pix\Payload;

//CRIANDO O OBJETO PAYLOAD
$obPayload =  (new Payload)->setPixkey('isacsilvasouza5@gmail.com')
                           ->setDescription('Pagamento_de_cobranca')
                           ->setMerchantName('JX')
                           ->setMerchantCity('Jacobina')
                           ->setAmount("$preco")
                           ->setTxid('JX2023')
;

//CÓDIGO DE PAGAMENTO PIX
$PayloadQrCode = $obPayload->getPayload();

//INSERIR OS DADOS NA BASE DE DADOS

//Abrir o arquivo de pagamentos
$caminhoArq = "../Arquivos_json/Pagamentos.json";
$PagPendente = fopen($caminhoArq  , "r");

//Verifica se o arquivo está em branco
if (filesize($caminhoArq ) > 0){
    $jsonPagamento = fread($PagPendente, filesize($caminhoArq ));
    $pagamento = json_decode($jsonPagamento, true);
}else{
    $pagamento = [];
}
fclose($PagPendente);
    
    $Elementos = array("placa"=>$placa,"chave"=>$PayloadQrCode);

    array_push($pagamento, $Elementos);
    $pagamento = json_encode($pagamento);
    $PagPendente = fopen($caminhoArq, 'w');
    fwrite($PagPendente, $pagamento);
    fclose($PagPendente);

    setcookie('placa', $placa, 0, '/');
    header("Location: ../PaginasPHP/PageQr_Pix.php");

    exit;
?>
