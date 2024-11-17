## Informações Básicas
- **Projeto**: Laravel/Laravel
- **Tipo**: Project
- **Descrição**: Aplicação esqueleto para o framework Laravel
- **Licença**: MIT

## Requisitos Principais
- PHP 8.2 ou superior
- Laravel Framework v11.9
- Laravel Sanctum v4.0 (autenticação API)
- Laravel Tinker v2.9 (REPL)
- JWT Auth v2.3 (autenticação via tokens)

## Dependências de Desenvolvimento
- FakerPHP (geração de dados fictícios)
- Laravel Pint (formatador de código)
- Laravel Sail (ambiente Docker)
- Mockery (mocking para testes)
- Collision (tratamento de erros)
- PHPUnit v11.0.1 (testes unitários)

## Autoload
- Namespace principal: `App\`
- Factories: `Database\Factories\`
- Seeders: `Database\Seeders\`
- Testes: `Tests\`

## Scripts Automatizados
- **Post-autoload**: Descoberta automática de pacotes
- **Post-update**: Publicação de assets do Laravel
- **Post-root-package**: Criação do arquivo `.env`
- **Post-create-project**: 
  - Geração da chave da aplicação
  - Execução das migrações

## Configurações
- Otimização de autoloader ativada
- Instalação preferencial via dist
- Ordenação de pacotes ativa
- Estabilidade mínima: dev
- Preferência por versões estáveis

Este `composer.json` configura um projeto Laravel moderno com suporte a autenticação via JWT, ambiente de desenvolvimento robusto e ferramentas para testes e qualidade de código.