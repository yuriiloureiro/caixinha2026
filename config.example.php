<?php
// ============================================
// 🔐 CONFIGURAÇÕES DO BANCO DE DADOS (EXEMPLO)
// ============================================
// INSTRUÇÕES: 
// 1. Renomeie este arquivo para config.php
// 2. Preencha com suas credenciais reais da Hostinger
// 3. O arquivo config.php está no .gitignore e não será enviado ao GitHub

define('DB_HOST', 'localhost');
define('DB_NAME', 'NOME_DO_SEU_BANCO');
define('DB_USER', 'NOME_DO_SEU_USUARIO');
define('DB_PASS', 'SUA_SENHA_AQUI');

// ============================================
// 🔐 USUÁRIOS AUTORIZADOS
// ============================================
$usuarios_autorizados = [
    'usuario_exemplo' => 'senha_exemplo',
];

// ============================================
// Conexão com o banco
// ============================================
function getConnection() {
    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
        return $conn;
    } catch(PDOException $e) {
        http_response_code(500);
        die(json_encode(['error' => 'Erro de conexão: ' . $e->getMessage()]));
    }
}

// ============================================
// Verificar autenticação
// ============================================
function verificarAuth() {
    global $usuarios_autorizados;
    
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        return false;
    }
    
    $user = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];
    
    return isset($usuarios_autorizados[$user]) && $usuarios_autorizados[$user] === $pass;
}
?>