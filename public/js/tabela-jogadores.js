var formSignin = document.querySelector('#Azul')
var formSignup = document.querySelector('#Vermelho')
var btnColor = document.querySelector('.btn-color')
var colorHeader = document.querySelector('#color-header-table')
var colorTeahdVermelho = document.querySelectorAll('#color-thead-vermelho th')
var colorBtnAddJogador = document.querySelector('.add-jogador')

document.querySelector('#btnAzul')
  .addEventListener('click', () => {
    formSignin.style.display = "block"
    formSignup.style.display = "none"
    btnColor.style.left = "0px"
    colorHeader.style.backgroundColor = "#2b4c7e"
    colorBtnAddJogador.style.background = "#567ebb"
})

document.querySelector('#btnVermelho')
  .addEventListener('click', () => {
    formSignin.style.display = "none"
    formSignup.style.display = "block"
    btnColor.style.left = "91px"
    colorHeader.style.backgroundColor = "#7e2b2b"
    for (var i = 0; i < colorTeahdVermelho.length; i++) {
      colorTeahdVermelho[i].style.backgroundColor = '#806060';
    }
    colorBtnAddJogador.style.background = "#bb5656"
})