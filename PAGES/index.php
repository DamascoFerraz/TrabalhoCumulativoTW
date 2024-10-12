<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

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
        <form action="../PHP/form_log_handler.inc.php" method="post">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="inp-email-login" required><br>

            <label for="pwd">Senha:</label>
            <input type="text" name="pwd" id="inp-pwd-login" required><br>

            <button type="submit">Log in</button>
        </form>
        
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
    
        <dialog id="db_created_dialog">
            <?php
            if(isset($_GET['return'])){
                switch ($_GET['return']){
                    case 'created_database':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>Missing database created</h3>";
                        break;
                    case 'user_created':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>usuario cadastrado com sucesso</h3>";
                        break;
                    case 'user_exists':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>e-mail ja cadastrado</h3>";
                        break;
                    case 'acces_denied':
                        echo "<h2>message</h2><hr>";
                        echo "<h3>acesso recusado!</h3>";
                        break;
                }
                echo "<button onclick='modal.close()'>fechar</button>";
            };
            ?>
        </dialog>
    <script>
        const modal = document.getElementById("db_created_dialog");
        if(typeof returne != 'undefined'){
            modal.showModal();
        }
    </script>
</body>
</html>