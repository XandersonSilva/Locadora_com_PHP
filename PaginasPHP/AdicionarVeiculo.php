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
    <link rel="stylesheet" href="../style/AdicionarV.css">
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/Index.css">
    <script src="../JavaScript/tema.js"></script>
</head>
<style>
    label{
    padding-left: 5px;
    height: auto;
}
</style>
<header onload="user()">
    <nav>
        <div id="Menu">
            <img src="../Imagens/Icones/menu.png" alt="" srcset="" onclick="retMenu()">
        </div>
        <h1>Adicionar Veículo</h1>
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

<body>
    <main id="main">


    <?php 
    
    
    $erroDiv = '<div id="erroReg"><div><div id="extiAvisoErro">
        <p  onclick="esconderAviso()" tabindex="0">x</p>
    </div>
        <p>A placa informada pertence a outro veículo!</p>
    </div></div>';
    $sucesso = '<script> alert("Veiculo registrado com sucesso!")</script>';

    if (isset($_GET['erro']) and $_GET['erro'] == 'vieculoJaRegistrado'){
        echo $erroDiv;
    }
    if (isset($_GET['aviso']) and $_GET['aviso'] == 'sucesso'){
        echo $sucesso;
    }
    
    ?>


        <form id="AddVeic" action="../ScriptsPHP/adicionarVeiculo.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fotoA" accept="image/*" id="fotoA" style="display: none;">
            <input type="file" name="fotoC" accept="image/*" id="fotoC" style="display: none;">
            <input type="file" name="fotoB" accept="image/*" id="fotoB" style="display: none;">
            <div id="conteinerFts">
                <p>Imagens</p>
                <div id="fotos" >

                    <div id="fotoA" onclick="uploadImgA()" tabindex="0">  
                        <!-- SVG ICONE + -->
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="10" width="5" height="25" fill="#322C91"/>
                            <rect y="15" width="5" height="25" transform="rotate(-90 0 15)" fill="#322C91"/>
                        </svg>
                    
                    </div>

                    <div id="fotoB" onclick="uploadImgB()" tabindex="0">
                        <!-- SVG ICONE + -->
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="10" width="5" height="25" fill="#322C91"/>
                            <rect y="15" width="5" height="25" transform="rotate(-90 0 15)" fill="#322C91"/>
                        </svg>

                    </div>

                    <div id="fotoC" onclick="uploadImgC()" tabindex="0">
                        <!-- SVG ICONE + -->
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="10" width="5" height="25" fill="#322C91"/>
                            <rect y="15" width="5" height="25" transform="rotate(-90 0 15)" fill="#322C91"/>
                        </svg>
                        
                    </div>
                </div>
            
            </div>
            
            <div class="selecao">
                <label for="marca">Marca</label>
                <select id="marca" name="marca" onchange="teste()" required>
                    <option value="Nao informado">-</option>
                    <option value="Abarth">Abarth</option>
                    <option value="Adamo">Adamo</option>
                    <option value="Agrale">Agrale</option>
                    <option value="Aldee">Aldee</option>
                    <option value="Alfa Romeo">Alfa Romeo</option>
                    <option value="Americar">Americar</option>
                    <option value="Audi">Audi</option>
                    <option value="Aurora">Aurora</option>
                    <option value="Avallone">Avallone</option>
                    <option value="Bianco">Bianco</option>
                    <option value="BMW">BMW</option>
                    <option value="Bola">Bola</option>
                    <option value="Brasinca">Brasinca</option>
                    <option value="CBP">CBP</option>
                    <option value="CBT">CBT</option>
                    <option value="Chamonix">Chamonix</option>
                    <option value="Chery">Chery</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="Chrysler/Dodge">Chrysler/Dodge</option>
                    <option value="Citroën">Citroën</option>
                    <option value="Concorde">Concorde</option>
                    <option value="Corona">Corona</option>
                    <option value="Cross Lander">Cross Lander</option>
                    <option value="Daewoo">Daewoo</option>
                    <option value="Daihatsu">Daihatsu</option>
                    <option value="Dankar">Dankar</option>
                    <option value="DKW-Vemag">DKW-Vemag</option>
                    <option value="Edra">Edra</option>
                    <option value="Emis">Emis</option>
                    <option value="Engerauto">Engerauto</option>
                    <option value="Engesa">Engesa</option>
                    <option value="Envemo">Envemo</option>
                    <option value="Envesa">Envesa</option>
                    <option value="Effa">Effa</option>
                    <option value="Farus">Farus</option>
                    <option value="Fiat">Fiat</option>
                    <option value="FNM">FNM</option>
                    <option value="Ford">Ford</option>
                    <option value="Furglass">Furglass</option>
                    <option value="Geely">Geely</option>
                    <option value="Glaspac">Glaspac</option>
                    <option value="GMC">GMC</option>
                    <option value="Grancar">Grancar</option>
                    <option value="Gurgel">Gurgel</option>
                    <option value="GWM">GWM</option>
                    <option value="Hofstetter">Hofstetter</option>
                    <option value="Honda">Honda</option>
                    <option value="Hummer">Hummer</option>
                    <option value="Hyundai">Hyundai</option>
                    <option value="IBAP">IBAP</option>
                    <option value="Inbrave">Inbrave</option>
                    <option value="Infiniti">Infiniti</option>
                    <option value="Ita">Ita</option>
                    <option value="JAC">JAC</option>
                    <option value="Jaguar">Jaguar</option>
                    <option value="Jeep">Jeep</option>
                    <option value="JPX">JPX</option>
                    <option value="Kadron">Kadron</option>
                    <option value="Kia[59]">Kia[59]</option>
                    <option value="Lada">Lada</option>
                    <option value="L'Automobile/L'Auto Craft">L'Automobile/L'Auto Craft</option>
                    <option value="Lafer">Lafer</option>
                    <option value="Land Rover">Land Rover</option>
                    <option value="Lexus">Lexus</option>
                    <option value="LHM">LHM</option>
                    <option value="Lifan">Lifan</option>
                    <option value="Lincoln">Lincoln</option>
                    <option value="Lobini">Lobini</option>
                    <option value="Lorena">Lorena</option>
                    <option value="Macan">Macan</option>
                    <option value="Mahindra">Mahindra</option>
                    <option value="Malzoni">Malzoni</option>
                    <option value="Matra Veículos">Matra Veículos</option>
                    <option value="Mazda">Mazda</option>
                    <option value="Megastar Veículos">Megastar Veículos</option>
                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                    <option value="MG">MG</option>
                    <option value="Mini">Mini</option>
                    <option value="Mirage">Mirage</option>
                    <option value="Mitsubishi">Mitsubishi</option>
                    <option value="Miura">Miura</option>
                    <option value="Monarca">Monarca</option>
                    <option value="NBM">NBM</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Nobre">Nobre</option>
                    <option value="PAG/Dacon">PAG/Dacon</option>
                    <option value="Peugeot">Peugeot</option>
                    <option value="Polystilo">Polystilo</option>
                    <option value="Puma">Puma</option>
                    <option value="Py Motors">Py Motors</option>
                    <option value="Ragge">Ragge</option>
                    <option value="Renault">Renault</option>
                    <option value="Romi">Romi</option>
                    <option value="Saab">Saab</option>
                    <option value="Simca">Simca</option>
                    <option value="Santa Matilde">Santa Matilde</option>
                    <option value="San Vito">San Vito</option>
                    <option value="SEAT">SEAT</option>
                    <option value="Smart">Smart</option>
                    <option value="STV">STV</option>
                    <option value="Spiller Mattei">Spiller Mattei</option>
                    <option value="SR Veículos Especiais">SR Veículos Especiais</option>
                    <option value="Subaru">Subaru</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="SsangYong">SsangYong</option>
                    <option value="TAC Motors">TAC Motors</option>
                    <option value="Tanger">Tanger</option>
                    <option value="Toyota">Toyota</option>
                    <option value="Trimax">Trimax</option>
                    <option value="Troller">Troller</option>
                    <option value="Villa">Villa</option>
                    <option value="Volvo">Volvo</option>
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="WMV">WMV</option>
                    <option value="Willys Overland">Willys Overland</option>
    
                </select>

            </div>    
            

            <div class="selecao">
                <label for="modelo">Modelo</label>
                <select name="modelo" id="modelo" required>
                    <option value="Nao informado">-</option>
                </select>

            </div>

            <div class="selecao">
                <label for="passageiros">Capacidade do veículo</label>
                <select name="passageiros" id="passageiros" required>
                    <option value="Nao informado">-</option>
                    <option value="1">1 Pessoa</option>
                    <option value="2">2 Pessoas</option>
                    <option value="4">4 Pessoas</option>
                    <option value="6">6 Pessoas</option>
                    <option value="8">8 Pessoas</option>
                </select>

            </div>
            
            <div class="selecao">
                <label for="combustivel">Tipo de Combustível</label>
                <select name="combustivel" id="combustivel" required>
                    <option value="Nao informado">-</option>
                    <option value="Gasolina">Gasolina</option>
                    <option value="Alcool">Alcool</option>
                    <option value="Disel">Disel</option>
                    <option value="Eletrico">Eletrico</option>
                    <option value="Outro">Outro</option>
                </select>

            </div>

            <div class="selecao">
                <label for="placa">Placa</label>
                <input required type="text" name="placa" id="placa" placeholder="ABC1A23" maxlength="7">
            </div>
            <div class="selecao">
                <label for="KmL">Quilômetros por litro</label>
                <input required type="number" name="KmL" id="KmL" min="1" max="30" step="0.1" >
            </div>

            <label for="detalhes">Detalhes Adicionais</label>
            <textarea id="detalhes" name="detalhes" rows="4" cols="5" ></textarea>

            <p id="inserc">Local de inserção</p>
            <div class="selecao">
            <label for="uf">Estado</label>
            <select class="entrada" id="uf" name="uf" onchange="exibirCity()" required>
                <option value="Nao informado">-</option>
                <option value="AC">AC - Acre</option>
                <option value="AL">AL - Alagoas</option>
                <option value="AP">AP - Amapá</option>
                <option value="AM">AM - Amazonas</option>
                <option value="BA">BA - Bahia</option>
                <option value="CE">CE - Ceará</option>
                <option value="DF">DF - Distrito Federal</option>
                <option value="ES">ES - Espírito Santo</option>
                <option value="GO">GO - Goiás</option>
                <option value="MA">MA - Maranhão</option>
                <option value="MT">MT - Mato Grosso</option>
                <option value="MS">MS - Mato Grosso do Sul</option>
                <option value="MG">MG - Minas Gerais</option>
                <option value="PA">PA - Pará</option>
                <option value="PB">PB - Paraíba</option>
                <option value="PR">PR - Paraná</option>
                <option value="PE">PE - Pernambuco</option>
                <option value="PI">PI - Piauí</option>
                <option value="RJ">RJ - Rio de Janeiro</option>
                <option value="RN">RN - Rio Grande do Norte</option>
                <option value="RS">RS - Rio Grande do Sul</option>
                <option value="RO">RO - Rondônia</option>
                <option value="RR">RR - Roraima</option>
                <option value="SC">SC - Santa Catarina</option>
                <option value="SP">SP - São Paulo</option>
                <option value="SE">SE - Sergipe</option>
                <option value="TO">TO - Tocantins</option>
            </select>
        </div>
        <div class="selecao" id="cid">
            <label for="cidade">Cidade</label>
            <select class="entrada" id="cidade" name="cidade" required >
                <option value="Nao informado">-</option>
            </select>
        </div>
            <input type="submit" value="Adicionar">
        </form>
    </main>
    
</body>
<script  src="../JavaScript/exibirBtnSair.js">  </script>
<script  src="../JavaScript/jquery.js">         </script>
<script src="../JavaScript/AdicionarVeiculo.js"></script>
</html>