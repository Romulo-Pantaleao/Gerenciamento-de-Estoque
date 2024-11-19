<?php
    session_start(); //inicia a sessão
    unset ($_SESSION['login']); //Estas linhas removem as variáveis login e senha da sessão atual.
    unset ($_SESSION['senha']); //isso significa que qualquer informação armazenada nessas variáveis será perdida.
    session_destroy(); //para destruir completamente a sessão.
    header('location:../index.html'); //redireciona o usuário para a página ../index.html.
    exit(); //interrompe a execução do script php
?>