var form = document.getElementById("signIn");

if (form.addEventListener) {
    form.addEventListener("submit", validaLogin);
} else if (form.attachEvent) {
    form.attachEvent("onsubmit", validaLogin);
}

function validaLogin(evt) {
    var email = document.getElementById('email');
    var senha = document.getElementById('password');
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var contErro = 0;


    /* Validação do campo email */
    caixa_email = document.querySelector('.msg-email');
    if (email.value == "") {
        caixa_email.innerHTML = "Favor preencher o E-mail";
        caixa_email.style.display = 'block';
        contErro += 1;
    } else if (filtro.test(email.value)) {
        caixa_email.style.display = 'none';
    } else {
        caixa_email.innerHTML = "Formato do E-mail inválido";
        caixa_email.style.display = 'block';
        contErro += 1;
    }

    /* Validação do campo senha */
    caixa_senha = document.querySelector('.msg-password');
    if (senha.value == "") {
        caixa_senha.innerHTML = "Favor preencher a Senha";
        caixa_senha.style.display = 'block';
        contErro += 1;
    } else if (senha.value.length < 8) {
        caixa_senha.innerHTML = "Favor preencher a Senha com o mínimo de 6 caracteres";
        caixa_senha.style.display = 'block';
        contErro += 1;
    } else {
        caixa_senha.style.display = 'none';
    }

    if (contErro > 0) {
        evt.preventDefault();
    }
}