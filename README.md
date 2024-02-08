# Cadastro de Corretores de Imóveis

<p>
Projeto simples para testar os conhecimentos referente a <b>PHP</b>.
</p>

## Executar

1. Após o git clone

```bash
composer install
```
2. Renomeie o .env.example para .env e configure de acordo com seu banco de dados;

3. Execute as querys no banco de dados, encontram-se no arquivo bd.sql;

4. Excute no terminal:

```bash
php -S localhost:8000 api/index.php
```

## Possibiidades Futuras

- Adicionar Repositories e Services, e, assim refatorar os models, deixando-os independente da 
  tecnolgia de conexão com bando de dados.
- Adicionar Validações do formulário, no momento validações somente nas views.

## Meus projetos anteriores relacionados
 - [e-on](https://github.com/tunim73/e-on_api_php_puro_com_react), api rest em php puro
 - [mvc-php](https://github.com/tunim73/mvc-php), estudos de php com arquitetura MVC realizado
   em cursos da alura.