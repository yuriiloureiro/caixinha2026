# 📌 Caixinha Desafio 2026 - Gestão Financeira Colaborativa

![Status](https://img.shields.io/badge/status-em--produ%C3%A7%C3%A3o-success)
![React](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

Aplicação Full-Stack desenvolvida para gerenciar um desafio financeiro familiar. O sistema permite o controle de depósitos mensais de múltiplos participantes, com cálculos automáticos de rendimentos e status de adimplência.

🔗 **Acesse a Demo:** [caixinha2026.loureiroyuri.com.br](https://caixinha2026.loureiroyuri.com.br)

---

## 📸 Preview do Sistema

<div align="center">
  <img src="../Caixinha 2026/screenshots/dashboard.png" width="800px" />
</div>

---

## ✨ Funcionalidades

- 🔐 **Autenticação Multi-usuário:** Acesso restrito para administradores da caixinha.
- 📊 **Dashboard Financeiro:** Visualização em tempo real do Total Pago, Esperado e Pendências.
- ✅ **Controle de Pagamentos:** Sistema de check-in mensal com histórico de datas.
- 💰 **Cálculos Dinâmicos:** Ajuste automático de valores com base no número de cotas de cada participante.
- 📱 **Design Responsivo:** Interface otimizada para uso em dispositivos móveis e desktop.
- 💾 **Exportação de Dados:** Função para exportar a planilha em formato CSV.

---

## 🛠️ Tecnologias Utilizadas

### Frontend

- **React.js**: Construção da interface reativa e gerenciamento de estado.
- **Tailwind CSS**: Estilização moderna e responsiva.
- **Babel**: Transpilação de código para compatibilidade.

### Backend & Banco de Dados

- **PHP**: Construção da API RESTful para comunicação com o servidor.
- **MySQL**: Armazenamento persistente dos dados dos participantes.
- **PDO (PHP Data Objects)**: Conexão segura com o banco de dados utilizando _Prepared Statements_.

---

## 📁 Estrutura do Projeto

- `index.html`: Interface principal em React.
- `api.php`: Endpoints da API para operações CRUD.
- `config.example.php`: Modelo de configuração do banco de dados.
- `database/schema.sql`: Script de criação das tabelas MySQL.

---
