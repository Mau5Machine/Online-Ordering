$(document).ready(function () {

    // Event listener for add to order button
    $('.add-to-order-form').on('submit', function () {

        // Grab id and quantity variables
        var id = $(this).find('.menu-id').text();
        var quantity = $(this).find('.order-qty').val();
        var addInfo = 'id=' + id + '&qty=' + quantity;

        $.ajax({
            type: "POST",
            url: "add_to_order.php",
            data: addInfo,
            success: function (data) {
                location.reload();
            }
        });
        return false;
    });

    // update quantity button listener
    $('.update-quantity-form').on('submit', function () {

        // get basic information for updating the order items
        var id = $(this).find('.menu-id').text();
        var quantity = $(this).find('.order-quantity').val();
        var updateInfo = 'id=' + id + '&qty=' + quantity;

        $.ajax({
            type: "POST",
            url: "update_quantity.php",
            data: updateInfo,
            success: function (data) {
                location.reload();
            }
        });
        return false;
    });

    // Js to store contact form submission in database
    $('#contact-form').on('submit', function () {
        var name = $('#nameField').val();
        var email = $('#emailField').val();
        var phone = $('#phoneField').val();
        var message = $('#comments').val();
        var query = 'name=' + name + '&email=' + email + '&phone=' + phone + '&comments=' + message;

        $.ajax({
            type: "POST",
            url: "inc/contact_form_store.php",
            data: query
        });
    });


    // This Javascript holds the tab in place after refresh
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#nav-tab a[href="' + activeTab + '"]').tab('show');
    }

    // Click event to trigger modal on main page "start Order"
    $('#startOrderBtn').on('click', function () {
        // modal start order behavior
        $('#modalStartOrder').modal('show');
    });


    // Form validation code here
    // start order form validation
    $('#pickup-details-form').validate({
        rules: {
            // The key name is on the left is name attribute
            // of input field. Rules are defined on right side
            order_user: "required",
            order_email: {
                required: true,
                // Specify that email should be validated by
                // the built-in "email" rule
                email: true
            },
            order_phone: {
                required: true,
                minlength: 10
            },
            order_date: {
                required: true,
                minlength: 8
            },
            order_time: {
                required: true,
            }
        },
        // Specify validation error messages
        message: {
            order_user: "Please provide your full name",
            order_email: "Please enter a valid email address",
            order_phone: {
                required: "Please enter a phone number",
                minlength: "Phone number must be at least 10 digits"
            },
            order_date: {
                required: "Please enter a valid date",
                minlength: "Date Format MM/DD/YYY"
            },
            order_time: {
                required: "Please enter a valid time",
                minlength: "Time Format HH:MM PM/AM"
            },
            // Make sure the form is submitted
            submitHandler: function (form) {
                form.submit();
            }
        }
    });
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

    // Ajax to delete items from cart
    $('.delete-item').on('click', function () {
        var element = $(this);
        var menu_id = element.attr('id');
        var del_id = 'did=' + menu_id;
        if (confirm("Delete This?")) {
            $.ajax({
                type: "POST",
                url: "remove_from_order.php",
                data: del_id,
                success: function () {
                    location.reload();
                    alert('Deleted Successfully!');
                }
            });
        }
        return false;
    });

    // Js Code for the jQuery UI Datepicker
    $('#startDate').datepicker({
        minDate: 2,
        defaultDate: 2
    });

    // Enable popovers everywhere
    $(function () {
        $('[data-toggle="popover"]').popover()
    });

    // Call on the confirm delete modal
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    // Enable popovers everywhere
    $(function () {
        $('[data-toggle="popover"]').popover()
    });


});