<?php
$host = "localhost";
$port = "5432";
$dbname = "seu_banco_de_dados";
$user = "seu_usuario";
$password = "sua_senha";

// Conexão com o PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificar se a conexão foi bem sucedida
if (!$conn) {
    echo "Erro ao conectar ao banco de dados.";
    exit;
}
?>
