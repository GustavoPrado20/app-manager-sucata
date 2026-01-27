@extends('layouts.esqueleto')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/financas.css') }}">
    <script src="{{ asset('js/chart.umd.js') }}"></script>
@endsection

@section('conteudo')
    <main>
        <section class="container-principal-1">
            <section class="container-card-finanças">
                <section class="card-finanças">
                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-saldo-de-vendas-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Saldo Atual</h3>
                            <p>R$ {{ ($receitas) - $despesaTotal}},00</p>
                        </section>
                    </section>

                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-receita-seta-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Receitas</h3>
                            <p>R$ {{ $receitas }},00</p>
                        </section>
                    </section>

                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-despesa-seta-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Despesas</h3>
                            <p>R$ {{ $despesaTotal }},00</p>
                        </section>
                    </section>

                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-futuro-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Saldo Prev. Dez</h3>
                            <p>R$ {{ $totalFuturo - $despesaTotal }},00</p>
                        </section>
                    </section>
                </section>
            </section>
            
            <section class="container-duplo">
                <section class="container-card" id="container-card-1">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-receitas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-lucro-50.png') }}" alt="">
                                    <h1>Receitas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas id="receitas"></canvas>
                                <script>
                                    // Dados do gráfico
                                    var data = {
                                        labels: [
                                            @if(!empty($mensalidades)) 
                                                'Mensalidades', 
                                            @endif 
                                            
                                            @if(!empty($FaltasPagasMes)) 
                                                'Faltas', 
                                            @endif 
                                            
                                            @if(!empty($cartoes)) 
                                                'Cartoes', 
                                            @endif
                                        ],
                                        datasets: [{
                                            label: 'Valor',
                                            data: [
                                                @if(!empty($mensalidades)) 
                                                    {{ $mensalidades }}, 
                                                @endif 
                                                
                                                @if(!empty($FaltasPagasMes)) 
                                                    {{ $FaltasPagasMes }}, 
                                                @endif 
                                                
                                                @if(!empty($cartoes)) 
                                                    {{ $cartoes }} 
                                                @endif
                                            ],
                                            backgroundColor: [
                                                @if(!empty($mensalidades)) 
                                                    '#003F04', 
                                                @endif 
                                                
                                                @if(!empty($FaltasPagasMes)) 
                                                    '#009309', 
                                                @endif 
                                                
                                                @if(!empty($cartoes)) 
                                                    '#00DC0E', 
                                                @endif
                                            ],
                                        }]
                                    };
                            
                                    // Opções do gráfico
                                    var options = {
                                        cutout: '75%', // Define o tamanho do "buraco" no centro
                                        plugins: {
                                            legend: {
                                                display: true, // Desativa/Ativa a exibição padrão da legenda
                                            },
                                        },
                                        animation: {
                                            animateRotate: true, // Desativa/Ativa a animação de rotação
                                            animateScale: true, // Desativa/Ativa a animação de escala

                                            onProgress: function(animation) {
                                                // Desenha o valor no centro do gráfico durante a animação
                                                var centerX = myDoughnutChart.canvas.width /2;
                                                var centerY = myDoughnutChart.canvas.height /2;
                                                var centerText = 'R$ {{ ($FaltasPagasMes + $cartoes + $mensalidades) }},00'; // Seu valor desejado

                                                ctx.font = 'bold 40px Josefin Sans';
                                                ctx.fillStyle = '#168316'; // Cor do texto
                                                ctx.textAlign = 'center';
                                                ctx.textBaseline = 'hanging';
                                                ctx.fillText(centerText, centerX, centerY);
                                            }
                                        },
                                        tooltips: {
                                            enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                        },
                                    };
                            
                                    // Criação do gráfico
                                    var ctx = document.getElementById('receitas').getContext('2d');
                                    var myDoughnutChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: data,
                                        options: options,
                                    });
                                </script>
                            </section>
                        </section>
                   </section>
                </section>

                <section class="container-card" id="container-card-2">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-receitas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-lucro-50.png') }}" alt="">
                                    <h1>Receitas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas id="receitas2"></canvas>
                                <script>
                                    // Dados do gráfico
                                    var data = {
                                        labels: [
                                            @if(!empty($mensalidades)) 
                                                'Mensalidades', 
                                            @endif 
                                            
                                            @if(!empty($FaltasPagasMes)) 
                                                'Faltas', 
                                            @endif 
                                            
                                            @if(!empty($cartoes)) 
                                                'Cartoes', 
                                            @endif
                                        ],
                                        datasets: [{
                                            label: 'Valor',
                                            data: [
                                                @if(!empty($mensalidades)) 
                                                    {{ $mensalidades }}, 
                                                @endif 
                                                
                                                @if(!empty($FaltasPagasMes)) 
                                                    {{ $FaltasPagasMes }}, 
                                                @endif 
                                                
                                                @if(!empty($cartoes)) 
                                                    {{ $cartoes }} 
                                                @endif
                                            ],
                                            backgroundColor: [
                                                @if(!empty($mensalidades)) 
                                                    '#003F04', 
                                                @endif 
                                                
                                                @if(!empty($FaltasPagasMes)) 
                                                    '#009309', 
                                                @endif 
                                                
                                                @if(!empty($cartoes)) 
                                                    '#00DC0E', 
                                                @endif
                                            ],
                                        }]
                                    };
                            
                                    // Opções do gráfico
                                    var options = {
                                        cutout: '75%', // Define o tamanho do "buraco" no centro
                                        plugins: {
                                            legend: {
                                                display: true, // Desativa/Ativa a exibição padrão da legenda
                                            },
                                        },
                                        animation: {
                                            animateRotate: true, // Desativa/Ativa a animação de rotação
                                            animateScale: true, // Desativa/Ativa a animação de escala

                                            onProgress: function(animation) {
                                                // Desenha o valor no centro do gráfico durante a animação
                                                var centerX = myDoughnutChart2.canvas.width / 4;
                                                var centerY = myDoughnutChart2.canvas.height / 4;
                                                var centerText = 'R$ {{ ($FaltasPagasMes + $cartoes + $mensalidades) }},00'; // Seu valor desejado

                                                ctx2.font = 'bold 40px Josefin Sans';
                                                ctx2.fillStyle = '#168316'; // Cor do texto
                                                ctx2.textAlign = 'center';
                                                ctx2.textBaseline = 'hanging';
                                                ctx2.fillText(centerText, centerX, centerY);
                                            }
                                        },
                                        tooltips: {
                                            enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                        },
                                    };
                            
                                    // Criação do gráfico
                                    var ctx2 = document.getElementById('receitas2').getContext('2d');
                                    var myDoughnutChart2 = new Chart(ctx2, {
                                        type: 'doughnut',
                                        data: data,
                                        options: options,
                                    });
                                </script>
                            </section>
                        </section>
                   </section>
                </section>

                <section class="container-card" id="container-card-3">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-receitas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-lucro-50.png') }}" alt="">
                                    <h1>Receitas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas id="receitas3"></canvas>
                                <h2>R$ {{ ($FaltasPagasMes + $cartoes + $mensalidades) }},00</h2>
                                <script>
                                    // Dados do gráfico
                                    var data = {
                                        labels: [
                                            @if(!empty($mensalidades)) 
                                                'Mensalidades', 
                                            @endif 
                                            
                                            @if(!empty($FaltasPagasMes)) 
                                                'Faltas', 
                                            @endif 
                                            
                                            @if(!empty($cartoes)) 
                                                'Cartoes', 
                                            @endif
                                        ],
                                        datasets: [{
                                            label: 'Valor',
                                            data: [
                                                @if(!empty($mensalidades)) 
                                                    {{ $mensalidades }}, 
                                                @endif 
                                                
                                                @if(!empty($FaltasPagasMes)) 
                                                    {{ $FaltasPagasMes }}, 
                                                @endif 
                                                
                                                @if(!empty($cartoes)) 
                                                    {{ $cartoes }} 
                                                @endif
                                            ],
                                            backgroundColor: [
                                                @if(!empty($mensalidades)) 
                                                    '#003F04', 
                                                @endif 
                                                
                                                @if(!empty($FaltasPagasMes)) 
                                                    '#009309', 
                                                @endif 
                                                
                                                @if(!empty($cartoes)) 
                                                    '#00DC0E', 
                                                @endif
                                            ],
                                        }]
                                    };
                            
                                    // Opções do gráfico
                                    var options = {
                                        cutout: '60%', // Define o tamanho do "buraco" no centro
                                        plugins: {
                                            legend: {
                                                display: true, // Desativa/Ativa a exibição padrão da legenda
                                            },
                                        },
                                        animation: {
                                            animateRotate: true, // Desativa/Ativa a animação de rotação
                                            animateScale: true, // Desativa/Ativa a animação de escala
                                        },
                                        tooltips: {
                                            enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                        },
                                    };
                            
                                    // Criação do gráfico
                                    var ctx3 = document.getElementById('receitas3').getContext('2d');
                                    var myDoughnutChart3 = new Chart(ctx3, {
                                        type: 'doughnut',
                                        data: data,
                                        options: options,
                                    });
                                </script>
                            </section>
                        </section>
                   </section>
                </section>

                <section class="container-card" id="container-card-despesa-1">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-despesas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-despesa-40.png') }}" alt="">
                                    <h1>Despesas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas id="despesas"></canvas>
                                <script>
                                    // Dados do gráfico
                                    var data = {
                                        labels: [
                                            @if(!empty($despesaJuizMes))
                                                'Juiz', 
                                            @endif 
                                             
                                            @if(!empty($totalOutraDespesaMes)) 
                                                'Outros', 
                                            @endif
                                        ],
                                        datasets: [{
                                            data: [
                                                @if (!empty($despesaJuizMes))
                                                    {{ $despesaJuizMes }},
                                                @endif
                                                
                                                @if (!empty($totalOutraDespesaMes))
                                                    {{ $totalOutraDespesaMes }},
                                                @endif
                                            ],

                                            label: 'Valor',
                                            backgroundColor: [
                                                @if (!empty($despesaJuizMes))
                                                    '#910000',
                                                @endif    
                                                
                                                @if (!empty($totalOutraDespesaMes))
                                                    '#D10000',
                                                @endif
                                            ],
                                        }]
                                    };
                            
                                    // Opções do gráfico
                                    var options = {
                                        cutout: '75%', // Define o tamanho do "buraco" no centro
                                        plugins: {
                                            legend: {
                                                display: true, // Desativa/Ativa a exibição padrão da legenda
                                            },
                                        },
                                        animation: {
                                            animateRotate: true, // Desativa/Ativa a animação de rotação
                                            animateScale: true, // Desativa/Ativa a animação de escala

                                            onProgress: function(animation) {
                                                // Desenha o valor no centro do gráfico durante a animação
                                                var centerX = myDoughnutChartDespesas.canvas.width / 2;
                                                var centerY = myDoughnutChartDespesas.canvas.height / 2;
                                                var centerText = 'R$ {{ $despesaJuizMes + $totalOutraDespesaMes }},00'; // Seu valor desejado

                                                ctxDespesas.font = 'bold 40px Josefin Sans';
                                                ctxDespesas.fillStyle = '#c21919'; // Cor do texto
                                                ctxDespesas.textAlign = 'center';
                                                ctxDespesas.textBaseline = 'hanging';
                                                ctxDespesas.fillText(centerText, centerX, centerY);
                                            }
                                        },
                                        tooltips: {
                                            enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                        },
                                    };
                            
                                    // Criação do gráfico
                                    var ctxDespesas = document.getElementById('despesas').getContext('2d');
                                    var myDoughnutChartDespesas = new Chart(ctxDespesas, {
                                        type: 'doughnut',
                                        data: data,
                                        options: options,
                                    });
                                </script>
                            </section>
                        </section>
                   </section>
                </section>

                <section class="container-card" id="container-card-despesa-2">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-despesas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-despesa-40.png') }}" alt="">
                                    <h1>Despesas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas id="despesas2"></canvas>
                                <script>
                                    // Dados do gráfico
                                    var data = {
                                        labels: [
                                            @if(!empty($despesaJuizMes))
                                                'Juiz', 
                                             @endif 
                                             
                                             @if(!empty($totalOutraDespesaMes)) 
                                                'Outros', 
                                             @endif
                                            ],
                                        datasets: [{
                                            data: [
                                                @if (!empty($despesaJuizMes))
                                                    {{ $despesaJuizMes }},
                                                @endif
                                                
                                                @if (!empty($totalOutraDespesaMes))
                                                    {{ $totalOutraDespesaMes }}
                                                @endif
                                            ],
                                            label: 'Valor',
                                            backgroundColor: [
                                                @if (!empty($despesaJuizMes))
                                                    '#910000',
                                                @endif    
                                                
                                                @if (!empty($totalOutraDespesaMes))
                                                    '#D10000',
                                                @endif
                                            ],
                                        }]
                                    };
                            
                                    // Opções do gráfico
                                    var options = {
                                        cutout: '75%', // Define o tamanho do "buraco" no centro
                                        plugins: {
                                            legend: {
                                                display: true, // Desativa/Ativa a exibição padrão da legenda
                                            },
                                        },
                                        animation: {
                                            animateRotate: true, // Desativa/Ativa a animação de rotação
                                            animateScale: true, // Desativa/Ativa a animação de escala

                                            onProgress: function(animation) {
                                                // Desenha o valor no centro do gráfico durante a animação
                                                var centerX = myDoughnutChartDespesas2.canvas.width / 4;
                                                var centerY = myDoughnutChartDespesas2.canvas.height / 4;
                                                var centerText = 'R$ {{ $despesaJuizMes + $totalOutraDespesaMes}},00'; // Seu valor desejado

                                                ctxDespesas2.font = 'bold 40px Josefin Sans';
                                                ctxDespesas2.fillStyle = '#c21919'; // Cor do texto
                                                ctxDespesas2.textAlign = 'center';
                                                ctxDespesas2.textBaseline = 'hanging';
                                                ctxDespesas2.fillText(centerText, centerX, centerY);
                                            }
                                        },
                                        tooltips: {
                                            enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                        },
                                    };
                            
                                    // Criação do gráfico
                                    var ctxDespesas2 = document.getElementById('despesas2').getContext('2d');
                                    var myDoughnutChartDespesas2 = new Chart(ctxDespesas2, {
                                        type: 'doughnut',
                                        data: data,
                                        options: options,
                                    });
                                </script>
                            </section>
                        </section>
                   </section>
                </section>

                <section class="container-card" id="container-card-despesa-3">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-despesas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-despesa-40.png') }}" alt="">
                                    <h1>Despesas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas id="despesas3"></canvas>
                                <h2>R$ {{ $despesaJuizMes + $totalOutraDespesaMes}},00</h2>
                                <script>
                                    // Dados do gráfico
                                    var data = {
                                        labels: [
                                            @if(!empty($despesaJuizMes))
                                                'Juiz', 
                                             @endif 
                                             
                                             @if(!empty($totalOutraDespesaMes)) 
                                                'Outros', 
                                             @endif
                                            ],
                                        datasets: [{
                                            data: [
                                                @if (!empty($despesaJuizMes))
                                                    {{ $despesaJuizMes }},
                                                @endif
                                                
                                                @if (!empty($totalOutraDespesaMes))
                                                    {{ $totalOutraDespesaMes }}
                                                @endif
                                            ],
                                            label: 'Valor',
                                            backgroundColor: [
                                                @if (!empty($despesaJuizMes))
                                                    '#910000',
                                                @endif    
                                                
                                                @if (!empty($totalOutraDespesaMes))
                                                    '#D10000',
                                                @endif
                                            ],
                                        }]
                                    };
                            
                                    // Opções do gráfico
                                    var options = {
                                        cutout: '60%', // Define o tamanho do "buraco" no centro
                                        plugins: {
                                            legend: {
                                                display: true, // Desativa/Ativa a exibição padrão da legenda
                                            },
                                        },
                                        animation: {
                                            animateRotate: true, // Desativa/Ativa a animação de rotação
                                            animateScale: true, // Desativa/Ativa a animação de escala
                                        },
                                        tooltips: {
                                            enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                        },
                                    };
                            
                                    // Criação do gráfico
                                    var ctxDespesas3 = document.getElementById('despesas3').getContext('2d');
                                    var myDoughnutChartDespesas3 = new Chart(ctxDespesas3, {
                                        type: 'doughnut',
                                        data: data,
                                        options: options,
                                    });
                                </script>
                            </section>
                        </section>
                   </section>
                </section>
            </section>
        </section>



        <section class="container-principal-2">
            <section class="container-DR" id="container-receita-mes-1">
                <section class="table">
                    <section class="table-header-receitas">
                        <section class="titulo-table">
                            <img src="{{ asset('img/icones/icons8-lucro-50.png') }}" alt="">
                            <h1>Receitas no Ano</h1>  
                        </section>
                    </section>
                    
                    <section class="receitas-mes-body">
                        <canvas id="receitas_mes"></canvas>
                        <script>
                            // Dados do gráfico
                            var data = {
                                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', ' Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                                datasets: [{
                                    axis: 'x',
                                    data: [
                                        {{ $totalPagoMeses[0] }},
                                        {{ $totalPagoMeses[1] }},
                                        {{ $totalPagoMeses[2] }},
                                        {{ $totalPagoMeses[3] }},
                                        {{ $totalPagoMeses[4] }},
                                        {{ $totalPagoMeses[5] }},
                                        {{ $totalPagoMeses[6] }},
                                        {{ $totalPagoMeses[7] }},
                                        {{ $totalPagoMeses[8] }},
                                        {{ $totalPagoMeses[9] }},
                                        {{ $totalPagoMeses[10] }},
                                        {{ $totalPagoMeses[11] }},
                                    ],
                                    borderWidth: 1,
                                    backgroundColor: 'rgba(25, 194, 67, 0.4)',
                                    label: 'Valor Recebido  '
                                }]
                            };
                    
                            // Opções do gráfico
                            var options = {
                                indexAxis:'x',
                                plugins: {
                                    legend: {
                                        display: false, // Desativa/Ativa a exibição padrão da legenda
                                    },
                                },
                                animation: {
                                    animateRotate: true, // Desativa/Ativa a animação de rotação
                                    animateScale: true, // Desativa/Ativa a animação de escala
                                },
                                tooltips: {
                                    enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: true
                            };
                    
                            // Criação do gráfico
                            var ctxReceitas_mes = document.getElementById('receitas_mes').getContext('2d');
                            var myDoughnutChartReceitas_mes = new Chart(ctxReceitas_mes, {
                                type: 'bar',
                                data: data,
                                options: options,
                            });
                        </script>
                    </section>
                </section>
           </section>

            <section class="container-DR" id="container-receita-mes-2">
                <section class="table">
                    <section class="table-header-receitas">
                        <section class="titulo-table">
                            <img src="{{ asset('img/icones/icons8-lucro-50.png') }}" alt="">
                            <h1>Receitas no Ano</h1>  
                        </section>
                    </section>
                    
                    <section class="receitas-mes-body">
                        <canvas id="receitas_mes2"></canvas>
                        <script>
                            // Dados do gráfico
                            var data = {
                                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', ' Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                                datasets: [{
                                    axis: 'y',
                                    data: [
                                        {{ $totalPagoMeses[0] }},
                                        {{ $totalPagoMeses[1] }},
                                        {{ $totalPagoMeses[2] }},
                                        {{ $totalPagoMeses[3] }},
                                        {{ $totalPagoMeses[4] }},
                                        {{ $totalPagoMeses[5] }},
                                        {{ $totalPagoMeses[6] }},
                                        {{ $totalPagoMeses[7] }},
                                        {{ $totalPagoMeses[8] }},
                                        {{ $totalPagoMeses[9] }},
                                        {{ $totalPagoMeses[10] }},
                                        {{ $totalPagoMeses[11] }},
                                    ],
                                    borderWidth: 1,
                                    backgroundColor: 'rgba(25, 194, 67, 0.4)',
                                    label: 'Valor Recebido  '
                                }]
                            };
                    
                            // Opções do gráfico
                            var options = {
                                indexAxis:'y',
                                plugins: {
                                    legend: {
                                        display: false, // Desativa/Ativa a exibição padrão da legenda
                                    },
                                },
                                animation: {
                                    animateRotate: true, // Desativa/Ativa a animação de rotação
                                    animateScale: true, // Desativa/Ativa a animação de escala
                                },
                                tooltips: {
                                    enabled: false, // Desativa/Ativa as dicas de ferramentas padrão
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: true
                            };
                    
                            // Criação do gráfico
                            var ctxReceitas_mes2 = document.getElementById('receitas_mes2').getContext('2d');
                            var myDoughnutChartReceitas_mes2 = new Chart(ctxReceitas_mes2, {
                                type: 'bar',
                                data: data,
                                options: options,
                            });
                        </script>
                    </section>
                </section>
            </section>
        </section>

        <section class="container-principal-3">
            @if ($LoginAuth)
                <section class="container-DR">
                    <section class="table">
                        <section class="table-header-dividas">
                            <section class="titulo-table">
                                <img src="{{ asset('img/icones/icons8-divida-40.png') }}" alt="">
                                <h1>Dividas Membros</h1>
                            </section>
                        </section>
                        
                        <section class="table-body">
                            <table>
                                <thead class="thead-dividas">
                                    <tr>
                                        <th>Ano</th>                                
                                        <th>Nome</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($dividas as $divida)
                                        <tr>
                                            <td>{{ $divida['ano'] }}</td>
                                            @foreach ($divida->NomeMembro as $dadosMembro)
                                                <td>{{ $dadosMembro->nome }} @if (!empty($dadosMembro->apelido)) ({{ $dadosMembro->apelido }}) @endif</td>
                                            @endforeach
                                            <td>R$ {{ $divida['total-divida'] }},00</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </section>
                </section>
            @endif

            <section class="container-DR">
                <section class="table">
                    <section class="table-header-receitas">
                        <section class="titulo-table">
                            <img src="{{ asset('img/icones/icons8-lucro-50.png') }}" alt="">
                            <h1>Receitas</h1>
                        </section>

                        @livewire('ModalAddReceita', ['dadosMembros' => $dadosMembros, 'LoginAuth' => $LoginAuth])
                    </section>
                    
                    <section class="table-body">
                        <table>
                            <thead class="thead-receitas">
                                <tr>
                                    <th>Data</th>                                
                                    <th>Referencia</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!empty($dadosReceitas))
                                    @foreach ($dadosReceitas as $dadoReceita)
                                        <tr>
                                            <td>{{ date('d/m/Y', strtotime($dadoReceita['data'])) }}</td>
                                            <td>{{ $dadoReceita['referencia'] }}</td>
                                            <td>R$ {{ $dadoReceita['valor'] }},00</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </section>
                </section>
            </section>

            <section class="container-DR">
                <section class="table">
                    <section class="table-header-despesas">
                        <section class="titulo-table">
                            <img src="{{ asset('img/icones/icons8-despesa-40.png') }}" alt="">
                            <h1>Despesas</h1>
                        </section>

                        @livewire('ModalAddDispesa', ['LoginAuth' => $LoginAuth])
                    </section>
                    
                    <section class="table-body">
                        <table>
                            <thead class="thead-despesas">
                                <tr>
                                    <th>Data</th>                                
                                    <th>Referencia</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @if(!empty($dadosDespesas))
                                    @foreach ($dadosDespesas as $dadoDespesa)
                                        <tr>
                                            <td>{{ date('d/m/Y', strtotime($dadoDespesa['data'])) }}</td>
                                            <td>{{ $dadoDespesa['referencia'] }}</td>
                                            <td>R$ {{ $dadoDespesa['valor'] }},00</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </section>
                </section>
           </section>

            @if ($LoginAuth)
                <section class="container-anual-btn">
                    <section class="btns-anual">
                        <form action="{{ route('criarMensalidade') }}" name="Criar Mensalidades" method="POST">
                            @csrf
                            <button type="submit" id="btn-criar-mensalidade">Mensalidades</button>
                        </form>
    
                        <form action="{{ route('resetarAno') }}" name="Resetar Ano" method="POST">
                            @csrf
                            <button type="submit" id="btn-resetar-ano">Resetar Ano</button>
                        </form>
                    </section>
               </section>
            @endif
        </section>
    </main>
@endsection
