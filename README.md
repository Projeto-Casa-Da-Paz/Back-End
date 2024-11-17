
# Casa da Paz - API Backend

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

![Version](https://img.shields.io/badge/version-0.1.0-blue.svg)  
![Laravel](https://img.shields.io/badge/Laravel-11.9-red)  
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)

## 📋 Sobre o Projeto

API backend desenvolvida para atender às funcionalidades do site institucional e dashboard administrativo da **Associação Assistencial e Promocional Casa da Paz**. Esta aplicação gerencia os dados principais, como informações institucionais, atividades, projetos e usuários, oferecendo suporte a operações seguras e otimizadas.

### 🔗 Repositórios do Projeto
- [Website Institucional](https://github.com/Projeto-Casa-Da-Paz/Page) - Frontend principal  
- [API Backend](https://github.com/Projeto-Casa-Da-Paz/Back-End)  
- [Dashboard Administrativo](https://github.com/Projeto-Casa-Da-Paz/Dashboard)  

Acesse a organização completa no [GitHub da Casa da Paz](https://github.com/Projeto-Casa-Da-Paz).

### 👨‍💻 Desenvolvedores

Desenvolvido por:

- [Daniel Oliveira](https://github.com/danielsz3) - Frontend Developer  
- [Felipe Gustavo](https://github.com/devfelipegustavo) - Backend Developer  
- [João Gabryel](https://github.com/JoaoGabryel) - Frontend Developer  

## 🛠 Tecnologias Utilizadas

- *Framework*: Laravel 11.9  
- *Linguagem*: PHP 8.2+  
- *Autenticação*: Laravel Sanctum e JWT Auth  
- *Banco de Dados*: MySQL (ou compatível)  
- *Gerenciamento de Dados*: Seeders e Factories  
- *Testes*: PHPUnit e Mockery  

## 🚀 Como Executar

1. **Pré-requisitos**
   - PHP 8.2 ou superior  
   - Composer  
   - Banco de Dados MySQL  
   - Node.js (opcional para Laravel Mix)  

2. **Clone o repositório**  
   ```bash
   git clone https://github.com/Projeto-Casa-Da-Paz/Back-End.git
   cd back-end
   ```

3. **Instale as dependências**  
   ```bash
   composer install
   ```

4. **Configure o ambiente**  
   - Crie o arquivo `.env` com base no `.env.example`.  
   - Configure as variáveis de ambiente para o banco de dados e outras credenciais.  
   ```bash
   php artisan key:generate
   ```

5. **Execute as migrações e seeders**  
   ```bash
   php artisan migrate --seed
   ```

6. **Inicie o servidor de desenvolvimento**  
   ```bash
   php artisan serve
   ```

7. **Acesse o projeto**  
   Abra [http://localhost:8000](http://localhost:8000) no navegador.  

## 📦 Scripts Disponíveis

- `php artisan serve` - Inicia o servidor local  
- `php artisan migrate` - Executa as migrações  
- `php artisan db:seed` - Popula o banco de dados com dados fictícios  
- `composer test` - Executa os testes automatizados  

## 🏗 Estrutura do Projeto

- **App/**: Contém os controladores, modelos e serviços  
- **Database/**: Migrações, seeders e factories  
- **Routes/**: Arquivos de rotas (`api.php` e `web.php`)  
- **Tests/**: Testes unitários e funcionais  

## 📝 Principais Funcionalidades

- Autenticação via Laravel Sanctum e JWT  
- Sistema de gerenciamento de usuários e permissões  
- Suporte a integração com o frontend e dashboard  
- Banco de dados relacional para gestão das entidades principais  
- Geração de dados fictícios com Faker para testes e desenvolvimento  

## 🤝 Contribuindo

Contribuições são sempre bem-vindas! Para contribuir:

1. Faça um fork do repositório  
2. Crie uma branch para sua feature  
3. Commit suas mudanças  
4. Push para a branch  
5. Abra um Pull Request  

Mais informações no [repositório principal](https://github.com/Projeto-Casa-Da-Paz).

## 📄 Licença

Este projeto é licenciado sob a [MIT License](https://opensource.org/licenses/MIT).

## 📞 Suporte

Para dúvidas ou suporte, entre em contato com:  
- [@danielsz3](https://github.com/danielsz3)  
- [@devfelipegustavo](https://github.com/devfelipegustavo)  
- [@JoaoGabryel](https://github.com/JoaoGabryel)  

Ou abra uma issue no repositório.  

---

**Desenvolvido com 💙 para a Casa da Paz.**
