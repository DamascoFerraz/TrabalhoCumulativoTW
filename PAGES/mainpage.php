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

            <!-- criar postagem -->
            <div class="new-post-form">
                <form action="../PHP/create_post.php" method="post">
                    <label for="postcontent">Noque você esta pensando?</label>
                    <input class="input-novo-post" type="text" name="postcontent" id="inpt_post" autocomplete="off" required>
                    <button class="btn" type="submit">novo post</button>
                </form>
            </div>

            <!-- POstagens -->
            <div class="main">
            <?php
            require_once "../PHP/collect_posts.php";

            foreach($postsarray as $i){
                echo "<div class='post'>";
                    echo "<div class='post-user'>";
                        $query = "SELECT username FROM users where iduser=(?)";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$i['iduser']]);
                        $name_of_poster = $stmt->fetch(PDO::FETCH_ASSOC)['username'];
                        echo $name_of_poster;
                    echo "</div>";
                    echo "<div class='post-text'>";
                        echo $i['postcontent'];
                    echo "</div>";
                    echo "<div class='posts-likes'>";
                        $query = "SELECT * FROM likes where idlikedpost=(?)";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$i['idpost']]);
                        echo "Likes:".$stmt->rowCount();
                    echo "</div>";
                    echo "<div class='post-time'>";
                        echo $i['createdat'];
                    echo "</div>";
                    echo "<span style='display:none;'>".$i['idpost']."</span>";
                echo "</div>";
                echo "---------------------------";
            }


            ?>
            </div>

            <!-- Amizades -->
            <div class="right">

            </div>

        </div>
    </main>
</body>


</html>