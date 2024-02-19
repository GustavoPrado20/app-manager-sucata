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
                        <input type="email" placeholder="Email" name="email" class="input-signIn" id="email" autocomplete="email">
                        <i class="fas fa-envelope iEmail"></i>
                        <span class='erro-validacao msg-email  @if(!empty($erroLogin)) template @endif'>
                            @if (!empty($erroLogin))
                                {{ $erroLogin }}
                            @endif
                        </span>

                        <input type="password" placeholder="Password" name="password" class="input-signIn" id="password" autocomplete="password">
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

                        <button type="submit">Sing In</button>
                    </form>

                    <form action="{{ route('registrar-diretor') }}" id="signUp" name="signUpF" method="POST">
                        @csrf
                        <input type="text" placeholder="Nome" name="nome" class="input-signUp" id="nome" autocomplete="name" value="{{ old('nome') }}">
                        <i class="fas fa-user iUser"></i>
                        @error('nome')
                            <span class='erro-validacao-nome'>
                                {{ $errors->first('nome') }}
                            </span>
                        @enderror

                        <input type="email" placeholder="Email" name="email" class="input-signUp" id="emailR" autocomplete="email" value="{{ old('email') }}">
                        <i class="fas fa-envelope iEmail2"></i>
                        @error('email')
                        <span class='erro-validacao-email'>
                            {{ $errors->first('email') }}
                        </span>
                        @enderror
                        
                        <input type="password" placeholder="Password" name="password" class="input-signUp" id="passwordR" autocomplete="password">
                        <i class="fas fa-lock iPassword1"></i>
                        @error('password')
                        <span class='erro-validacao-password'>
                            {{ $errors->first('password') }}
                        </span>
                        @enderror

                        <input type="text" placeholder="Chave de Autenticação" name="keyauth" autocomplete="on" class="input-signUp" id="password-confirmation">
                        <i class="fas fa-lock iPassword2"></i>
                        @error('keyauth')
                        <span class='erro-validacao-keyauth'>
                            {{ $errors->first('keyauth') }}
                        </span>
                        @enderror

                        <section class="container-check-register">
                            <input type="checkbox" required/>
                            <span>I accept all <a href="">Terms</a></span>
                        </section>

                        <button type="submit">Sing Up</button>
                    </form>
                </section>
            </section>
       </main> 
       <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
       
       <script type="text/javascript" src="{{ asset('js/login-validation.js') }}"></script>
    </body>
</html>