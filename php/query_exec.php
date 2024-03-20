<?php
// Incluir o arquivo de conexão com o banco de dados
require_once('db_connection.php');

// Função para criar uma tabela
function criarTabela() {
    global $database;
    
    $query_agenda = "CREATE TABLE IF NOT EXISTS agenda (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo TEXT NOT NULL,
        descricao TEXT,
        data DATE NOT NULL,
        categoria_id INTEGER
    )";

    // Executar a query para criar a tabela agenda
    $database->exec($query_agenda);

    $query_categorias = "CREATE TABLE IF NOT EXISTS categorias (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT UNIQUE
    )";

    // Executar a query para criar a tabela categorias
    $database->exec($query_categorias);
}
// Função para inserir dados na tabela categorias
function inserirCategorias() {
    global $database;

    // Query para inserir dados na tabela categorias
    $query = "INSERT OR IGNORE INTO categorias (nome) VALUES 
                ('Trabalho'),
                ('Estudo'),
                ('Lazer')";

    // Executar a query para inserir dados na tabela categorias
    $database->exec($query);
}

// Função para inserir dados na tabela agenda
function inserirAgenda() {
    global $database;

    // Query para inserir dados na tabela agenda
    $query = "INSERT INTO agenda (titulo, descricao, data, categoria_id) 
                VALUES ('Reunião de Projeto', 'Discutir o progresso do projeto X', '2024-03-20', 1)";

    // Executar a query para inserir dados na tabela agenda
    $database->exec($query);
}

// Função para recuperar os dados da agenda com categorias
function recuperarDadosAgenda() {
    global $database;

    // Query para recuperar os dados da agenda com categorias
    $query = "SELECT agenda.id, agenda.titulo, agenda.descricao, agenda.data, categorias.nome AS categoria 
                FROM agenda 
                INNER JOIN categorias ON agenda.categoria_id = categorias.id";

    // Executar a query e obter resultados
    $resultado = $database->query($query);

    // Retornar resultados
    return $resultado;
}

// // Função para atualizar dados
// function atualizarDados() {
//     global $database;

//     // Query para atualizar dados
//     $query = "UPDATE usuarios SET email = 'novoemail@example.com' WHERE id = 1";

//     // Executar a query
//     $database->exec($query);
// }

// // Função para excluir dados
// function excluirDados() {
//     global $database;

//     // Query para excluir dados
//     $query = "DELETE FROM usuarios WHERE id = 1";

//     // Executar a query
//     $database->exec($query);
// }
?>
