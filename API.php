<?php
// Define que a resposta será em JSON
header('Content-Type: application/json; charset=utf-8');

// Lê a ação (método) que o usuário quer executar
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Função para enviar resposta JSON e finalizar
function send_response($data, $status_code = 200) {
    http_response_code($status_code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// Se nenhuma ação foi informada
if ($action === null) {
    send_response([
        "erro" => true,
        "mensagem" => "Nenhuma ação informada. Use o parâmetro 'action'.",
        "acoes_disponiveis" => ["validar_email", "validar_telefone", "validar_cpf", "numero_positivo"]
    ], 400);
}

switch ($action) {
    // -------------------------
    // 1) VALIDAR E-MAIL
    // Exemplo: api.php?action=validar_email&email=exemplo@dominio.com
    // -------------------------
    case 'validar_email':
        if (!isset($_GET['email'])) {
            send_response([
                "erro" => true,
                "mensagem" => "Parâmetro 'email' é obrigatório."
            ], 400);
        }

        $email = $_GET['email'];
        // Verifica se o e-mail tem formato válido (expressão regular)
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            send_response([
                "acao" => "validar_email",
                "email" => $email,
                "valido" => true
            ]);
        } else {
            send_response([
                "acao" => "validar_email",
                "email" => $email,
                "valido" => false,
                "mensagem" => "E-mail inválido."
            ]);
        }
        break;

    // -------------------------
    // 2) VALIDAR NÚMERO DE TELEFONE
    // Exemplo: api.php?action=validar_telefone&telefone=999999999
    // -------------------------
    case 'validar_telefone':
        if (!isset($_GET['telefone'])) {
            send_response([
                "erro" => true,
                "mensagem" => "Parâmetro 'telefone' é obrigatório."
            ], 400);
        }

        $telefone = $_GET['telefone'];
        // Valida o telefone (aqui é uma validação simples de 9 dígitos com apenas números)
        if (preg_match("/^[0-9]{9}$/", $telefone)) {
            send_response([
                "acao" => "validar_telefone",
                "telefone" => $telefone,
                "valido" => true
            ]);
        } else {
            send_response([
                "acao" => "validar_telefone",
                "telefone" => $telefone,
                "valido" => false,
                "mensagem" => "Número de telefone inválido."
            ]);
        }
        break;

    // -------------------------
    // 3) VALIDAR CPF
    // Exemplo: api.php?action=validar_cpf&cpf=12345678909
    // -------------------------
    case 'validar_cpf':
        if (!isset($_GET['cpf'])) {
            send_response([
                "erro" => true,
                "mensagem" => "Parâmetro 'cpf' é obrigatório."
            ], 400);
        }

        $cpf = $_GET['cpf'];
        // Valida o CPF (bem simplificado)
        if (preg_match("/^\d{11}$/", $cpf)) {
            send_response([
                "acao" => "validar_cpf",
                "cpf" => $cpf,
                "valido" => true
            ]);
        } else {
            send_response([
                "acao" => "validar_cpf",
                "cpf" => $cpf,
                "valido" => false,
                "mensagem" => "CPF inválido."
            ]);
        }
        break;

    // -------------------------
    // 4) VERIFICAR NÚMERO POSITIVO
    // Exemplo: api.php?action=numero_positivo&numero=-5
    // -------------------------
    case 'numero_positivo':
        if (!isset($_GET['numero'])) {
            send_response([
                "erro" => true,
                "mensagem" => "Parâmetro 'numero' é obrigatório."
            ], 400);
        }

        $numero = $_GET['numero'];
        // Verifica se o número é positivo
        if (is_numeric($numero) && $numero > 0) {
            send_response([
                "acao" => "numero_positivo",
                "numero" => $numero,
                "valido" => true
            ]);
        } else {
            send_response([
                "acao" => "numero_positivo",
                "numero" => $numero,
                "valido" => false,
                "mensagem" => "Número não é positivo."
            ]);
        }
        break;

    // -------------------------
    // AÇÃO DESCONHECIDA
    // -------------------------
    default:
        send_response([
            "erro" => true,
            "mensagem" => "Ação inválida. Use uma das seguintes: validar_email, validar_telefone, validar_cpf, numero_positivo."
        ], 400);
}
