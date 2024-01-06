var formSignin = document.querySelector('#signIn')
var formSignup = document.querySelector('#signUp')
var btnColor = document.querySelector('.btn-color')

document.querySelector('#btnSignIn')
  .addEventListener('click', () => {
    formSignin.style.left = "25px"
    formSignup.style.left = "450px"
    btnColor.style.left = "0px"
})

document.querySelector('#btnSignUp')
  .addEventListener('click', () => {
    formSignin.style.left = "-450px"
    formSignup.style.left = "25px"
    btnColor.style.left = "99px"
})