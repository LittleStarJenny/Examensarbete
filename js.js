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


check_cart_sum = setInterval(function() {
    if($('.cartSum .total').length > 0) {
        clearInterval(check_cart_sum);
        var count_cart = Number($('.cartSum .total').text().replace(/[^0-9]/gi, ''));
        console.log(count_cart);
    }
}, 1000);


var sg_add_element_to_watch_192507213=setInterval(function() {
   if($('.cart-content .productsIncart').length>0) {
       var sg_element = document.querySelector('.cart-content .productsIncart');
       clearInterval(sg_add_element_to_watch_192507213);

       var sg_observer = new MutationObserver(function(mutations) {
           mutations.forEach(function(mutation) {
               if (mutation.type === 'childList') {
                   
                   // plocka ut summa igen ny variabel
                   new_sum = Number($('.cartSum .total').text().replace(/[^0-9]/gi, ''));
                       console.log(new_sum);
                       if((new_sum) > (count_cart)) {
                        console.log('Jenny');
           //Product Page
           $('.each-row').each(function() {
           var qty = Number($(this).find('.cartRow .cart-prod-qty').text().replace(/[^0-9]/gi, ''));
           console.log(qty);
           });
           $('.qty-in-cart').text(qty);
           
        }
        //Sätt start summa igen
    count_cart = new_sum;
 }
});
});
sg_observer.observe(sg_element, {
childList: true
});
}
},1000);




});

