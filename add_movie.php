<?php
require 'db.php'; // Inclui o arquivo de conexão com o banco de dados

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber dados do formulário
    $nome = $_POST['filme'];
    $ano = $_POST['ano'];

    try {
        // Preparar a query de inserção
        $stmt = $pdo->prepare("INSERT INTO Filmes (Nome, Ano) VALUES (:nome, :ano)");
        // Bind dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':ano', $ano);
        
        // Executar a query
        if ($stmt->execute()) {
            echo "Filme cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o filme.";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar o filme: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>
