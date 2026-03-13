<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

// Lidar com requisições OPTIONS (CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$conn = getConnection();
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    switch ($method) {
        case 'GET':
            // Buscar todos os participantes
            $stmt = $conn->query("SELECT * FROM participantes ORDER BY id");
            $participantes = $stmt->fetchAll();
            
            // Converter JSON string para array
            foreach ($participantes as &$p) {
                $p['pagamentos'] = json_decode($p['pagamentos'], true);
                $p['id'] = (int)$p['id'];
                $p['cotas'] = (int)$p['cotas'];
            }
            
            echo json_encode(['success' => true, 'data' => $participantes]);
            break;
            
        case 'POST':
            // Verificar autenticação
            if (!verificarAuth()) {
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => 'Não autorizado']);
                exit();
            }
            
            // Adicionar novo participante
            $nome = $input['nome'] ?? '';
            $contato = $input['contato'] ?? '';
            $cotas = $input['cotas'] ?? 1;
            $pagamentos = json_encode($input['pagamentos'] ?? array_fill(0, 12, false));
            
            $stmt = $conn->prepare("INSERT INTO participantes (nome, contato, cotas, pagamentos) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $contato, $cotas, $pagamentos]);
            
            $id = $conn->lastInsertId();
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => (int)$id,
                    'nome' => $nome,
                    'contato' => $contato,
                    'cotas' => (int)$cotas,
                    'pagamentos' => json_decode($pagamentos, true)
                ]
            ]);
            break;
            
        case 'PUT':
            // Verificar autenticação
            if (!verificarAuth()) {
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => 'Não autorizado']);
                exit();
            }
            
            // Atualizar participante
            $id = $input['id'] ?? 0;
            $nome = $input['nome'] ?? '';
            $contato = $input['contato'] ?? '';
            $cotas = $input['cotas'] ?? 1;
            $pagamentos = json_encode($input['pagamentos'] ?? array_fill(0, 12, false));
            
            $stmt = $conn->prepare("UPDATE participantes SET nome = ?, contato = ?, cotas = ?, pagamentos = ? WHERE id = ?");
            $stmt->execute([$nome, $contato, $cotas, $pagamentos, $id]);
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => (int)$id,
                    'nome' => $nome,
                    'contato' => $contato,
                    'cotas' => (int)$cotas,
                    'pagamentos' => json_decode($pagamentos, true)
                ]
            ]);
            break;
            
        case 'DELETE':
            // Verificar autenticação
            if (!verificarAuth()) {
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => 'Não autorizado']);
                exit();
            }
            
            // Deletar participante
            $id = $input['id'] ?? 0;
            
            $stmt = $conn->prepare("DELETE FROM participantes WHERE id = ?");
            $stmt->execute([$id]);
            
            echo json_encode(['success' => true, 'message' => 'Participante removido']);
            break;
            
        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Método não permitido']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>