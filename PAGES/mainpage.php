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

            <!-- Postagens -->
            <div class="main">

                <!-- PHP para mostrar as postagens -->
                <?php
                    //coleta posts e armazena em um array
                    require_once "../PHP/collect_posts.php";

                    foreach($postsarray as $i){
                        //mostrar os posts
                        echo "<div class='post'>";

                            echo "<div class='post-user'>";
                                $query = "SELECT username FROM users where iduser=(?)";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute([$i['iduser']]);
                                $name_of_poster = $stmt->fetch(PDO::FETCH_ASSOC)['username'];
                                echo $name_of_poster.":";
                            echo "</div>";

                            echo "<div class='post-text'>";
                                echo $i['postcontent'];
                            echo "</div>";

                            echo "<span class='posts-likes'>";
                                $query = "SELECT * FROM likes where idlikedpost=(?)";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute([$i['idpost']]);
                                echo "Likes:".$stmt->rowCount();
                                
                                //botão para curtir
                                echo '<button class="btn" onclick="location.href=\'../PHP/like_post.php?post='.$i['idpost'].'\'">like</button>';

                            echo " </span>";

                            echo "<span class='post-time'> (";
                                echo $i['createdat'];
                            echo ")</span>";

                            //coleta id do post e cria array de comentarios do mesmo
                            $_SESSION['this_post'] = $i['idpost'];
                            require "../PHP/collect_comments.php";
                            echo "<span style='display:none;'>".$i['idpost']."</span>";

                            // form para comentar
                            echo '<div class="new-coment-form">';
                                echo '<form action="../PHP/create_coment.php" method="post">';
                                    echo '<label for="comentcontent">comentar:</label>';
                                    echo '<input class="input-novo-comentario" type="text" name="comentcontent" id="inpt_coment" autocomplete="off" required>';
                                    echo '<input style="display:none;" type="number" name="comentid" id="inpt_coment_id" value='.$i['idpost'].' required>';
                                echo '<button class="btn" type="submit">comentar</button>';
                                echo '</form>';
                            echo '</div>';

                            // printar comentarios
                            if($commentsarray!=array()){
                                foreach ($commentsarray as $ii){
                                    echo "<div class='post-coment'>";

                                        echo "<span class='post-coment-author'>";
                                            $query = "SELECT username FROM users where iduser=(?)";
                                            $stmt = $pdo->prepare($query);
                                            $stmt->execute([$ii['iduser']]);
                                            $name_of_poster = $stmt->fetch(PDO::FETCH_ASSOC)['username'];
                                            echo ">".$name_of_poster.": ";
                                        echo"</span>";

                                        echo "<span class='post-coment-content'>".$ii['commentcontent']."</span>";

                                        echo "<span class='post-coment-time'> (".$ii['createdat'].")</span>";

                                    echo "</div>";
                                }
                                $_SESSION['this_post'] = NULL;
                            }
                        echo "</div>";

                        echo "---------------------------";
                        $commentsarray = NULL;
                        $_SESSION['this_post'] = NULL;
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