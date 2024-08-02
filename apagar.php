<?php
require 'db.php'; // Inclui o arquivo de conexão com o banco de dados

// Verificar se foi passado o ID do filme a ser apagado
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Prepare a SQL statement para apagar o filme
        $stmt = $pdo->prepare("DELETE FROM Filme WHERE ID = :id");
        // Bind o ID para a query
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Executa a query
        if ($stmt->execute()) {
            echo "Filme apagado com sucesso!";
        } else {
            echo "Erro ao apagar o filme.";
        }
    } catch (PDOException $e) {
        echo "Erro ao apagar o filme: " . $e->getMessage();
    }
} else {
    echo "ID do filme não especificado.";
}
?>
