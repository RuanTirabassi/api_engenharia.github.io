
# API de Validação de Dados

Esta API foi desenvolvida para realizar validações de dados básicos, como e-mails, números de telefone, CPF e verificação de números positivos.

## Como Usar

A API está acessível através de uma URL com parâmetros `GET`. Cada requisição deve incluir o parâmetro `action` com a operação desejada e os parâmetros necessários para validação (como `email`, `telefone`, `cpf`, `numero`).

### Exemplo de URL:

```
http://atividadeengenharia2.infinityfree.me/API.php?action=validar_email&email=exemplo@dominio.com
```

**Nota**: Substitua `atividadeengenharia2.infinityfree.me` pelo seu subdomínio real.

## Métodos da API

### 1. Validar E-mail
#### **Rota**:
```
/API.php?action=validar_email&email=<email>
```

#### **Parâmetros**:
- `email` (obrigatório): O endereço de e-mail a ser validado.

#### **Exemplo de Requisição**:
```text
GET /API.php?action=validar_email&email=teste@dominio.com
```

#### **Resposta**:

- **Se válido**:
    ```json
    {
      "acao": "validar_email",
      "email": "teste@dominio.com",
      "valido": true
    }
    ```

- **Se inválido**:
    ```json
    {
      "acao": "validar_email",
      "email": "teste@dominio.com",
      "valido": false,
      "mensagem": "E-mail inválido."
    }
    ```

---

### 2. Validar Telefone
#### **Rota**:
```
/API.php?action=validar_telefone&telefone=<telefone>
```

#### **Parâmetros**:
- `telefone` (obrigatório): O número de telefone a ser validado.

#### **Exemplo de Requisição**:
```text
GET /API.php?action=validar_telefone&telefone=999999999
```

#### **Resposta**:

- **Se válido**:
    ```json
    {
      "acao": "validar_telefone",
      "telefone": "999999999",
      "valido": true
    }
    ```

- **Se inválido**:
    ```json
    {
      "acao": "validar_telefone",
      "telefone": "999999999",
      "valido": false,
      "mensagem": "Número de telefone inválido."
    }
    ```

---

### 3. Validar CPF
#### **Rota**:
```
/API.php?action=validar_cpf&cpf=<cpf>
```

#### **Parâmetros**:
- `cpf` (obrigatório): O CPF a ser validado.

#### **Exemplo de Requisição**:
```text
GET /API.php?action=validar_cpf&cpf=12345678909
```

#### **Resposta**:

- **Se válido**:
    ```json
    {
      "acao": "validar_cpf",
      "cpf": "12345678909",
      "valido": true
    }
    ```

- **Se inválido**:
    ```json
    {
      "acao": "validar_cpf",
      "cpf": "12345678909",
      "valido": false,
      "mensagem": "CPF inválido."
    }
    ```

---

### 4. Verificar Número Positivo
#### **Rota**:
```
/API.php?action=numero_positivo&numero=<numero>
```

#### **Parâmetros**:
- `numero` (obrigatório): O número a ser verificado.

#### **Exemplo de Requisição**:
```text
GET /API.php?action=numero_positivo&numero=5
```

#### **Resposta**:

- **Se o número for positivo**:
    ```json
    {
      "acao": "numero_positivo",
      "numero": "5",
      "valido": true
    }
    ```

- **Se o número não for positivo**:
    ```json
    {
      "acao": "numero_positivo",
      "numero": "-5",
      "valido": false,
      "mensagem": "Número não é positivo."
    }
    ```

---

## Como Testar

1. **Validar E-mail**:
   - Exemplo de URL para testar:
     ```text
     http://atividadeengenharia2.infinityfree.me/API.php?action=validar_email&email=teste@dominio.com
     ```

2. **Validar Telefone**:
   - Exemplo de URL para testar:
     ```text
     http://atividadeengenharia2.infinityfree.me/API.php?action=validar_telefone&telefone=999999999
     ```

3. **Validar CPF**:
   - Exemplo de URL para testar:
     ```text
     http://atividadeengenharia2.infinityfree.me/API.php?action=validar_cpf&cpf=12345678909
     ```

4. **Verificar Número Positivo**:
   - Exemplo de URL para testar:
     ```text
     http://atividadeengenharia2.infinityfree.me/API.php?action=numero_positivo&numero=5
     ```
