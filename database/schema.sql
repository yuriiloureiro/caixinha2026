-- ============================================
-- DATABASE SCHEMA - Caixinha 2026
-- ============================================

-- Criação da tabela de participantes
CREATE TABLE IF NOT EXISTS participantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    contato VARCHAR(255),
    cotas INT NOT NULL DEFAULT 1,
    pagamentos JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Índices para melhor performance (opcional)
CREATE INDEX idx_nome ON participantes(nome);
CREATE INDEX idx_created_at ON participantes(created_at);