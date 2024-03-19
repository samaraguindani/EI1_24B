<?php
// Executar uma consulta SQL
$query = "SELECT * FROM sua_tabela";
$result = pg_query($conn, $query);

// Verificar se a consulta foi bem sucedida
if (!$result) {
    echo "Erro ao executar a consulta.";
    exit;
}

// Exibir os resultados
while ($row = pg_fetch_assoc($result)) {
    echo "ID: " . $row['id'] . ", Nome: " . $row['nome'] . "<br>";
}

// Fechar a conexão
pg_close($conn);
?>
