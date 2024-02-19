# Sistema de Gerenciamento de Time de Futebol Amador
 
## Descrição do Projeto
<p>
    Este projeto consiste em uma aplicação web desenvolvida em Laravel, uma estrutura PHP para desenvolvimento web, destinada ao gerenciamento de um time de futebol amador. O objetivo principal do sistema é facilitar a gestão de diversas atividades relacionadas ao time, como o controle da artilharia dos jogadores, ranking de cartões, gerenciamento de faltas, controle de valores recebidos mensalmente e anualmente, financiamentos, registro de resultados dos jogos, tabela de pontuação e controle de dívidas dos jogadores.
</p>

## Tecnologias Utilizadas
<ul>
    <li>Laravel (Framework PHP)</li>
    <li>MySQL (Banco de Dados)</li>
    <li>CSS</li>
    <li>JavaScript</li>
    <li>Livewire (Para interações dinâmicas)</li>
    <li>Chart.js (Para visualização de dados em gráficos)</li>
    <li>Laravel Sail e Docker (Para ambiente de desenvolvimento)</li>
    <li>npm (Para gerenciamento de dependências JavaScript)</li>
</ul>

## Objetivo
<p>
    Este webapp foi desenvolvido com o propósito de resolver um problema real enfrentado pelo time de futebol amador, que enfrentava dificuldades na organização e gestão dos dados dos jogadores, jogos e finanças. Anteriormente, essas atividades eram realizadas manualmente em planilhas impressas, o que frequentemente resultava na perda de dados e falta de organização. Com esta aplicação, busca-se oferecer uma solução digital que simplifique e agilize o gerenciamento do time, proporcionando maior eficiência e precisão na gestão das informações.
</p>

<p>
    Os jogadores terão acesso a algumas informações como o ranking de artilharia e de cartões, as faltas e a tabela de pontos do time. No entanto, somente o administrador ou diretor do time terá permissão para alterar, adicionar ou remover informações.
</p>

## Funcionalidades Principais

<ul>
    <li><b>Gerenciamento de Artilharia:</b> Registra e acompanha os gols marcados por cada jogador ao longo da temporada.</li>
    <li><b>Ranking de Cartões:</b> Mantém um registro dos cartões recebidos pelos jogadores e os classifica em um ranking.</li>
    <li><b>Gerenciamento de Faltas:</b> Permite registrar e acompanhar as faltas cometidas pelos jogadores.</li>
    <li><b>Controle Financeiro:</b> Registra os valores recebidos mensalmente e anualmente, além de gerenciar financiamentos e dívidas dos jogadores.</li>
    <li><b>Resultados dos Jogos:</b> Permite o registro dos resultados de cada partida, incluindo placar final e adversário.</li>
    <li><b>Tabela de Pontuação:</b> Mantém uma tabela atualizada com a pontuação do time ao longo do campeonato ou temporada.</li>
</ul>

## Instalação
<ol>
    <li>Certifique-se de ter o Docker e o Docker Compose instalados em sua máquina.</li>
    <li>Clone este repositório: <b>git clone https://github.com/GustavoPrado20/app-manager-sucata.git</b></li>
    <li>Instale as dependências do Composer: <b>composer install</b></li>
    <li>execute os comandos: <b>npm install</b> && <b>npm install chart.js</b></li>
    <li>Gere uma chave de aplicativo Laravel: <b>php artisan key:generate</b></li>
    <li>Acesse o diretório do projeto e execute o comando <b>./vendor/bin/sail up</b> para iniciar o ambiente de desenvolvimento com o Laravel Sail e Docker.</li>
    <li>Copie o arquivo <b>.env.example</b> para <b>.env</b> e configure seu ambiente (banco de dados, etc.).</li>
    <li>Crie sua Chave de Autenticação de Registro de Usuario Manualmente em seu arquivo <b>.env</b>.</li>
    <li>Execute as migrações do banco de dados: <b>php artisan migrate</b></li>
    <li>Acesse a aplicação em seu navegador: <b>http://localhost</b></li>
</ol>

## Contribuindo

<p>
    Contribuições são bem-vindas! Sinta-se à vontade para abrir um PR (Pull Request) com melhorias, correções de bugs ou novas funcionalidades.
</p>

## Licença

<p>
    Este projeto está licenciado sob a MIT License.
</p>
