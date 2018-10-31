$(document).ready(function () {

    // Event listener for add to order button
    $('.add-to-order-form').on('submit', function () {

        // Grab id and quantity variables
        var id = $(this).find('.menu-id').text();
        var quantity = $(this).find('.order-qty').val();

        // redirect to add_to_cart.php, with parameter values to process the request
        window.location.href = "add_to_order.php?id=" + id + "&qty=" + quantity;
        return false;
    });

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);
    // update quantity button listener
    $('.update-quantity-form').on('submit', function () {

        // get basic information for updating the order items
        var id = $(this).find('.menu-id').text();
        var quantity = $(this).find('.order-quantity').val();

        // redirect to update_quantity.php, with parameter values to process the request
        window.location.href = "update_quantity.php?id=" + id + "&qty=" + quantity;
        return false;
    });

});