<?php
header('Content-Type: application/json');

// Verifica o método da requisição
$method = $_SERVER['REQUEST_METHOD'];

// Pega o endpoint da URL
$endpoint = isset($_GET['endpoint']) ? $_GET['endpoint'] : '';

// Incluir o arquivo de conexão com o banco de dados
require 'db.php';

// Função para retornar erro JSON
function returnError($message, $code = 500) {
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}

// Verifica se o endpoint é válido
$validEndpoints = ['filmes', 'sessoes', 'ingressos'];
if (!in_array($endpoint, $validEndpoints)) {
    returnError('Endpoint não encontrado', 404);
}

// Consulta ao banco de dados e retorna os dados como JSON
try {
    $stmt = $pdo->query('SELECT * FROM ' . ucfirst($endpoint)); // Assumindo que o nome da tabela é o mesmo que o endpoint
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    returnError('Erro ao buscar dados: ' . $e->getMessage());
}
?>

