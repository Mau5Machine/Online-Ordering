$(document).ready(function () {

    // add to cart button listener
    $('#add_to_order').on('click', function () {
        console.log('hello!');
        // redirect to add_to_cart.php, with parameter values to process the request
        window.location.href = "add_to_order.php?id=" + id + "&qty=" + quantity;
        return false;
    });


    // update quantity button listener
    $('.update-quantity-form').on('submit', function () {

        // get basic information for updating the order
        var id = $(this).find('.menu-id').text();
        var quantity = $(this).find('.quantity').val();

        // redirect to update_quantity.php, with parameter values to process the request
        window.location.href = "update_quantity.php?id=" + id + "&quantity=" + quantity;
        return false;
    });






});