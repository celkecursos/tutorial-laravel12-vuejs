- Projeto desenvolvido com Laravel 12 e Vue.js. Como criar o projeto com Laravel e Vue.js?

- Código fonte desenvolvido na aulas: [Acessar as aulas]().

- [Ganhe 20% de desconto adicional na Hostinger](https://www.hostinger.com.br/referral?REFERRALCODE=1CESARNICOL13)

## Requisitos

* PHP 8.2 ou superior - Conferir a versão: php -v
* MySQL 8 ou superior;
* Composer - Conferir a instalação: composer --version
* Node.js 22 ou superior - Conferir a versão: node -v

## Como rodar o projeto baixado

Baixar os arquivos do GitHub.
```
git clone https://github.com/celkecursos/tutorial-laravel12-vuejs.git .
```

- Duplicar o arquivo ".env.example" e renomear para ".env".

- Para a funcionalidade enviar e-mail funcionar, necessário alterar as credenciais do servidor de envio de e-mail no arquivo .env.
- Utilizar o servidor fake durante o desenvolvimento: [Acessar envio gratuito de e-mail](https://mailtrap.io?ref=celke)
- Utilizar o servidor Iagente no ambiente de produção: [Acessar envio gratuito de e-mail](https://login.iagente.com.br/solicitacao-conta-smtp/origin/celke)
```
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=nome-do-usuario-na-mailtrap
MAIL_PASSWORD=senha-do-usuario-na-mailtrap
MAIL_FROM_ADDRESS="colocar-email-remetente@meu-dominio.com.br"
MAIL_FROM_NAME="${APP_NAME}"
```

Instalar as dependências do PHP.
```
composer install
```

Instalar as dependências do Node.js.
```
npm install
```

Gerar a chave no arquivo .env.
```
php artisan key:generate
```

Executar as migrations para criar as tabelas e as colunas.
```
php artisan migrate
```

Executar as seeders para cadastrar os dados de teste.
```
php artisan db:seed
```

Rodar o projeto local.
```
composer run dev
```

Acessar a página criada com Laravel.
```
http://127.0.0.1:8000
```

## Sequência para criar o projeto

Instalar o Laravel no computador.
```
composer global require laravel/installer
```

Criar o projeto com Laravel. A palavra "celke" no final indica o nome do diretório que será criado, e dentro dele o projeto será instalado.
```
laravel new celke
```

- Which starter kit would you like to install? / Qual kit inicial você gostaria de instalar? Digite vue e pressione Enter.
- Which authentication provider do you prefer? / Qual provedor de autenticação você prefere? Digite laravel e pressione Enter.
- Which testing framework do you prefer? / Qual framework de testes você prefere? Digite 0 e pressione Enter.
- Would you like to run npm install and npm run build? (yes/no) [yes]: / Você gostaria de executar npm install e npm run build? (sim/não) [sim]: Pressione Enter.

Acessar o diretório do projeto.
```
cd celke
```

Rodar o projeto local.
```
composer run dev
```

Alterar as credenciais do banco de dados no arquivo .env.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=celke
DB_USERNAME=root
DB_PASSWORD=
```

Executar as migrations para criar as tabelas e as colunas.
```
php artisan migrate
```

Acessar a página criada com Laravel.
```
http://127.0.0.1:8000
```

Traduzir para português [Módulo pt-BR](https://github.com/lucascudo/laravel-pt-BR-localization)

Criar migration para criar a tabela no banco de dados.
```
php artisan make:migration create_nome_table
```
```
php artisan make:migration create_tasks_table --create=tasks
```

Criar a Models. A models é usada para gerenciar a tabela do banco de dados através do Eloquent ORM.
```
php artisan make:model NomeDaModel
```
```
php artisan make:model Task
```

Criar Seed para cadastrar dados de teste.
```
php artisan make:seeder NomeSeeder
```
```
php artisan make:seeder TaskSeeder
```

Criar a Controller.
```
php artisan make:controller NomeController
```
```
php artisan make:controller Tasks/TaskController
```

## Autor

Este projeto foi desenvolvido por [Cesar Szpak](https://github.com/cesarszpak) e está hospedado no repositório da organização [Celke](https://github.com/celkecursos).

## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE.txt) para mais detalhes.