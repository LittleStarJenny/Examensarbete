document.addEventListener('DOMContentLoaded', function(){
    console.log('DOM loaded');

// Activate sticky header on scroll
$(document).scroll(function() {
    var y = $(this).scrollTop();
    
    if (y > 100) {
        if($("body .fixed-nav").length < 1) {
            $("body").addClass("fixed-nav");
            
        }
    } else {
        if($("body.fixed-nav").length > 0) {
            $("body").removeClass("fixed-nav");
        }
    }
});

    // Get totalsum if 0 or less do not activate click
var totsum = Number($('.cartSum .total').text().replace(/[^0-9]/gi, ''));
// console.log(totsum);

if(totsum > 0) {
$('nav ul .cart-button').on('click', function() {
    console.log('Jag funkar');
$('.cart-content').toggleClass('active');
});
}

var qty = [];
var totalrows = 0;
// qty = Number($('.productsIncart .cart-prod-qty').text().replace(/[^0-9]/gi, ''));
//    console.log(qty);

           $('.each-row').each(function() {
           var qty = Number($(this).find('.cartRow .cart-prod-qty').text().replace(/[^0-9]/gi, ''));
           qty = Jquery.map();
           console.log('Total' + qty);
           });
        //    $('.productsIncart').each(function() {
        //     var totalrows = Number($(this).find('.each-row').text().replace(/[^0-9]/gi, ''));
        //     console.log(totalrows);
        //     });


           $('.qty-in-cart').text(totalqty);





});

