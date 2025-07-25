# Instruções para rodar e testar o projeto

## Pré-requisitos

- Docker e Docker Compose **OU**
- PHP >= 8.2 e Composer

## Como rodar o projeto

### 1. Clonar o repositório
```bash
git clone https://github.com/T4l3s/desafio-tecnico-laravel.git api-laravel
cd api-laravel
```

### 2. Configurar variáveis de ambiente

```bash
cp .env.example .env
```

- Copie o arquivo `.env.example` para um `.env`.
- Ajuste as variáveis conforme necessário.

### 3. Subir com Docker (recomendado)
```bash
docker compose up -d --build
docker compose exec app php artisan migrate --seed
```
- O serviço estará disponível em `http://localhost:8000`.

### 4. Instalação manual (sem Docker)
```bash
# Instalar dependências do projeto.
composer install

# Para copiar o .env.example para um .env.
cp .env.example .env

# Gerar uma key do laravel e fazer uma migration para o db e popular o mesmo.
php artisan key:generate
php artisan migrate --seed

# Iniciar o servidor de desenvolvimento do projeto.
php artisan serve
```

## Migrations e Seeders

Para rodar as migrations e popular o banco de dados com os seeders:
```bash
php artisan migrate --seed
```

## Como testar as funcionalidades

1. Acesse o sistema em `http://localhost:8000`
2. Utilize as rotas/endpoints conforme o código-fonte
3. Para rodar testes automatizados, utilize os comandos acima.


## Endpoints disponíveis

| Método  | Endpoint                | Descrição                              |
|---------|-------------------------|----------------------------------------|
| GET     | /api/produtos           | Lista todos os produtos                |
| GET     | /api/produtos/{id}      | Exibe um produto específico            |
| POST    | /api/produtos           | Cria um novo produto                   |
| PUT     | /api/produtos/{id}      | Atualiza um produto existente          |
| DELETE  | /api/produtos/{id}      | Remove um produto                      |


## Exemplos de uso dos endpoints

### GET /api/produtos
Lista todos os produtos.

**Requisição:**
```http
GET /api/produtos
```

**Resposta:**
```json
[
  {
    "id": 1,
    "nome": "Produto A",
    "preco": 10.5,
    "quantidade": 100,
    "created_at": "2024-07-25T13:00:00.000000Z",
    "updated_at": "2024-07-25T13:00:00.000000Z"
  },
  {
    "id": 2,
    "nome": "Produto B",
    "preco": 20.0,
    "quantidade": 50,
    "created_at": "2024-07-25T13:10:00.000000Z",
    "updated_at": "2024-07-25T13:10:00.000000Z"
  }
]
```

---

### GET /api/produtos/{id}
Exibe um produto específico.

**Requisição:**
```http
GET /api/produtos/1
```

**Resposta (sucesso):**
```json
{
  "id": 1,
  "nome": "Produto A",
  "preco": 10.5,
  "quantidade": 100,
  "created_at": "2024-07-25T13:00:00.000000Z",
  "updated_at": "2024-07-25T13:00:00.000000Z"
}
```
**Resposta (não encontrado):**
```json
{
  "mensagem": "Produto não encontrado"
}
```

---

### POST /api/produtos
Cria um novo produto.

**Requisição:**
```http
POST /api/produtos
```

Body(json):
```json
{
  "nome": "Produto Novo",
  "preco": 99.99,
  "quantidade": 10
}
```

**Resposta (201 Created):**
```json
{
  "id": 3,
  "nome": "Produto Novo",
  "preco": 99.99,
  "quantidade": 10,
  "created_at": "2024-07-25T14:00:00.000000Z",
  "updated_at": "2024-07-25T14:00:00.000000Z"
}
```
**Resposta (erro de validação):**
```json
{
  "message": "O nome é obrigatório.",
  "errors": {
    "nome": [
      "O nome é obrigatório."
    ]
  }
}
```

---

### PUT /api/produtos/{id}
Atualiza um produto existente.

**Requisição:**
```http
PUT /api/produtos/1
```

Body(json):
```json
{
  "nome": "Produto Atualizado",
  "preco": 120.00,
  "quantidade": 80
}
```
**Resposta (sucesso):**
```json
{
  "id": 1,
  "nome": "Produto Atualizado",
  "preco": 120.00,
  "quantidade": 80,
  "created_at": "2024-07-25T13:00:00.000000Z",
  "updated_at": "2024-07-25T14:10:00.000000Z"
}
```
**Resposta (não encontrado):**
```json
{
  "mensagem": "Produto não encontrado"
}
```

---

### DELETE /api/produtos/{id}
Remove um produto.

**Requisição:**
```http
DELETE /api/produtos/1
```
**Resposta (sucesso):**
```json
{
  "mensagem": "Produto removido com sucesso"
}
```
**Resposta (não encontrado):**
```json
{
  "mensagem": "Produto não encontrado"
}
```

