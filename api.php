<?php
header('Content-Type: application/json');
require 'db.php'; // Inclui o arquivo de conexão com o banco de dados

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = isset($_GET['endpoint']) ? $_GET['endpoint'] : '';

switch ($endpoint) {
    case 'filmes':
        if ($method === 'GET') {
            try {
                $stmt = $pdo->query('SELECT * FROM Filmes');
                $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($filmes);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Erro ao buscar filmes: ' . $e->getMessage()]);
            }
        }
        break;

    case 'sessoes':
        if ($method === 'GET') {
            try {
                $stmt = $pdo->query('SELECT * FROM Sessoes');
                $sessoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($sessoes);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Erro ao buscar sessões: ' . $e->getMessage()]);
            }
        }
        break;

    case 'ingressos':
        if ($method === 'GET') {
            try {
                $stmt = $pdo->query('SELECT * FROM Ingressos');
                $ingressos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($ingressos);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Erro ao buscar ingressos: ' . $e->getMessage()]);
            }
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
