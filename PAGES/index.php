<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['user'])){
            header("Location:mainpage.php");
            exit;
        }

        if(isset($_GET['return'])){
            echo(str_replace("#","'","<script>var returne = #".$_GET['return']."#;</script>"));
        }
    ?>

    <!-- Header responsivo com Bootstrap -->
    <header>
        <nav class='navbar navbar-expand-lg'>
            <div>
                <a id='navbarlink' href="#">MyHappyween</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Sobre nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="mainpage.php">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contato.php">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Formulários responsivos -->
    <div class="container mt-5">
        <div class="row">
            <!-- Form de login -->
            <div class="col-md-6 mb-4">
                <div class="card p-4">
                    <nav class='form-containe'>
                    <form action="../PHP/form_log_handler.inc.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="text" class="form-control" name="email" id="inp-email-login" required>
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Senha:</label>
                            <input type="password" class="form-control" name="pwd" id="inp-pwd-login" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Log in</button>
                    </form>
    </nav>
                </div>
            </div>
            
            <!-- Form de criação de conta -->
            <div class="col-md-6 mb-4">
                <div class="card p-4">
                    <nav class='form-container'>
                    <form class='forms' action="../PHP/form_sing_handler.inc.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" class="form-control" name="name" id="inp-name-singin" required>
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Senha:</label>
                            <input type="password" class="form-control" name="pwd" id="inp-pwd-singin" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="text" class="form-control" name="email" id="inp-email-singin" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Sing in</button>
                    </form>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- DIALOG COM MENSAGEM DE RETORNO -->
    <dialog id="return_dialog" class="modal">
        <?php
            if(isset($_GET['return'])){
                echo "<h2>message</h2><hr>";
                echo(str_replace("_","&nbsp","{$_GET['return']}"));
                echo "<hr><button class='btn btn-danger' onclick='modal.close()'>Fechar</button>";
            }
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
