<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
<!-- RETIRE O SCRIPT ABAIXO DEPOIS DA PAGINA ESTAR PRONTA -->
<?php
    header("Location:../PAGES/index.php?return=Acesso_negado");
    exit;
    ?>
<!-- RETIRE O SCRIPT ACIMA DEPOIS DA PAGINA ESTAR PRONTA -->
<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->


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
<!------------------------------------------- Header de navegação--------------------------------------------->
    <header class="sticky-top">
        <nav>
            <div class=" nav-container">
                <div class="logo">
                    <h1>MyHappyween</h1>
                </div>
                <div class="barra-pesquisa">
                    <input type="search" placeholder="Encontre Girininhos">
                </div>
                <div class="add-post">
                    <label for="add-post" class="btn">Amigos</label>
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

<!------------------------------------------- Left ------------------------------------------->
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
                    <a href="mainpage.php" class="menu-item text-sm">
                        <h3>Home</h3>
                    </a>
                    <a href="" class="menu-item">
                        <h3>Explorar</h3>
                    </a>
                    <a href="" class="menu-item">
                        <h3>Amigos</h3>
                    </a>
                    <a href="" class="menu-item">
                        <h3><a href="configpage.php">Configurações</a></h3>
                    </a>
                </aside>
            </div>

                <!-- criar postagem -->
                

<!------------------------------------------- Main page ------------------------------------------->
            <div class="main col-sm-6 overflow-y-scroll h-100">

            </div>

<!----------------------------------------------------- right ----------------------------------------------------->
            <div class="right col-sm-3">

            </div>
        </div>
    </main>

<!--/////////////////////////////////////////////////ALERTS MESSAGES//////////////////////////////////////////////////////////////-->
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