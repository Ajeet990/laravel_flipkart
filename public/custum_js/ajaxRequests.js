$(document).ready(function() {
    $('.addToCart').on('click', function(e) {
        e.preventDefault();
        // alert("addiing to cart")
        var productId = $(this).data('product_id')
        var quantity = 1;
        var addToCartUrl = $(this).data('add_to_cart_url')
        var csrfToken = $('#csrf_token').val()
        // var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: addToCartUrl,
            data: {
                product_id: productId,
                quantity: quantity,
                _token: csrfToken,
            },
            
            success: function(response) {
                // alert(response.message); // Display success message
                // console.log(response.message)
                if (response.status) {
                    toastr.success(response.message)
                } else {
                    toastr.error(response.message)
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log error message
            }
        });
    })

    $(document).on('click', '.removeFromCart', function(e) {
        e.preventDefault()
        var cartId = $(this).data('cart_id')
        var url = $(this).data('url')
        var csrfToken = $('#csrf_token_1').val()

        // console.log(cartId, url)
        $.ajax({
            method:"post",
            url:url,
            data:{
                _token: csrfToken,
                cartId: cartId,
                url:url
            },
            success: function(data) {
                if (data.status) {
                    $('#cart_items').empty()
                    $('#cart_items').html(data.cartItemString)
                    toastr.clear()
                    toastr.success(data.message)
                } else {
                    toastr.clear()
                    toastr.error(data.message)
                    // alert(data.message)
                }
            }
        })
    })
})