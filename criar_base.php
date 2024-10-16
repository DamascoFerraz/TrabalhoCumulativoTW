<?php
$dsn = "127.0.0.1:3306";
$dbusername = "root";
$dbpassword = "123456";

//aqui conectei pelo msqli para criar o banco de dados, pois achei mais facil que o metodo PDO
//que já requisita o nome do banco de dados para fazer a conexão
$conection = new mysqli($dsn,$dbusername,$dbpassword);

//aqui utilizaremos um arquivo (criar_base.sql), ele é um script
//escrito em sql que basicamente cria toda a base do banco de dados
//necessario para a utilização do 'site'

//pega o conteudo do arquivo script sql e armazena em uma var
$sqlscript= file_get_contents('criar_base.sql');

//executa o script sql para criação da base de banco de dados
//  multi_query()
//      executa diversas linhas de codigo em uma sentada só (delicia)
//aqui automaticamente as funções retornam 0 e 1 dependendo se elas funcionaram ou não
//então armazenaremos o retorno em uma variavel para saber se ocorreu um erro inesperado
//ou se funcionou como o esperado
$worked = $conection->multi_query($sqlscript);

//dependendo se funcionou ou não, armazenaremos uma mensagem na variavel de retorno
if($worked){
    $return = 'Database_faltante_criada_com_sucesso_tente_novamente';
} else{
    $return = 'Falha_ao_criar_database_erro_inesperado';
};

//neste caso, a variavel $_GET, vai ser definida por oque tiver armazenado nessa variavel $return
header("Location: PAGES/index.php?return={$return}");