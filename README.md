### Teste VueJS 3 + Laravel 10

Desafio proposto é desenvolver um sistema para controle de agendamentos de uma clínica veterinária.<br/><br/>

O rececionista da clínica vai poder ver as marcações por datas e por tipo de animal, atribuiindo as marcações ao médico selecionado, alem de poder criar, editar e apagar todas as marcações.<br/>
O médico vai poder ver as marcações que lhe estão atribuídas, por dias e por tipo de animal, e vai poder editar somente as marcações que lhe estão atribuídas,
não podendo apagar nenhuma marcação.

```
• O sistema contem um sistema de login autenticado;
• O backend em Laravel 10/11, e o front em VueJS 3;
• O banco de dados deverá ser relacional - MySQL ou PostgreSQL;
• o banco de dados deverá ser criado utilizando Migrations além da implementação de Seeds;
```
#### Requisitos
```
• Versao do PHP: 8.2
• Versao do Laravel: 10.10
• Versao do VueJS: 3.4
• Versao do Nuxt: 3.13
• Versao do Node: 22
```
#### Clone o projeto
```
• git clone git@github.com:wagner-lemos/clinica-veterinaria-laravel-vue.git

OBS: No clone já contem os diretorios frontend e backend
```
#### Instale as dependências
```
• Entre no diretorio backend e execute: composer install
```
#### Configure o arquivo .env
```
• cp .env.example .env
• php artisan key:generate
• Adicione os dados do database
```
#### Execute a migrate para seu banco de dados
```
• php artisan migrate --seed
```
#### Rode a API na porta http://localhost:8000
```
• php artisan serve
```

### Configurando o Frontend

#### Instale as dependências
```
• Entre no diretorio frontend e execute: npm install
```
#### Rode o projeto local na porta http://localhost:3000
```
• npm run dev
```