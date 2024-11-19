<?php
    if(isset($_POST['submit'])) //verifica se o botão foi clicado e se os dados enviados estão corretos
    {
// Processando os Dados do Formulário:
        if ($_POST["login"] == "adm" && $_POST["senha"] == "123") { //compara se login e senha = ao digitado
            $_SESSION['usuario'] = $_POST['login']; //cria uma sessão armazenando informações do usuário
            header("Location: main.php"); //redireciona o usuário para a página "main.php"
            exit(); //interrompe o script
        } else {    //caso as credenciais estejam incorretas, redireciona o usuário para index.html
            header('location: ../index.html');
        }
    }
        

?>