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

if(totsum > 0) {
    $('.main-nav .cart-button').on('click', function() {
        $('.cart-content').toggleClass('active');
    });
}

// Disable buy button for 3sec to prevent double click
$('.addtocart-btn').prop('disabled', true).addClass('active');
setTimeout(function() {
      $('.addtocart-btn').prop('disabled', false).removeClass('active');
}, 3000);

//Hide success message from addtocart button after 3sec
if($('.successMessage').length > 0) {
    setTimeout(function() {
        $('.successMessage').fadeOut('fast');
    }, 3000);
}
    
// Counter for cart quantity in header
var qty = [];
var sum_total = 0;

$('.each-row').each(function() {
    var qty_number = Number($(this).find('.cartRow .cart-prod-qty').text().replace(/[^0-9]/gi, ''));
    qty.push(qty_number);

    }).promise().done(function(){
        sum_total = qty.reduce(function(a, b){ 
            return a + b;
        }, 0);
        // console.log('Total ' + sum_total);
});

$('.qty-in-cart').text(sum_total);

// Prevent form to submit if page is refresh
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

// Ajax call to autofill customerinfo in adminpanel
$(function() {
    $(".CustomerId").on("change", function() {
       var CustomersId = $(this).val();
        $.ajax({
            url: "http://localhost/Stellasina/resources/functions/function_fillcustomerinfo.php",
            type: "POST",
            data: {
             CustomersId: CustomersId
            },
            success: function(data) {
                console.log(CustomersId)
                console.log(data);
                $("#results").html(data);
            }
        });
    });
});

});

