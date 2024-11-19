<?php
$host = 'localhost'; //Define o endereço do servidor do banco de dados -> LOCAL
$user = 'root';  //nome do usuário para acessar o banco de dados- ROOT É padrão do XAMPP
$pass = ''; //senha do usuário- vazio é padrão do xampp
$db = 'estoque'; // nome do banco de dados com o qual queremos nos conectar

//cria uma nova conexão com o banco de dados MySQL:
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) { //verifica se ocorreu algum erro durante a conexão 
    die("Conexão falhou: " . $conn->connect_error);
}

?>