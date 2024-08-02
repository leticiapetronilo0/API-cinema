<?php
require 'db.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['filme'];
    $ano = $_POST['ano'];
    
    try {
        // Prepare a SQL statement para inserir um novo filme
        $stmt = $pdo->prepare("INSERT INTO Filme (Nome, Ano) VALUES (:nome, :ano)");
        // Bind os parâmetros
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
        
        // Executa a query
        if ($stmt->execute()) {
            echo "Filme adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar o filme.";
        }
    } catch (PDOException $e) {
        echo "Erro ao adicionar o filme: " . $e->getMessage();
    }
} else {
    echo "Método não permitido.";
}
?>
