# Projeto criado para Teste técnico para Pessoa Desenvolvedora Back-End

Neste projeto, foram aplicadas boas práticas para garantir uma implementação eficiente e organizada. Foram utilizadas Migrations e Seeders para popular as tabelas do banco de dados, proporcionando uma estrutura sólida para o armazenamento de informações.

## Instalação Passo a passo

```sh
git clone https://github.com/VandoJunqueira/teste.facil_consulta.git
```

### Crie o Arquivo .env

```sh
cp .env.example .env
```

### Instalar as dependências do projeto

```sh
composer install
```

### Gerar a key do projeto Laravel

```sh
php artisan key:generate
```

### Gerar secret key do JWT-AUTH

```sh
php artisan jwt:secret
```

### Iniciar Container

```sh
bash ./vendor/laravel/sail/bin/sail up
```

**OU**

```sh
./vendor/bin/sail up
```

## Migrations e Seeders

### Executar migração

```sh
php artisan migrate
```

### Executar o seeder para popular a tabela

```sh
php artisan db:seed
```
