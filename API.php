<?php
// Define que a resposta será em HTML
header('Content-Type: text/html; charset=utf-8');

// Lê a ação (método) que o usuário quer executar
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Função para enviar resposta HTML e finalizar
function send_html_response($content) {
    echo "
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Resultado da Validação</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                color: #333;
                margin: 20px;
                padding: 20px;
            }
            .container {
                background-color: #fff;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #4CAF50;
            }
            .result {
                font-size: 1.2em;
                margin-top: 10px;
            }
            .valid {
                color: green;
            }
            .invalid {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Resultado da Validação</h1>
            <div class='result'>
                $content
            </div>
        </div>
    </body>
    </html>
    ";
    exit;
}

// Se nenhuma ação foi informada
if ($action === null) {
    send_html_response("<strong>Erro:</strong> Nenhuma ação informada. Use o parâmetro 'action'.");
}

switch ($action) {
    // -------------------------
    // 1) VALIDAR E-MAIL
    // Exemplo: api.php?action=validar_email&email=exemplo@dominio.com
    // -------------------------
    case 'validar_email':
        if (!isset($_GET['email'])) {
            send_html_response("<strong>Erro:</strong> Parâmetro 'email' é obrigatório.");
        }

        $email = $_GET['email'];
        // Verifica se o e-mail tem formato válido (expressão regular)
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $content = "<strong>E-mail:</strong> " . $email . "<br><strong>Status:</strong> <span class='valid'>Válido</span>";
        } else {
            $content = "<strong>E-mail:</strong> " . $email . "<br><strong>Status:</strong> <span class='invalid'>Inválido</span>";
        }
        send_html_response($content);
        break;

    // -------------------------
    // 2) VALIDAR NÚMERO DE TELEFONE
    // Exemplo: api.php?action=validar_telefone&telefone=999999999
    // -------------------------
    case 'validar_telefone':
        if (!isset($_GET['telefone'])) {
            send_html_response("<strong>Erro:</strong> Parâmetro 'telefone' é obrigatório.");
        }

        $telefone = $_GET['telefone'];
        // Valida o telefone (aqui é uma validação simples de 9 dígitos com apenas números)
        if (preg_match("/^[0-9]{9}$/", $telefone)) {
            $content = "<strong>Telefone:</strong> " . $telefone . "<br><strong>Status:</strong> <span class='valid'>Válido</span>";
        } else {
            $content = "<strong>Telefone:</strong> " . $telefone . "<br><strong>Status:</strong> <span class='invalid'>Inválido</span>";
        }
        send_html_response($content);
        break;

    // -------------------------
    // 3) VALIDAR CPF
    // Exemplo: api.php?action=validar_cpf&cpf=12345678909
    // -------------------------
    case 'validar_cpf':
        if (!isset($_GET['cpf'])) {
            send_html_response("<strong>Erro:</strong> Parâmetro 'cpf' é obrigatório.");
        }

        $cpf = $_GET['cpf'];
        // Valida o CPF (bem simplificado)
        if (preg_match("/^\d{11}$/", $cpf)) {
            $content = "<strong>CPF:</strong> " . $cpf . "<br><strong>Status:</strong> <span class='valid'>Válido</span>";
        } else {
            $content = "<strong>CPF:</strong> " . $cpf . "<br><strong>Status:</strong> <span class='invalid'>Inválido</span>";
        }
        send_html_response($content);
        break;

    // -------------------------
    // 4) VERIFICAR NÚMERO POSITIVO
    // Exemplo: api.php?action=numero_positivo&numero=5
    // -------------------------
    case 'numero_positivo':
        if (!isset($_GET['numero'])) {
            send_html_response("<strong>Erro:</strong> Parâmetro 'numero' é obrigatório.");
        }

        $numero = $_GET['numero'];
        // Verifica se o número é positivo
        if (is_numeric($numero) && $numero > 0) {
            $content = "<strong>Número:</strong> " . $numero . "<br><strong>Status:</strong> <span class='valid'>Positivo</span>";
        } else {
            $content = "<strong>Número:</strong> " . $numero . "<br><strong>Status:</strong> <span class='invalid'>Não Positivo</span>";
        }
        send_html_response($content);
        break;

    // -------------------------
    // AÇÃO DESCONHECIDAa
    // -------------------------
    default:
        send_html_response("<strong>Erro:</strong> Ação inválida. Use uma das seguintes: validar_email, validar_telefone, validar_cpf, numero_positivo.");
}