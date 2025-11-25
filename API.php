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
            .error {
                color: red;
                font-weight: bold;
            }
            .response-block {
                margin-bottom: 15px;
                padding: 10px;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            .response-block span {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Resultado da Validação</h1>
            <div class='result'>
                <div class='response-block'>
                    <span>Ação:</span> $content->acao
                </div>
                <div class='response-block'>
                    <span>Valor:</span> $content->valor
                </div>
                <div class='response-block'>
                    <span>Status:</span> <span class='$content->status'>$content->status</span>
                </div>
                <div class='response-block'>
                    <span>Mensagem:</span> $content->mensagem
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
    exit;
}

// Se nenhuma ação foi informada
if ($action === null) {
    send_html_response("<span class='error'>Erro:</span> Nenhuma ação informada. Use o parâmetro 'action' (validar_email, validar_telefone, validar_cpf, numero_positivo).");
}

switch ($action) {
    // -------------------------
    // 1) VALIDAR E-MAIL
    // Exemplo: api.php?action=validar_email&email=exemplo@dominio.com
    // -------------------------
    case 'validar_email':
        if (!isset($_GET['email']) || empty($_GET['email'])) {
            send_html_response("<span class='error'>Erro:</span> Parâmetro 'email' é obrigatório e não pode estar vazio.");
        }

        $email = $_GET['email'];
        // Verifica se o e-mail tem formato válido (expressão regular)
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $content = (object) [
                'acao' => 'validar_email',
                'valor' => $email,
                'status' => 'Válido',
                'mensagem' => 'E-mail válido.'
            ];
        } else {
            $content = (object) [
                'acao' => 'validar_email',
                'valor' => $email,
                'status' => 'Inválido',
                'mensagem' => 'E-mail inválido.'
            ];
        }
        send_html_response($content);
        break;

    // -------------------------
    // 2) VALIDAR NÚMERO DE TELEFONE
    // Exemplo: api.php?action=validar_telefone&telefone=999999999
    // -------------------------
    case 'validar_telefone':
        if (!isset($_GET['telefone']) || empty($_GET['telefone'])) {
            send_html_response("<span class='error'>Erro:</span> Parâmetro 'telefone' é obrigatório e não pode estar vazio.");
        }

        $telefone = $_GET['telefone'];
        // Valida o telefone (aqui é uma validação simples de 9 dígitos com apenas números)
        if (preg_match("/^[0-9]{9}$/", $telefone)) {
            $content = (object) [
                'acao' => 'validar_telefone',
                'valor' => $telefone,
                'status' => 'Válido',
                'mensagem' => 'Número de telefone válido.'
            ];
        } else {
            $content = (object) [
                'acao' => 'validar_telefone',
                'valor' => $telefone,
                'status' => 'Inválido',
                'mensagem' => 'Número de telefone inválido.'
            ];
        }
        send_html_response($content);
        break;

    // -------------------------
    // 3) VALIDAR CPF
    // Exemplo: api.php?action=validar_cpf&cpf=12345678909
    // -------------------------
    case 'validar_cpf':
        if (!isset($_GET['cpf']) || empty($_GET['cpf'])) {
            send_html_response("<span class='error'>Erro:</span> Parâmetro 'cpf' é obrigatório e não pode estar vazio.");
        }

        $cpf = $_GET['cpf'];
        // Valida o CPF (bem simplificado)
        if (preg_match("/^\d{11}$/", $cpf)) {
            $content = (object) [
                'acao' => 'validar_cpf',
                'valor' => $cpf,
                'status' => 'Válido',
                'mensagem' => 'CPF válido.'
            ];
        } else {
            $content = (object) [
                'acao' => 'validar_cpf',
                'valor' => $cpf,
                'status' => 'Inválido',
                'mensagem' => 'CPF inválido.'
            ];
        }
        send_html_response($content);
        break;

    // -------------------------
    // 4) VERIFICAR NÚMERO POSITIVO
    // Exemplo: api.php?action=numero_positivo&numero=5
    // -------------------------
    case 'numero_positivo':
        if (!isset($_GET['numero']) || empty($_GET['numero'])) {
            send_html_response("<span class='error'>Erro:</span> Parâmetro 'numero' é obrigatório e não pode estar vazio.");
        }

        $numero = $_GET['numero'];
        // Verifica se o número é positivo
        if (is_numeric($numero) && $numero > 0) {
            $content = (object) [
                'acao' => 'numero_positivo',
                'valor' => $numero,
                'status' => 'Positivo',
                'mensagem' => 'Número positivo.'
            ];
        } else {
            $content = (object) [
                'acao' => 'numero_positivo',
                'valor' => $numero,
                'status' => 'Não Positivo',
                'mensagem' => 'Número não é positivo.'
            ];
        }
        send_html_response($content);
        break;

    // -------------------------
    // AÇÃO DESCONHECIDA
    // -------------------------
    default:
        send_html_response("<span class='error'>Erro:</span> Ação inválida. Use uma das seguintes: validar_email, validar_telefone, validar_cpf, numero_positivo.");
}
