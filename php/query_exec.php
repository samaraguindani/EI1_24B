<?php
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inserir dados na agenda
    inserirAgenda();
}
function inserirAgenda() {
    global $database;

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $categoria_id = $_POST['categoria_id'];

    $query = "INSERT INTO agenda (titulo, descricao, data, categoria_id) 
              VALUES (:titulo, :descricao, :data, :categoria_id)";

    // Preparar a declaração SQL
    $stmt = $database->prepare($query);

    // Vincular os parâmetros
    $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
    $stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);
    $stmt->bindValue(':data', $data, SQLITE3_TEXT);
    $stmt->bindValue(':categoria_id', $categoria_id, SQLITE3_INTEGER);

    $resultado = $stmt->execute();

    if ($resultado) {
        echo "Dados inseridos com sucesso na tabela agenda.";
    } else {
        echo "Erro ao inserir dados na tabela agenda.";
    }
}
function recuperarDadosAgenda() {
    global $database;

    $query = "SELECT /*agenda.id,*/ agenda.titulo, agenda.descricao, agenda.data, categorias.nome AS categoria 
              FROM agenda 
              INNER JOIN categorias ON agenda.categoria_id = categorias.id";

    $resultado = $database->query($query);
    return $resultado;
}

// criarTabela();
// inserirCategorias();
// inserirAgenda();
// recuperarDadosAgenda();
// echo "teste5";

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
