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
        if(isset($_GET['return'])){
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
            <input type="text" name="pwd" id="inp-pwd-login" required><br>

            <button type="submit">Log in</button>
        </form>
        <!-- form de criação de conta -->
        <form action="../PHP/form_sing_handler.inc.php" method="POST">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="inp-name-singin" required> <br>

            <label for="pwd">Senha:</label>
            <input type="text" name="pwd" id="inp-pwd-singin" required> <br>

            <label for="email">E-mail:</label>
            <input type="text" name="email" id="inp-email-singin" required>

            <button type="submit">Sing in</button>
        </form>
    </nav>
    
    <!-- DIALOG COM MENSAGEM DE RETORNO DAS PAGINAS PHP -->
        <dialog id="return_dialog" class="modal">
            <?php
            // invoca elementos html com conteudo dependendo da variavel de retorno
            if(isset($_GET['return'])){
                switch ($_GET['return']){
                    case 'created_database':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>Missing database created</h3>";
                        echo '<img style="height: 80px;" src="../ASSETS/database_created_icon.png" alt="db created icon">';
                        break;
                    case 'fail_creating_database':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>Missing database!</h3>";
                        echo "<p>fail to create database</p>";
                        echo '<img style="height: 80px;" src="../ASSETS/database-error-icon.png" alt="db error icon">';
                        break;
                    case 'user_created':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>usuario cadastrado com sucesso</h3>";
                        break;
                    case 'user_exists':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>e-mail ja cadastrado</h3>";
                        break;
                    case 'empty_data':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>credenciais faltantes</h3>";
                        break;
                    case 'acces_denied':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>acesso recusado!</h3>";
                        break;
                }
                echo "<hr><button onclick='modal.close()'>Fechar</button>";
            };
            ?>
        </dialog>

    <!-- SCRIPT PARA MOSTRAR O DIALOG -->
    <script>
        const modal = document.getElementById("return_dialog");
        if(typeof returne != 'undefined'){
            modal.showModal();
        }
    </script>
</body>
</html>