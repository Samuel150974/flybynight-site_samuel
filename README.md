# Fly By Night

Projeto PHP com páginas de cadastro e consulta conectadas ao banco MySQL `flybynight_completo`.

## Configuração do banco

1. Inicie o servidor MySQL e importe `dump/flybynight_completo.sql` pelo phpMyAdmin ou pelo cliente MySQL.
2. Confira as variáveis `$servidor`, `$banco`, `$usuario` e `$senha` em `src/conecta.php` e ajuste-as para seu ambiente. O PHP precisa ter a extensão `pdo_mysql` habilitada.
3. Na raiz do projeto, inicie o servidor PHP:

```sh
php -S localhost:8000
```

Abra `http://localhost:8000` no navegador.
