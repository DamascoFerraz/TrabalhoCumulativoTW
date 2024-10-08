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
    if(isset($_GET['created_database'])){
        $created_database = $_GET['created_database'];
        echo "<script> var created_database = $created_database </script>";
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
            if(isset($created_database)){
                if($created_database){
                    echo("<h2>! MISSING DATABASE !<h2><hr>");
                    echo("<h3>modelo base do banco de dados criado automaticamente!</h3><br>");
                    echo("<img src='../ASSETS/database_created_icon.png' alt='databasecreatedicon'><br>");
                }else{
                    echo("<h2>! MISSING DATABASE !<h2><hr>");
                    echo("<h3>erro ao criar base de dados!</h3><br><p>favor informar erro ao manuseador de dados, contact:+55(35)99273-6703 [whatsapp]</p><br>");
                    echo("<img src='../ASSETS/database-error-icon.png' alt='databaseerroricon'>");
                };
                echo("<button onclick='modal.close();'>Fechar</button>");
            };
            ?>
        </dialog>
    <script>
        const modal = document.getElementById("db_created_dialog");
        if(typeof created_database != 'undefined'){
            modal.showModal();
        }
    </script>
</body>
</html>