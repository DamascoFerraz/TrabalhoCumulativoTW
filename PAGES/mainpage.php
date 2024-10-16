<?php
    require_once "../PHP/conect_database.php";
    //checa se o usuario esta logado, senão, sai da pagina com mensagem
    if(!isset($_SESSION['user'])){
        header("Location:index.php?return=Faça_Login_antes_de_entrar");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="../CSS/mainpage.css">
</head>
<body>
    <header>
        <!-- Header de navegação -->
        <nav>
            <div class="container nav-container">
                <div class="logo">
                    <h1>MyHappyween</h1>
                </div>
                <div class="barra-pesquisa">
                    <input type="search" placeholder="Encontre Girininhos">
                </div>
                <div class="add-post">
                    <label for="add-post" class="btn">Feelings</label>
                    <div class="profile-pic">
                        <img src="../ASSETS/Pfp.jpg" alt="Foto de Perfil">
                    </div>
                    <!-- botão que leva o usuario a pagina php onde ele será deslogado -->
                    <button id="log_out_btn" class="btn" onclick="location.href = '../PHP/log_out.php'">Log-out</button>
                </div>
            </div>
        </nav>

    </header>

    <main>
        <div class="container">
            <!-- Profile, Menu, Botão de postar post -->
            <div class="left">
                <!-- Profile -->
                <a href="" class="profile">
                    <div class="profile-pic">
                        <img src="../ASSETS/Pfp.jpg" alt="Foto de Perfil">
                    </div>
                    <div class="profile-name">
                        <!-- nome do usuario e email mostrado por variavel armazenada na sessao -->
                        <h4><?php print($_SESSION['user']['username']); ?></h4>
                        <p class="text-name"> <?php print($_SESSION['user']['email']) ?></p>
                    </div>
                </a>

                <!-- Menu de Navegação -->
                <aside>
                    <a href="" class="menu-item">
                        <h3>Home</h3>
                    </a>
                    <a href="" class="menu-item">
                        <h3>Explorar</h3>
                    </a>
                    <a href="" class="menu-item">
                        <h3>Amigos</h3>
                    </a>
                    <a href="" class="menu-item">
                        <h3>Configurações</h3>
                    </a>
                </aside>
            </div>

            <!-- POstagens -->
            <div class="main">

            </div>

            <!-- Amizades -->
            <div class="right">

            </div>

        </div>
    </main>
</body>


</html>