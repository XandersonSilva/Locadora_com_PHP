<!DOCTYPE html>
<?php 
    // VERFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO SIM, REDIRECIONA PARA A PÁGINA PRINCIPAL
    session_start();
    if ((isset($_SESSION['logado']) == true)){
        header('Location: ../PaginasPHP/index.php');
    }
?>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../Style/cadastro_style.css">
  <link rel="stylesheet" href="../style/Cadastro.css">
  <link rel="shortcut icon" href="../Imagens/Favicon/formulario-de-registro.png" type="image/png">
  <script src="../JavaScript/jquery.js"></script>
</head>
<body>

    <main class="conteudo">

    <?php
      if(isset($_GET['erro'])){
        echo "<script>alert('O E-mail informado já está em uso');</script>";
     
      }
    
    ?>


      <section>
        <h1>Cadastrar-se</h1>
        
        <form action="../ScriptsPHP/adicionarUser.php"  method="get">
          <p>
            <label for="nome" action="cadastro.html" >Nome: </label>
            <input class="entrada" type="text" name="nome" id="nome" required
            onblur="semNome()" minlength="3" maxlength="30" >
            <span id="erroNome" class="erro"></span>
          </p>

          <p>
            <label for="E-mail">E-mail</label>
            <input class="entrada" type="email" name="email" required id="E-mail" onblur="semEmail()" placeholder="Email@exemplo.com" >
            <span id="erroEmail" class="erro"></span>
          </p>

          <p>
            <label for="endereco">Endereço</label>
            <input class="entrada" type="text" name="endereco" onblur="semEndereco()" id="endereco" required>
            <span id="erroEndereco" class="erro"></span>        
          </p>

          <p>
            <label for="CPF">CPF</label>
            <input class="entrada" type="number" name="CPF" id="cpf" placeholder="00000000000" onkeyup="validaC()" onblur="validaC()" required>
            <span id="erroCPF" class="erro"></span>
          </p>

          <p>
            <label for="nascimento">Nascimento: </label>
            <input class="entrada" type="date" name="nascimento" id="nascimento"  onblur="validaIdade()"required>
            <span id="erroIdade" class="erro"></span>
          </p>

          <p>
            <label for="senha">Senha:</label>
            <input class="entrada" type="password" name="senha" id="senha"maxlength="12" minlength="4" required>
            <span id="erroSenha" class="erro"></span>
          </p>

          <p>
            <label for="senhaIgual">Confirme a senha: </label>
            <input class="entrada" type="password" name="senhaIgual" id="senhaIgual" maxlength="12" minlength="4" required onblur="verifica()" >
            <span id="erroSenhaRepetida" class="erro"></span>
          </p>
          
      
          <input type="submit" value="Cadastrar-se"  class="ativado" id="botaoCadastrar" onclick="avancar()">

        </form>
        <aside>
          <a href="login.php">Já tem uma conta?</a>
        </aside>
      </section>
  </main>

  <footer>
    <small>
        &reg; Todos os direitos reservados 
    </br>
            Contato Xanderson: <a href="https://github.com/xandersonsilva" target="_blank">GitHub </a> - <a href="https://www.instagram.com/x.s.s____/" target = "_blank">Instagram</a> <br>
            Contato João Vitor: <a href="https://github.com/SilvestreLago" target="_blank">GitHub </a> - <a href="https://www.instagram.com/silvestre_lago" target = "_blank">Instagram</a>     </small>
  </footer>

  <script src="../JavaScript/Cadastro_P.js"></script>
</body>
</html>