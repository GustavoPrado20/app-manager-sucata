var formSignin = document.querySelector('#Azul')
var formSignup = document.querySelector('#Vermelho')
var btnColor = document.querySelector('.btn-color')
var colorHeader = document.querySelector('#color-header-table')
var colorTeahdVermelho = document.querySelector('#color-thead-vermelho th')

document.querySelector('#btnAzul')
  .addEventListener('click', () => {
    formSignin.style.display = "block"
    formSignup.style.display = "none"
    btnColor.style.left = "0px"
    colorHeader.style.backgroundColor = "#2b4c7e"
})

document.querySelector('#btnVermelho')
  .addEventListener('click', () => {
    formSignin.style.display = "none"
    formSignup.style.display = "block"
    btnColor.style.left = "91px"
    colorHeader.style.backgroundColor = "#7e2b2b"
    colorTeahdVermelho.style.backgroundColor = "#806060"
})