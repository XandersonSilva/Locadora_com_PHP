<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer login</title>
    <link rel="stylesheet" href="../Style/login_style.css">
    <link rel="shortcut icon" href="../Imagens/Favicon/conecte-se.png" type="image/png">
    <script src="../JavaScript/jquery.js"></script>

</head>
<body>
    
    <main class="conteudo">
        <section>
            <article id="L-form">
                <form action="../ScriptsPHP/validarLogin.php" method="post">
                    <article>
                        <h1>Login</h1>
                    </article>
                    <article>
                        <label for="email">Email</label> 
                        <input type="email" name="Email" id="email" placeholder="Email@exemplo.com"  required size="30" onclick="ocutar()">
                    </article>
                    <br>
                    <article>
                        <label for="senha">Senha</label> 
                        <input type="password" name="Senha" id="senha" placeholder="12345678" required onclick="ocutar()">
                        <?php
                        if (isset($_GET['erro'])){
                            echo '<samp class="erro"> Usuário e ou senha inválidos </samp>';
                            }
                        ?>
                    </article>
                    <article>
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
    <footer>
        <small>
            &reg; Todos os direitos reservados 
        </br>
            Contato: <a href="https://github.com/xandersonsilva" target="_blank">GitHub </a> - <a href="https://www.instagram.com/x.s.s____/" target = "_blank">Instagram</a> 
        </small>
    </footer>
    <script>
        function ocutar(){
            $(".erro").hide();
        }
    </script>
</body>
</html>