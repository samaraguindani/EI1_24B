<?php

$database = new SQLite3('agenda_db.db');

if (!$database) {
    die("Erro ao conectar ao banco de dados.");
}

function criarTabela() {
    global $database;
    
    $query_agenda = "CREATE TABLE IF NOT EXISTS agenda (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo TEXT NOT NULL,
        descricao TEXT,
        data DATE NOT NULL,
        categoria_id INTEGER
    )";

    $database->exec($query_agenda);

    $query_categorias = "CREATE TABLE IF NOT EXISTS categorias (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT UNIQUE
    )";

    $database->exec($query_categorias);
}
function inserirCategorias() {
    global $database;

    $query = "INSERT OR IGNORE INTO categorias (nome) VALUES 
                ('Trabalho'),
                ('Estudo'),
                ('Lazer')";

    $database->exec($query);
}

?>
