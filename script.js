let navbar = document.querySelector('.header .navbar');
let menuBtn = document.querySelector('#menu-btn');

menuBtn.onclick = () => {
    menuBtn.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menuBtn.classList.remove('fa-times');
    navbar.classList.remove('active');
}

let shoppingcart = document.querySelector('.cart-items-container')

document.querySelector('#cart-btn').onclick = () => {
    shoppingcart.classList.add('active');
}

document.querySelector('#close').onclick = () => {
    shoppingcart.classList.remove('active');
};

// account form