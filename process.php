<?php
include 'conexão.php';

// ADICIONAR PRODUTOS:
//verifica-se se o método da requisição é POST == dados sendo enviados p/ servidor via formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['action'])) {
    $nome_produto = $_POST['nome_produto']; //Obtém o valor campo "nome_produto" do formulário HTML e armazena na variável $nome_produto
    $quantidade = $_POST['quantidade']; //Obtém o valor do campo "quantidade" do formulário HTML e armazena na variável $quantidade
    $preco = $_POST['preco']; //Obtém o valor do campo "preco" do formulário HTML e armazena na variável $preco

    // Verifique se todos os dados necessários estão presentes
    if (!isset($nome_produto, $quantidade, $preco)) {
        echo json_encode(['success' => false, 'error' => 'Dados insuficientes para adicionar produto.']);
        exit; //Interrompe a execução do script
    }
    // Insere os Produtos:
// Prepara uma consulta SQL para inserir um novo registro na tabela "produtos"
// os pontos ??? são marcadores de parâmetros que serão substituídos pelos valores reais
    $stmt = $conn->prepare("INSERT INTO produtos (nome_produto, quantidade, preco) VALUES (?, ?, ?)");
//Associa os valores das variáveis PHP aos marcadores de parâmetro da consulta SQL
    $stmt->bind_param("sid", $nome_produto, $quantidade, $preco); // sid = string, inteiro, decimal
    $stmt->execute(); 

    echo json_encode(['success' => true]);
    exit;
}

// LISTAR PRODUTOS
//trás a lista dos produtos que estão registrados no banco de dados
if (isset($_GET['action']) && $_GET['action'] == 'fetch') { 
    $result = $conn->query("SELECT * FROM produtos"); //Executa a consulta SQL e seleciona todas as colunas de uma tabela chamada produtos
    $products = [];
//
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
    exit;
}


// DELETAR PRODUTO:
//Verifica se a requisição contém um parâmetro action com o valor 'delete', indicando que a intenção é deletar um produto;
//Verifica se o parâmetro id está presente, pois é necessário para identificar qual produto será deletado
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id']; // extração e armazenamento do parâmetro id na variável $id
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?"); //faz 1 consulta sql p/ deletar um produto de acordo com o id
    $stmt->bind_param("i", $id); //associa ? ao id
    $stmt->execute(); //consulta preparada é executada, efetivando a exclusão do registro no banco de dados

    echo json_encode(['success' => true]);
    exit;
}

// Atualizar quantidade
//verifica a requisição da ação de atualizar quantidade
if (isset($_GET['action']) && $_GET['action'] == 'update_quantity') {
    $id = $_POST['id']; //Obtém o ID do produto a ser atualizado
    $quantidade = $_POST['quantidade']; //obtém a nova quantidade do produto a partir do parâmetro quantidade enviado via POST
//Verifica se o ID e a quantidade foram fornecidos
    if (empty($id) || empty($quantidade)) {
        echo json_encode(['success' => false, 'error' => 'ID ou quantidade não fornecida']);
        exit;
    }

// Prepara a consulta SQL para atualizar a 'quantidade' na tabela 'produtos'
    $stmt = $conn->prepare("UPDATE produtos SET quantidade = ? WHERE id = ?"); //? = marcadores de posição que serão substituídos pelos valores

    $stmt->bind_param("ii", $quantidade, $id); //associa valores inteiros a nova quantidade e ao id
//verifica o sucesso ou falha na execução da atualização da quantidade
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
//fecha e interrompe o script
    $stmt->close();
    exit;
}


// Atualizar preço
//verifica a requisição da ação de atualizar preço
if (isset($_GET['action']) && $_GET['action'] == 'update_price') {
    $id = $_POST['id']; //Obtém o ID do preço a ser atualizado
    $preco = $_POST['preco']; //obtém o novo preço do produto a partir do parâmetro preço enviado via POST
//Verifica se o ID e o preço foram fornecidos
    if (empty($id) || empty($preco)) {
        echo json_encode(['success' => false, 'error' => 'ID ou preço não fornecido']);
        exit;
    }
// Prepara a consulta SQL para atualizar o 'preço' na tabela 'produtos'
    $stmt = $conn->prepare("UPDATE produtos SET preco = ? WHERE id = ?");
    $stmt->bind_param("di", $preco, $id); // associa 'd'(decimal) p/ preço, 'i'(inteiro) p/ id
    
//verifica o sucesso ou falha na execução da atualização do preço
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
//fecha e interrompe o script
    $stmt->close();
    exit;
}
    
    ?>
