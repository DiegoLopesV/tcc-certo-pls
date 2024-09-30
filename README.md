# tcc-laravel-2024
Projeto do nosso grupo do ano de 2024, informática 4 (IFPR Campus Curitiba)!

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Alunos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            text-align: center;
        }
        h2 {
            text-align: center;
            color: #555;
        }
        .content {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Sistema de Gerenciamento de Alunos</h1>
        <h2>Desenvolvido por: Bianca, Diego & João Pedro</h2>
        
        <h3>Tópicos</h3>
        <ul>
            <li><a href="#instalacao">1. Instalação</a></li>
        </ul>

        <h3 id="instalacao">1. Instalação</h3>
        
        <h4>Composer</h4>
        <p>Para instalar o Composer, siga os passos abaixo:</p>
        <ol>
            <li>Acesse o seguinte endereço: <a href="https://getcomposer.org/download/" target="_blank">getcomposer.org/download</a>.</li>
            <li>Clique no link azul "Composer-Setup.exe".</li>
            <li>Uma vez baixado, clique duas vezes no arquivo e selecione a primeira opção. Siga as instruções clicando em "Next" até concluir a instalação.</li>
        </ol>

        <h4>PHP</h4>
        <p>Para instalar o PHP, siga os passos abaixo:</p>
        <ol>
            <li>Acesse o site oficial do PHP: <a href="https://www.php.net/downloads.php" target="_blank">php.net/downloads.php</a>.</li>
            <li>Role a página para baixo e clique em "Windows Download" dentro da seção "Old Stable PHP 8.1.30 (Changelog)".</li>
            <li>Clique no botão "zip" para baixar a versão desejada.</li>
            <li>Extraia os arquivos do ZIP em uma pasta, como <code>C:\php</code>.</li>
            <li>Renomeie o arquivo <code>php.ini-development</code> para <code>php.ini</code>.</li>
            <li>Abra o arquivo <code>php.ini</code> e configure as opções conforme necessário (por exemplo, habilitando extensões).</li>
            <li>Adicione o diretório do PHP ao <strong>PATH</strong> do sistema:</li>
            <ul>
                <li>Vá em "Configurações do sistema" > "Variáveis de ambiente".</li>
                <li>Em "Variáveis do sistema", localize "Path" e clique em "Editar".</li>
                <li>Adicione o caminho <code>C:\php</code> e clique em "OK".</li>
            </ul>
        </ol>

        <h4>MySQL Workbench</h4>
        <p>Para instalar o MySQL Workbench, siga os passos abaixo:</p>
        <ol>
            <li>Acesse o site oficial do MySQL: <a href="https://dev.mysql.com/downloads/workbench/" target="_blank">dev.mysql.com/downloads/workbench</a>.</li>
            <li>Selecione sua plataforma (Windows, macOS ou Linux).</li>
            <li>Clique no botão "Download".</li>
            <li>Na página de download, escolha a versão mais recente compatível com seu sistema.</li>
            <li>Você pode fazer login na Oracle ou clicar em "No thanks, just start my download" para pular o login.</li>
            <li>Abra o arquivo baixado (<code>.exe</code> no Windows ou <code>.dmg</code> no macOS).</li>
            <li>Siga o assistente de instalação:</li>
            <ul>
                <li>Aceite os termos e condições.</li>
                <li>Escolha a pasta de instalação (use a padrão, a menos que tenha preferência específica).</li>
                <li>Clique em "Instalar" e aguarde a conclusão.</li>
            </ul>
            <li>Após a instalação, abra o Workbench a partir do menu de aplicativos ou diretamente no Windows/macOS.</li>
            <li>Configure sua conexão com o banco de dados MySQL para começar a utilizá-lo.</li>
        </ol>
    </div>
</body>
</html>


