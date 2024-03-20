<?php
// Incluir o arquivo de conexão com o banco de dados
require_once('db_connection.php');

// Inserir os dados na tabela
// (Código para inserir dados aqui)

// Executar uma consulta SELECT para recuperar os dados inseridos
$query = "SELECT * FROM agenda";

// Executar a consulta
$resultado = $database->query($query);

// Verificar se houve resultados
if ($resultado) {
    // Iterar sobre os resultados e exibir os dados
    while ($row = $resultado->fetchArray()) {
        echo "ID: " . $row['id'] . ", Nome: " . $row['nome'] . ", Email: " . $row['email'] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fechar a conexão com o banco de dados (opcional)
$database->close();
?>
