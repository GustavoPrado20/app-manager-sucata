const btnNav = document.getElementById('btn-nav');
const btnMenu1 = document.getElementById('btn-menu-1');
const btnMenu2 = document.getElementById('btn-menu-2');
const btnMenu3 = document.getElementById('btn-menu-3');
const btnMenu4 = document.getElementById('btn-menu-4');
const btnMenu5 = document.getElementById('btn-menu-5');

function toggleMenu(event) {
    if (event.type === 'touchstart') event.preventDefault();
    
    const nav = document.getElementById('nav');
    nav.classList.toggle('active');
    
    const active = nav.classList.contains('active');
    event.currentTarget.setAttribute('aria-expanded', active);
   
    if (active) {
      event.currentTarget.setAttribute('aria-label', 'Fechar Menu');
    } else {
      event.currentTarget.setAttribute('aria-label', 'Abrir Menu');
    }
}
  
btnNav.addEventListener('click', toggleMenu);
btnNav.addEventListener('touchstart', toggleMenu);

btnMenu1.addEventListener('click', toggleMenu);
btnMenu2.addEventListener('click', toggleMenu);
btnMenu3.addEventListener('click', toggleMenu);
btnMenu4.addEventListener('click', toggleMenu);
btnMenu5.addEventListener('click', toggleMenu);

function toggleMenu(event) {
    if (event.type === 'touchstart') event.preventDefault();
    
    const nav = document.getElementById('nav');
    nav.classList.toggle('active');
    
    const active = nav.classList.contains('active');
    event.currentTarget.setAttribute('aria-expanded', active);
   
    if (active) {
      event.currentTarget.setAttribute('aria-label', 'Fechar Menu');
    } else {
      event.currentTarget.setAttribute('aria-label', 'Abrir Menu');
    }
}