<?php
// Conectar ao banco de dados SQLite
$database = new SQLite3('agenda_db.db');
if (!$database) {
    die("Erro ao conectar ao banco de dados.");
}
?>
