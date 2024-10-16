<?php
    //conecta a sessão
    session_start();
    //esvazia tudo armazenado na sessão
    unset($_SESSION);
    //destrói a sessão
    session_destroy();
    //retorna a pagina de log in
    header("Location: ../PAGES/index.php?return=Deslogado_com_sucesso");
    die;
?>