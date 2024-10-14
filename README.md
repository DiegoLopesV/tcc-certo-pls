# tcc-laravel-2024
Projeto do nosso grupo do ano de 2024, informática 4 (IFPR Campus Curitiba)!

# Sistema de Gerenciamento de Alunos

### Desenvolvido por: Bianca, Diego & João Pedro

---

## Tópicos

1. [Instalação](#instalação)
2. [Como Executar o Arquivo](#como-executar-o-arquivo)

# Guia de Instalação do Projeto

Este guia irá orientá-lo na instalação da versão mais recente do PHP, Composer, MySQL Workbench, e na configuração do projeto Laravel.

## Instalação do PHP

1. **Baixe a versão mais recente do PHP:**
   - Acesse a [página oficial do PHP](https://www.php.net/downloads).
   - Descompacte o arquivo em uma pasta de sua escolha.
   
2. **Configurar variáveis de ambiente:**
   - Adicione o caminho da pasta do PHP às variáveis de ambiente (PATH).
   
3. **Configurações do PHP:**
   - Abra o arquivo `php.ini` e descomente as seguintes linhas removendo o `;`:
     ```
     ;extension=fileinfo
     ;extension=pdo_mysql
     ```

## Instalação do Composer

1. **Baixe o Composer:**
   - Visite a [página do Composer](https://getcomposer.org/download/) e siga as instruções de instalação.

## Instalação do MySQL Workbench

1. **Baixe e instale o MySQL Workbench:**
   - Acesse a [página do MySQL Workbench](https://dev.mysql.com/downloads/workbench/).
   - Crie um usuário root sem senha durante a configuração.

2. **Criação do banco de dados:**
   - Abra o MySQL Workbench e execute os seguintes comandos:
     ```sql
     CREATE DATABASE db_ifprtb;
     USE db_ifprtb;
     ```

## Instalação do Visual Studio Code

1. **Baixe e instale o Visual Studio Code:**
   - Acesse a [página do Visual Studio Code](https://code.visualstudio.com/Download).

## Clonando o Repositório

1. **Clone o repositório:**
   - Abra o terminal e execute o seguinte comando:
     ```bash
     git clone https://github.com/seuusuario/tcc-certo-pls.git
     ```

## Executando o Projeto

1. **Acesse a pasta do projeto:**
   - No terminal, execute os seguintes comandos:
     ```bash
     cd downloads
     cd tcc-certo-pls
     cd crudlaraveltb
     ```

2. **Execute as migrações do banco de dados:**
   ```bash
   php artisan migrate

---

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests.

---

## Licença

Este projeto é licenciado sob a [MIT License](LICENSE).
