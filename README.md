🔗 **Demonstração**: [Acesse aqui](http://tabler.henriquebs0.site/)

## ⚙️ Configuração e Instalação

### 📌 Pré-requisitos
- **Docker** e **Docker Compose** instalados
- **PHP** e **Composer** instalados

Siga os passos abaixo para instalar e configurar o Tabler no seu ambiente de desenvolvimento:

1️⃣ **Clone o repositório e entre no projeto**:

```bash
git clone https://github.com/HenriqueBS0/tabler.git && cd tabler
```

2️⃣ **Instale as dependências do Composer**:

```bash
composer install
```

3️⃣ **Crie o arquivo `.env`**:

```bash
cp .env.example .env
```

4️⃣ **Inicie os contêineres do Laravel Sail**:

```bash
./vendor/bin/sail up -d
```

5️⃣ **Gere a chave da aplicação**:

```bash
./vendor/bin/sail artisan key:generate
```

6️⃣ **Execute as migrações e seeders**:

```bash
./vendor/bin/sail artisan migrate:refresh --seed
```

7️⃣ **Execute os testes unitários**:

```bash
./vendor/bin/sail artisan test
```

