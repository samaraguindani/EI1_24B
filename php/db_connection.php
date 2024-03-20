<?php
$host = "localhost";
$port = "5432";
$dbname = "agenda_db";
$user = "postgres";
$password = "postgres";

// Conexão com o PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificar se a conexão foi bem sucedida
if (!$conn) {
    echo "Erro ao conectar ao banco de dados.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $categoria_id = $_POST['categoria_id']; // Agora estamos recebendo o ID da categoria

    $query = "INSERT INTO agenda (titulo, descricao, data, categoria_id) VALUES ('$titulo', '$descricao', '$data', $categoria_id)";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Evento salvo com sucesso!";
    } else {
        echo "Erro ao salvar o evento.";
    }
}
?>