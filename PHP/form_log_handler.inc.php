<?php
// checa se o usuario entrou na pagina atraves do envio de form
if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    //retorna a pagina principal com mensagem de acesso negado
    header("Location:../PAGES/index.php?return=Acesso_negado");
    exit();
}

//tudo abaixo sera executado apenas se o usuario acessou esta pagina
//atraves de um formulario e do metodo POST

//adiquirindo as informações enviadas no formulario e armazenando em var
//  htmlspecialchars();
//      metodo de conversão de strings para caracteres especiais em html exemplo: "&nbsp" (espaço vazio).
//      usado para segurança, assim impedindo o usuario executar comandos php neste arquivo
$email = htmlspecialchars($_POST['email']);
$pwd = htmlspecialchars($_POST['pwd']);

//checando se o valor postado no form foi vazio 
//  empty()
//      função checa se a variavel tem um valor vazio como ""
//      retorna 1 (true) se sim, e 0 (False) se não
if (empty($email) or empty($pwd)){
    header("Location :../PAGES/index.php?return=Campo_nao_preenchido");
    exit();
}

//utiliza uma vez o arquivo php (criando conexão PDO a database, visite o arquivo para mais informações)
require_once "conect_database.php";

//criando uma linha de codigo sql e armazendando em uma variavel string
//  (?)
//      deixa que tal parte seja definida mais tarde (veja prepare e execute abaixo...)
$query = "SELECT * FROM users where email=(?);";
//preparando a declaração de codigo
//  prepare()
//      prepara a linha de codigo para ser executada
$stmt = $pdo->prepare($query);
//executando o codigo
//  execute()
//      executa a consulta substituindo os "?" pela variavel inserida na função
$stmt->execute([$email]);

//checando se o email inserido não existe no sistema
//  rowCount()
//      checa quantas linhas (registros) tem no output da declaração
if ($stmt->rowCount()==0){
    header("Location:../PAGES/index.php?return=Email_nao_cadastrado");
    exit();
}

//tudo abaixo sera executado apenas se houver um registro com o email inserido pelo usuario

//fazendo uma pesquisa no output da declaração para extrair as informações e credenciais e assim,
//comparar com as inseridas pelo usuario
//  fetch()
//      do ingles "pesquisa/consulta" pega os registros do output e armazena
//      em um array (numerico, associativo, ou ambos)
//  fetch(PDO::FETCH_ASSOC)
//      define que o tipo de array que queremos é associativo
//      os nomes de cada elemento é com base no banco de dados em si
$returned_user = $stmt->fetch(PDO::FETCH_ASSOC); //faz pesquisa (fetch) na consulta armazenando numa var de array associativo

//checa se a senha armazenada no banco de dados é diferente da senha inserida pelo usuario
if($returned_user['pwd']!=$pwd){
    header("Location:../PAGES/index.php?return=Senha_incorreta");
    exit();
}

//tudo abaixo sera executado apenas se o usuario inseriu a senha correta da conta que ele quer acessar

//através da sessao (iniciada quando requisitamos a conexão do banco de dados)
//armazenamos as informações do usuario cadastrado a sessão
$_SESSION['user'] = $returned_user;

//por fim, acessamos a pagina principal do site
header("Location:../PAGES/mainpage.php");