<?php
    require_once "../PHP/conect_database.php";
    //checa se o usuario esta logado, senão, sai da pagina com mensagem
    if(!isset($_SESSION['user'])){
        header("Location:index.php?return=Faça_Login_antes_de_entrar");
    }
    if(isset($_GET['return'])){
        echo(str_replace("#","'","<script>var returne = #".$_GET['return']."#;</script>"));
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../CSS/mainpage.css">
</head>
<body>
    <header class="sticky-top">
        <!-- Header de navegação -->
        <nav>
            <div class=" nav-container">
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

    <main class="container-fluid h-100">
        <div class="row h-100">
            <!-- Profile, Menu, Botão de postar post -->
            <div class="left col-sm-3 sticky-left">
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
                <aside class="container">
                    <a href="" class="menu-item text-sm">
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
            

            <!-- Postagens -->
            <div class="main col-sm-6 overflow-y-scroll h-100">
                <div class="new-post-form form form-container sticky-top pt-3">

                    <form action="../PHP/create_post.php" method="post">
                        <label for="postcontent" class="form-label w-100">Noque você esta pensando?</label>
                        <input class="form-control w-100 mt-2" type="text" name="postcontent" id="inpt_post" autocomplete="off" required>
                        <button class="btn mt-3 mb-2" type="submit">novo post</button>
                    </form>

                </div>
                <!-- PHP para mostrar as postagens -->
                <?php
                    //coleta posts e armazena em um array
                    require_once "../PHP/collect_posts.php";

                    foreach($postsarray as $i){
                        //mostrar os posts
                        echo "<div class='container-fluid card bg-light-gray mb-3'>";

                            echo "<div class='post-user h5'>";
                                $query = "SELECT username FROM users where iduser=(?)";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute([$i['iduser']]);
                                $name_of_poster = $stmt->fetch(PDO::FETCH_ASSOC)['username'];
                                echo $name_of_poster.":";
                            echo "</div>";

                            echo "<div class='post-text '>";
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
                                echo '<div class="card bg-lighter-gray">';
                                foreach ($commentsarray as $ii){
                                    echo "<div class='post-coment justify-content-md-center row'>";
                                    
                                    echo "<span class='post-coment-author col-md-auto'>";
                                    $query = "SELECT username FROM users where iduser=(?)";
                                    $stmt = $pdo->prepare($query);
                                            $stmt->execute([$ii['iduser']]);
                                            $name_of_poster = $stmt->fetch(PDO::FETCH_ASSOC)['username'];
                                            echo ">".$name_of_poster.": ";
                                        echo"</span>";

                                        echo "<span class='post-coment-content col'>".$ii['commentcontent']."</span>";

                                        echo "<span class='post-coment-time text-right col-sm-auto'> (".$ii['createdat'].")</span>";
                                        
                                        echo "</div>";
                                    }
                                    $_SESSION['this_post'] = NULL;
                                echo '</div>';
                            }
                        echo "</div>";

                        $commentsarray = NULL;
                        $_SESSION['this_post'] = NULL;
                    }
                ?>
            </div>

            <!-- Amizades -->
            <div class="right col-sm-3">

            </div>

        </div>
    </main>

    <!-- MENSAGENS/ALERTAS -->
    <dialog id="return_dialog" class="container toast show ">
        <div  class="toast-dialog-centered">
            <div class="toast-content ">
                
            <div class="toast-header mt-3">
                <h4>message</h4>
            </div>

            <div class="toast-body  ">
                <?php
                if(isset($_GET['return'])){
                    echo(str_replace("_","&nbsp","{$_GET['return']}"));
                }
                ?>
            </div>
            
            <div class="toast-footer ">    
                <button class='btn btn-danger mb-3' onclick='modal.close()'>Fechar</button>
            </div>

            </div>
        </div>
    </dialog>
        <!-- SCRIPT PARA MOSTRAR O DIALOG -->
        <script type="text/javascript">
        const modal = document.getElementById("return_dialog");
        if(typeof returne != 'undefined'){
            modal.showModal();
        }
        </script>
</body>


</html>