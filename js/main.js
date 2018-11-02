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

    // This Javascript holds the tab in place after refresh
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#nav-tab a[href="' + activeTab + '"]').tab('show');
    }

    // Form validation code here
    // initialize form validation on the contact form
    $('#contact-form').validate({
        // Specify validation rules
        rules: {
            // The key name is on the left is name attribute
            // of input field. Rules are defined on right side
            name: "required",
            email: {
                required: true,
                // Specify that email should be validated by
                // the built-in "email" rule
                email: true
            },
            phone: {
                required: true,
                minlength: 10
            },
            comments: {
                required: true,
                minlength: 10
            }
        },
        // Specify validation error messages
        message: {
            name: "Please provide a name",
            email: "Please enter a valid email address",
            phone: {
                required: "Please enter a phone number",
                minlength: "Phone number must be at least 10 digits"
            },
            comments: {
                required: "Please enter a comment",
                minlength: "Comments must be at least 10 characters long"
            },
            // Make sure the form is submitted
            submitHandler: function (form) {
                form.submit();
            }
        }
    });

    // Timeout function for the alerts
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 1500);

    // update quantity button listener
    $('.update-quantity-form').on('submit', function () {

        // get basic information for updating the order items
        var id = $(this).find('.menu-id').text();
        var quantity = $(this).find('.order-quantity').val();

        // redirect to update_quantity.php, with parameter values to process the request
        window.location.href = "update_quantity.php?id=" + id + "&qty=" + quantity;
        return false;
    });

    // Animsition code here
    $('.animsition').animsition({
        inClass: 'fade-in-right',
        outClass: 'fade-out-right',
        inDuration: 2000,
        outDuration: 1500,
        linkElement: '.animsition-link',
        // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
        loading: true,
        loadingParentElement: 'body', //animsition wrapper element
        loadingClass: 'animsition-loading',
        loadingInner: '', // e.g '<img src="loading.svg" />'
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'body',
        transition: function (url) {
            window.location.href = url;
        }
    });


});