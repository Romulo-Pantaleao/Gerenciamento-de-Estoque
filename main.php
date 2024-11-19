<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Estoque</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div>
        <a class="sair" href="logoff.php">Sair</a> <!--ancorando um link no Botão de SAIR que redireciona para logoff.php-->

        <h1>Mercadinho do Seu Chico</h1> 
        <h1>Sistema de Gerenciamento de Estoque</h1>
    </div>


<!--Formulário de Cadastro dos Produtos-->
    <form id="productForm"> <!--id="productForm": Atribui um id único ao formulário, permitindo que ele seja manipulado por JS-->
        <input type="text" id="nome_produto" placeholder="Nome do Produto" required> <!--id permite q seja referenciado em JavaScript-->
<!--placeholder= texto cinza dentro do campo, indicando o que o usuário deve digitar-->
        <input type="number" id="quantidade" placeholder="Quantidade" required>
        <input type="number" step="0.01" id="preco" placeholder="Preço" required>
<!--step="0.01": é para permitir que o usuário digite valores com duas casas decimais-->
        <button class="quantity_data" type="submit">Adicionar Produto</button> <!--Botão para adicionar os Produtos-->
    </form>

<!--Tabela que Lista os Produtos Cadastrados-->
<table id="productTable"> <!--id="productTable": Atribui um id único ao formulário, permitindo que ele seja manipulado por JS-->
        <thead> <!--Define um cabeçalho na tabela -->
            <tr> <!--Define uma linha na tabela
                th= Define uma célula de cabeçalho de coluna-->
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Define o corpo da tabela, onde as linhas de dados serão inseridas -->
        </tbody>
    </table>

    <script src="../js/script.js"></script> <!--Conexão com o javaScript-->

</body>

</html>