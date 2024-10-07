<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){              // checa se o usuario entrou na pagina atraves do envio de form

        $name = htmlspecialchars($_POST['name']);           // extrai o valor postado no formulario e bota em var
        $pwd = htmlspecialchars($_POST['pwd']);
        $email = htmlspecialchars($_POST['email']);

        if (empty($name) or empty($pwd)){                   // checa se o valor postado no form foi vazio 
            header("Location :../PAGES/index.php");         // coloca como proxima pagina o index
            exit();                                         // sai da pagina php e vai para onde esta definido o header
        }

        require_once "conect_database.php";                 //utiliza uma vez o arquivo php (criando o arquivo PDO conectando a database)
        
        $checkemail="SELECT COUNT(*) from users where email=(?); "; // cria uma string em sql com um parametro a ser definido

        $stmt = $pdo->prepare($checkemail); // deixa a string preparada no obj do db
        $stmt->execute([$email]); //executa a linha sql usando o parametro sendo definido pela variavel

        $num = $stmt->fetchColumn(); //extrai o valor da coluna selecionada e armazena numa variavel

        if ($num==0){
            $stmt = Null;

            $query = "INSERT INTO users(username,pwd,email) VALUES (?,?,?)"; //cria query sql com valores a ser definidos ("?")
            $stmt = $pdo->prepare($query); //prepara a consulta SQL para execução
            $stmt->execute([$name,$pwd,$email]); //executa consulta com os valores
        
            $pdo = Null; // reseta as variaveis de consulta
            $stmt = Null;
            $checkemail = Null;
            
            header("Location:../PAGES/index.php");
            exit();
        } else {
            echo("usuario com este email ja existe >:( <br>voltando para pagina de login...");
        }
        
    } else {
        header("Location:../PAGES/index.php");
        exit();
    }
?>

<script>
    setTimeout(function() {
        window.location.href = "../PAGES/index.php";
    }, 3000);
</script>