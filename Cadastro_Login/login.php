<!DOCTYPE html>
<?php 
    // VERFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO SIM, REDIRECIONA PARA A PÁGINA PRINCIPAL
    session_start();
    if ((isset($_SESSION['logado']) == true)){
        header('Location: ../PaginasPHP/index.php');
    }
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer login</title>
    <link rel="stylesheet" href="../style/login_style.css">
    <link rel="shortcut icon" href="../Imagens/Favicon/conecte-se.png" type="image/png">
    <script src="../JavaScript/jquery.js"></script>

</head>
<body>
    
    <main >
        <section id="conteudo">
            <article id="L-form">
                <form action="../ScriptsPHP/validarLogin.php" method="post">
                    <article id="login">
                        <h1>Login</h1>
                    </article>
                    <article>
                        <label for="email">Email</label> 
                        <input class="campo" type="email" name="Email" id="email" placeholder="Email@exemplo.com"  required size="30" onclick="ocutar()">
                    </article>
                    <br>
                    <article>
                        <label for="senha">Senha</label> 
                        <input class="campo" type="password" name="Senha" id="senha" placeholder="12345678" required onclick="ocutar()">
                        <?php
                        if (isset($_GET['erro'])){
                            echo '<samp class="erro"> Usuário e ou senha inválidos </samp>';
                            }
                        ?>
                    </article>
                    <article id="logar">
                      <input type="submit" value="Entrar" id="enviar">
                    </article>
                </form>
            </article>
            <article id="Cadastrar-se">
                <label for="Cdt"><strong>Não possui uma conta?</strong></label>
                <a href="cadastro.php">
                    <input type="button" value="Cadastrar-se" id="Cdt">
                </a>
             </article>
        </section>
    </main>
    <footer style="text-align: center;">
        <small>
            &reg; Todos os direitos reservados 
        </br>
            Contato Xanderson: <a href="https://github.com/xandersonsilva" target="_blank">GitHub </a> - <a href="https://www.instagram.com/x.s.s____/" target = "_blank">Instagram</a> <br>
            Contato João Vitor: <a href="https://github.com/SilvestreLago" target="_blank">GitHub </a> - <a href="https://www.instagram.com/silvestre_lago" target = "_blank">Instagram</a> 
        </small>
    </footer>
    <script>
        function ocutar(){
            $(".erro").hide();
        }
    </script>
</body>
</html>