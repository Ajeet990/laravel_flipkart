$(document).ready(function() {
    $('.payment_method').on('change', function() {
        // alert("changed")
        var paymenMethod = $(this).attr('id')
        // console.log(paymenMethod)
        if (paymenMethod == 'c_d_card') {
            $('#card_payment').css('display', 'block');
            $('#upi_payment').css('display', 'none');
        } else if (paymenMethod == 'upi') {
            $('#card_payment').css('display', 'none');
            $('#upi_payment').css('display', 'block');
        } else {
            $('#card_payment').css('display', 'none');
            $('#upi_payment').css('display', 'none');

        }
    })


})