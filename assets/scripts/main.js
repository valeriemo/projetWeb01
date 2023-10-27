
window.addEventListener('DOMContentLoaded', function () {
    
    let elBurger = document.querySelector('[data-js-burger]'),
        elMenu = document.querySelector('[data-js-menu]'),
        elMenuFerme = elMenu.querySelector('[data-js-menu-ferme]'),
        elHTML = document.documentElement,
        elBody = document.body;

    elBurger.addEventListener('click', function () {
        elMenu.classList.replace('menu--ferme', 'menu--ouvert')
        elHTML.classList.add('overflow-y-hidden');
        elBody.classList.add('overflow-y-hidden');
    })

    elMenuFerme.addEventListener('click', function () {
        elMenu.classList.replace('menu--ouvert', 'menu--ferme')
        elHTML.classList.remove('overflow-y-hidden');
        elBody.classList.remove('overflow-y-hidden');

    })


})