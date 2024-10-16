<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <!-- transferencia de variavel php para variavel js -->
    <?php
        session_start();
        //checa se o usuario ja esta logado, se sim, entra na pagina principal
        if(isset($_SESSION['user'])){
            header("Location:mainpage.php");
            exit;
        }

        //checa se tem uma mensagem de retorno
        //  aqui utilizamos variavel $_GET que é inserida no url
        //      exemplo:                url.com?[nome da var]=[valor da var]
        //                              (var fica salva como $_GET['nome da var'])
        //      exemplo do projeto:     index.php?return=Campo_nao_preenchido
        //                              (var fica salva como $_GET['return'])
        if(isset($_GET['return'])){
            //metodo para transfirir a tal mensagem de retorno em uma variavel js
            // o codigo abaixo escreve:
            //      <script> var returne = 'mensagem de retorno'; </script>
            //                              ^~~~~~~~~~~~~~~~~~~^-> definida pela var php $_GET['return']
            echo(str_replace("#","'","<script>var returne = #".$_GET['return']."#;</script>"));
        }
    ?>

    <header>
        <nav>
        <h1>MyHappyween</h1>
        <br>
            <a href="index.php">Sobre nós</a>
            <a href="mainpage.php">Posts</a>
            <a href="contato.php">Contato</a>
        </nav>
    </header>

    <nav class="form-container">
        <!-- form de login -->
        <form action="../PHP/form_log_handler.inc.php" method="post">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="inp-email-login" required><br>

            <label for="pwd">Senha:</label>
            <input type="password" name="pwd" id="inp-pwd-login" required><br>

            <button type="submit">Log in</button>
        </form>
        <!-- form de criação de conta -->
        <form action="../PHP/form_sing_handler.inc.php" method="POST">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="inp-name-singin" required> <br>

            <label for="pwd">Senha:</label>
            <input type="password" name="pwd" id="inp-pwd-singin" required> <br>

            <label for="email">E-mail:</label>
            <input type="text" name="email" id="inp-email-singin" required>

            <button type="submit">Sing in</button>
        </form>
    </nav>
    
    <!-- DIALOG COM MENSAGEM DE RETORNO DAS PAGINAS PHP -->
        <dialog id="return_dialog" class="modal">
            <?php
            if(isset($_GET['return'])){
                // invoca elementos html com conteudo da variavel de retorno (substituindo underlines '_' por espaços)
                echo "<h2>message</h2><hr>";
                echo(str_replace("_","&nbsp","{$_GET['return']}"));
                echo "<hr><button onclick='modal.close()'>Fechar</button>";
            };
            ?>
        </dialog>

    <!-- SCRIPT PARA MOSTRAR O DIALOG -->
    <script>
        const modal = document.getElementById("return_dialog");
        // se existir uma mensagem de retorno, exibe o dialogo/modal
        if(typeof returne != 'undefined'){
            modal.showModal();
        }
    </script>
</body>
</html>