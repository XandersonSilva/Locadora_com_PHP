<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['email'])){
        print_r($_SESSION['email']);
        header('Location: ../Cadastro_Login/cadastro.php');
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
<style>
    #email{
        margin: 10px 0px;
        background-color: #322C91;
        color: #fff;
        width: 288px;
        padding: 5px 0;
        font-size: 18px;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }
    #L-form > form > article:nth-child(4){
        width: 288px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
    }
    #senha{
        border: 2px solid #1f1b58;
        border-bottom-color: #191577;
        text-align: center;
        font-size: 20px;
        width: 90px;
        background-color: #eee;
    }

</style>
<body>
    
    <main>
        <section id="conteudo">
            <article id="L-form">
                <form action="../ScriptsPHP/adicionarUser.php" method="post">
                    <article id="login">
                        <h1>Confirmar Email</h1>
                    </article>
                    <article>
                        <p id="email"><?=$_SESSION['email']?></p>
                    </article>
                    <br>
                    <article>
                        <label for="senha">Código de confirmação:</label> 
                        <input class="campo" type="number" name="cod" id="senha" placeholder="xxxxxx" minlength="6" maxlength="6" required onclick="ocutar()">
                        
                    </article>
                    <article id="logar">
                      <input type="submit" value="Verificar" id="enviar">
                    </article>
                </form>
            </article>
        </section>
    </main>
    <footer>
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