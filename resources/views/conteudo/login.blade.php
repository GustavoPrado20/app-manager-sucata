<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" href="{{ asset('css/login.css') }}">

        <script src="https://kit.fontawesome.com/cf6fa412bd.js" crossorigin="anonymous"></script>

        <title>Sucata</title>
    </head>

    <body>
       <main class="main-container">
            <section class="left-container">
                <h1>Faça Login<br>Diretoria Sucata F.C</h1>
                <figure>
                    <img src="{{ asset('img/icones/Team lineup-bro.svg') }}" alt="Figura" class="left-img">
                </figure>
            </section>

            <section class="rigth-container">
                <section class="container-form">
                    <section class="btn-form">
                        <section class="btn-color"></section>
                        <button id="btnSignIn">Sign In</button>
                        <button id="btnSignUp">Sign Up</button>
                    </section>

                    <form action="{{ route('Logar-diretor') }}" id="signIn" name="signInF" method="POST">
                        @csrf
                        <input type="text" placeholder="Email" name="email" class="input-signIn" id="email">
                        <i class="fas fa-envelope iEmail"></i>
                        <span class='erro-validacao msg-email  @if(!empty($erroLogin)) template @endif'>
                            @if (!empty($erroLogin))
                                {{ $erroLogin }}
                            @endif
                        </span>

                        <input type="password" placeholder="Password" name="password" class="input-signIn" id="password" autocomplete="on">
                        <i class="fas fa-lock iPassword"></i>
                        <span class='erro-validacao2 msg-password  @if(!empty($erroLogin)) template @endif'>
                            @if(!empty($erroLogin))
								{{ $erroLogin }}
							@endif
                        </span>

                        <section class="container-check-login">
                            <input type="checkbox" />
                            <span>Remember Password</span>
                        </section>

                        <input type="submit" name="signIn" value="Sign In">
                    </form>

                    <form action="{{ route('registrar-diretor') }}" id="signUp" name="signUpF" method="POST">
                        @csrf
                        <h6>Função inativa - todos os diretores ja estão registrados!</h6>
                        <input type="text" placeholder="Nome" name="nome" class="input-signUp" id="nome">
                        <i class="fas fa-user iUser"></i>
                        <span class='erro-validacao-nome msg-nome'></span>

                        <input type="text" placeholder="Email" name="email" class="input-signUp" id="emailR">
                        <i class="fas fa-envelope iEmail2"></i>
                        <span class='erro-validacao-email msg-emailR'></span>

                        <input type="password" placeholder="Password" name="password" class="input-signUp" id="passwordR" autocomplete="on">
                        <i class="fas fa-lock iPassword1"></i>
                        <span class='erro-validacao-password msg-passwordR'></span>

                        <input type="password" placeholder="Password Confirmation" name="password-confirmation" autocomplete="on" class="input-signUp" id="password-confirmation">
                        <i class="fas fa-lock iPassword2"></i>
                        <span class='erro-validacao-password-confirmation msg-password-confirmation'></span>

                        <section class="container-check-register">
                            <input type="checkbox" required/>
                            <span>I accept all <a href="">Terms</a></span>
                        </section>

                        <input type="submit" name="signUp" value="Sign UP">
                    </form>
                </section>
            </section>
       </main> 
       <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
       <script type="text/javascript" src="{{ asset('js/cadastro-validation.js') }}"></script>
       <script type="text/javascript" src="{{ asset('js/login-validation.js') }}"></script>
    </body>
</html>