# products-srp-demo

Caio Garbin Silva - 1988521
João Vitor Alves  - 1993855

## Execução
1. Acesse o xampp e ative o apache
2. Coloque a pasta em `htdocs`.
3. Rode `composer dump-autoload`.
4. Acesse:
   - `http://localhost/products-srp-demo/public/index.php`
   - `http://localhost/products-srp-demo/public/products.php`

## Casos de teste
1. Nome curto → erro
2. Preço negativo → erro
3. Cadastro válido → aparece na listagem
4. Lista vazia → mostra "Nenhum produto cadastrado"
