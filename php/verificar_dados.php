<?php
// Incluir o arquivo de conexão com o banco de dados
require_once('db_connection.php');
require_once('query_exec.php');

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Chama a função para inserir os dados na agenda
//     inserirAgenda();
// }

//Função para criar a tabela e inserir dados (se necessário)
// criarTabela();
// inserirCategorias();
// inserirAgenda();

// Recuperar os dados da agenda com categorias
$resultado = recuperarDadosAgenda();

// Verificar se houve resultados
if ($resultado) {
    // Iterar sobre os resultados e exibir os dados
    while ($row = $resultado->fetchArray()) {
        echo "ID: " . $row['id'] . ", Título: " . $row['titulo'] . ", Descrição: " . $row['descricao'] . ", Data: " . $row['data'] . ", Categoria: " . $row['categoria'] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fechar a conexão com o banco de dados (opcional)
$database->close();
?>
