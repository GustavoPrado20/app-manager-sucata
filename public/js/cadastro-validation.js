var form = document.getElementById("signUp");

if (form.addEventListener) {
	form.addEventListener("submit", validaCadastro);
} else if (form.attachEvent) {
	form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(evt) {
	var nome = document.getElementById('nome');
	var email = document.getElementById('emailR');
	var senha = document.getElementById('passwordR');
	var senha2 = document.getElementById('password-confirmation');
	var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var contErro = 0;


	/* Validação do campo nome */
	caixa_nome = document.querySelector('.msg-nome');
	if (nome.value == "") {
		caixa_nome.innerHTML = "Favor preencher o Nome";
		caixa_nome.style.display = 'block';
		contErro += 1;
	} else {
		caixa_nome.style.display = 'none';
	}

	/* Validação do campo email */
	caixa_email = document.querySelector('.msg-emailR');
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
	caixa_senha = document.querySelector('.msg-passwordR');
	if (senha.value == "") {
		caixa_senha.innerHTML = "Favor preencher a Senha";
		caixa_senha.style.display = 'block';
		contErro += 1;
	} else if (senha.value.length < 8) {
		caixa_senha.innerHTML = "Favor preencher a Senha com o mínimo de 8 caracteres";
		caixa_senha.style.display = 'block';
		contErro += 1;
	} else {
		caixa_senha.style.display = 'none';
	}

	/* Validação do campo repita a senha */
	caixa_senha2 = document.querySelector('.msg-password-confirmation');
	if (senha2.value == "") {
		caixa_senha2.innerHTML = "Favor preencher o campo Confirmação de Senha";
		caixa_senha2.style.display = 'block';
		contErro += 1;
	} else if (senha2.value.length < 8) {
		caixa_senha2.innerHTML = "Favor preencher o campo Confirmação de Senha com o mínimo de 8 caracteres";
		caixa_senha2.style.display = 'block';
		contErro += 1;
	} else {
		caixa_senha2.style.display = 'none';
	}

	/* Valida se a senha é igual ao campo repita a senha */
	if (senha.value != "" && senha2.value != "" && senha.value != senha2.value) {
		caixa_senha2.innerHTML = "O campo Repita a Senha é diferente do campo Senha";
		caixa_senha2.style.display = 'block';
		contErro += 1;
	}

	if (contErro > 0) {
		evt.preventDefault();
	}
    
} 