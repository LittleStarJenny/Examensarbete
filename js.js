document.addEventListener('DOMContentLoaded', function(){
    console.log('DOM loaded');


$('nav ul .cart-button').on('click', function() {
    console.log('Jag funkar');
$('.cart-content').toggleClass('active');
});



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


});

