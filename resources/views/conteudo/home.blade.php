@extends('layouts.esqueleto')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('conteudo')
    <main>
        <section class="container-1">
            <h1>Estatuto e Regulamento Sucata F.C (2024)</h1>
            <section class="container-grid">
                <section class="container-box">
                    <h2>Art. 1 - Sobre o jogo</h2>

                    <br>

                    <h3>1.1 - Horário e Localização:</h3>
                    <ul>
                        <li>
                            <p>
                                Os jogos da equipe serão realizados aos domingos, das 8:00 às 10:00, nos campos A e B do Estádio Municipal de Igaratá.
                            </p>
                        </li>

                        <li>
                            <p>
                                É recomendado que os jogadores cheguem com pelo menos 15 minutos de antecedência ao local das partidas.
                            </p>
                        </li>
                    </ul>

                    <br>

                    <h3>1.2 - Elegibilidade dos Participantes:</h3>
                    <ul>
                        <li>
                            <p>
                                Só poderá participar do jogo o associado que estiverem em dia com as suas
                                A participação nos jogos está restrita aos associados que estiverem em dia com suas obrigações junto ao clube, 
                                incluindo o pagamento de mensalidades e quaisquer outras taxas pertinentes.
                            </p>
                        </li> 
                    </ul>
                </section>
                    
                <section class="container-figure">
                    <figure>
                        <img src="{{ asset('img/figuras/Soccer.gif') }}" alt="Figura 1">
                    </figure>
                </section>
            </section>

            <section class="container-grid">
                <section class="container-figure">
                   <figure>
                       <img src="{{ asset('img/figuras/tules cinza.gif') }}" alt="Figura 2">
                   </figure>
                </section>

                <section class="container-box">
                   <h2>Art. 2 - Regras e Condutas:</h2>

                   <br>

                   <h3>2.1 - Respeito ao Árbitro e aos Jogadores:</h3>
                   <ul>
                       <li>
                           <p>
                               Todos os membros da equipe devem demonstrar respeito e fair play em relação aos colegas de equipe, 
                               adversários, árbitros e demais envolvidos.
                           </p>
                       </li>

                       <li>
                           <p>
                               Qualquer comportamento desrespeitoso, incluindo linguagem ofensiva ou gestos inadequados, 
                               não será tolerado e poderá resultar em penalidades.
                           </p>
                       </li>
                   </ul>

                   <br>

                   <h3>2.2 - Proibição de Brigas e Agressões:</h3>
                   <ul>
                       <li>
                           <p>
                               É terminantemente proibida qualquer forma de brigas, agressões físicas ou verbais entre os jogadores, 
                               durante ou fora dos jogos.
                           </p>
                       </li>

                       <li>
                           <p>
                               Conflitos devem ser resolvidos de forma pacífica e civilizada, priorizando o diálogo e o respeito mútuo.
                           </p>
                       </li>
                   </ul>
                </section>
           </section>
        </section>

        <section class="container-2">
            <section class="container-grid">
                 <section class="container-box">
                    <h3>2.3 - Cartões:</h3>
                    <ul>
                        <li>
                            <p>
                                O recebimento de cartões amarelos durante as partidas acarretará em multa de R$25,00. 
                                cuja receita será destinada a melhorias no time.
                            </p>
                        </li>

                        <li>
                            <p>
                                O cartão vermelho resultará em multa de R$30,00, podendo também acarretar em suspensão temporária, 
                                dependendo da gravidade da infração.
                            </p>
                        </li>
                    </ul>
                 </section>

                 <section class="container-box">
                    <h3>2.4 - Faltas:</h3>
                    <ul>
                        <li>
                            <p>
                                Ausências não justificadas em partidas implicarão em uma taxa de R$40,00. a ser paga pelo jogador ausente.
                            </p>
                        </li>

                        <li>
                            <p>
                                Atrasos superiores a 15 minutos do horário marcado para o jogo serão considerados faltas, 
                                sujeitando o jogador a penalidades determinadas pela equipe.
                            </p>
                        </li>
                    </ul>
                 </section>

                 <section class="container-box">
                    <h3>2.5 - Abandono do Campo:</h3>
                    <ul>
                        <li>
                            <p>
                                O abandono do campo sem justificativa resultará em multa de R$30,00. 
                                a ser paga antes da participação subsequente do jogador.
                            </p>
                        </li>

                        <li>
                            <p>
                                Situações como lesões graves ou emergências médicas são consideradas razões justificáveis para 
                                deixar o campo antes do término da partida.
                            </p>
                        </li>
                    </ul>
                 </section>

                <section class="container-box">
                    <h3>2.6 - Mensalidades e Contribuições:</h3>
                    <ul>
                        <li>
                            <p>
                                Cada jogador compromete-se a pagar uma mensalidade fixa de R$50,00, 
                                destinada a despesas operacionais do time e organização de eventos sociais.
                            </p>
                        </li>

                        <li>
                            <p>
                                Os sócios que não são jogadores deverão contribuir com R$30,00 mensais, tendo direito a benefícios específicos, 
                                como ingressos para eventos.
                            </p>
                        </li>
                    </ul>
                 </section>
            </section>
        </section>

        <section class="container-3">
            <section class="container-grid">
                <section class="container-box">
                    <h2>Art. 3 - Confraternização:</h2>

                    <br>

                    <h3>3.1 - Participação na Confraternização:</h3>
                    <ul>
                        <li>
                            <p>
                                Todos os jogadores e sócios-torcedores em dia com suas mensalidades terão direito a participar da 
                                confraternização anual do time.
                            </p>
                        </li>

                        <li>
                            <p>
                                Crianças até 12 anos não necessitam de ingressos para participar da confraternização.
                            </p>
                        </li>
                    </ul>

                    <br>

                    <h3>3.2 - Ingressos para a Confraternização:</h3>
                    <ul>
                        <li>
                            <p>
                                A quantidade de ingressos disponíveis para jogadores e sócios varia conforme a regularidade de suas 
                                contribuições ao longo do ano, conforme determinado pela diretoria.
                            </p>
                        </li>
                        
                        <li>
                            <p>
                                Convites avulsos para a confraternização poderão ser adquiridos mediante o pagamento de uma taxa de R$150,00 por pessoa.
                            </p>
                        </li>
                    </ul>
                </section>
                    
                <section class="container-figure">
                    <figure>
                        <img src="{{ asset('img/figuras/Swimsuit party cinza.gif') }}" alt="Figura 3">
                    </figure>
                </section>
            </section>
        </section>
    </main>
@endsection