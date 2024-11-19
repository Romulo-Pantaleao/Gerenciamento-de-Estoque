//O principal objetivo desse código é capturar os dados de um formulário com o ID "productForm",
//enviar esses dados para um servidor (especificamente para o arquivo PHP "process.php") e,
//ao receber uma resposta positiva do servidor, atualizar uma lista de produtos na página
document.getElementById('productForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const nome_produto = document.getElementById('nome_produto').value;
    const quantidade = document.getElementById('quantidade').value;
    const preco = document.getElementById('preco').value;

    const formData = new FormData();
    formData.append('nome_produto', nome_produto);
    formData.append('quantidade', quantidade);
    formData.append('preco', preco);

    fetch("../php/process.php", {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadProducts();
            }
        });
});

function loadProducts() {
    fetch('process.php?action=fetch')
        .then(response => response.json())
        .then(data => {
            console.log('Produtos carregados: ', data); // Verificar se os produtos estão sendo carregados corretamente
            const tbody = document.querySelector('#productTable tbody');
            tbody.innerHTML = '';

            data.forEach(product => {
                const row = document.createElement('tr');

                row.innerHTML = `
                <td>${product.id}</td>
                <td>${product.nome_produto}</td>
                <td>
                    <div>
                        <input type="number" id="quantidade-${product.id}" value="${product.quantidade}" min="0">
                        <button class="quantity_data" onclick="updateQuantidade(${product.id})">Atualizar Quantidade</button>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="number" step="0.01" id="preco-${product.id}" value="${product.preco}" min="0">
                        <button class="quantity_data" onclick="updatePreco(${product.id})">Atualizar Preço</button>
                    </div>
                </td>
                <td>
                <button class="deletar" onclick="deleteProduct(${product.id})">Deletar</button>
                </td>
            `;

                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar os produtos: ', error);
        });
}


//FAZ A REQUISIÇÃO DELETAR QUE SERÁ LIDA PELO PHP
function deleteProduct(id) {
    if (confirm("Tem certeza que deseja excluir este produto?")) { //CONFIRMA SE QUER DELETAR
      fetch('process.php?action=delete&id=' + id)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            loadProducts();
            alert("Produto excluído com sucesso!"); //CONFIRMA O DELETE
          } else {
            alert("Ocorreu um erro ao excluir o produto."); 
          }
        });
    }
  }

//FAZ A REQUISIÇÃO ATUALIZAR QUANTIDADE QUE SERÁ LIDA PELO PHP
function updateQuantidade(id) {
    const novaQuantidade = document.getElementById(`quantidade-${id}`).value;

    const formData = new FormData();
    formData.append('id', id);
    formData.append('quantidade', novaQuantidade);

    console.log('Enviando quantidade para atualizar: ', novaQuantidade);

    fetch('process.php?action=update_quantity', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta da atualização de quantidade: ', data);
        if (data.success) {
            loadProducts();
            alert("Quantidade alterada com sucesso!"); //CONFIRMA a ALTERAÇÃO
          } else {
            alert("Ocorreu um erro ao alterar a quantidade.");
        }
    });
}


//FAZ A REQUISIÇÃO ATUALIZAR PREÇO QUE SERÁ LIDA PELO PHP
function updatePreco(id) {
    const novoPreco = document.getElementById(`preco-${id}`).value;

    const formData = new FormData();
    formData.append('id', id);
    formData.append('preco', novoPreco);

    console.log('Enviando preço para atualizar: ', novoPreco);

    fetch('process.php?action=update_price', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta da atualização de preço: ', data);
        if (data.success) {
            loadProducts();
            alert("Preço alterado com sucesso!"); //CONFIRMA a ALTERAÇÃO
          } else {
            alert("Ocorreu um erro ao alterar o preço.");
        }
    });
}


window.onload = loadProducts;