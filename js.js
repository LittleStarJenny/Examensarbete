document.addEventListener('DOMContentLoaded', function(){
    console.log('DOM loaded');


$('nav ul .cart-button').on('mouseover', function() {
    console.log('Jag funkar');
$('.cart-content').toggleClass('active');
});


});

