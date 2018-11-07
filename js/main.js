$(document).ready(function () {

    // ABOUT: Event listener for add to order button
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

    // ABOUT: update quantity button listener
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

    // ABOUT: Js to store contact form submission in database
    $('#contact-form').on('submit', function () {
        var name = $('#nameField').val();
        var email = $('#emailField').val();
        var phone = $('#phoneField').val();
        var message = $('#comments').val();
        var query = 'name=' + name + '&email=' + email + '&phone=' + phone + '&comments=' + message;

        $.ajax({
            type: "POST",
            url: "inc/contact_form_store.php",
            data: query,
            success: function () {
                window.location.href = "index.php?status=thanks";
            }
        });
    });


    // ABOUT: This Javascript holds the tab in place after refresh
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#nav-tab a[href="' + activeTab + '"]').tab('show');
    }

    // ABOUT: Click event to trigger modal on main page "start Order"
    $('#startOrderBtn').on('click', function () {
        // modal start order behavior
        $('#modalStartOrder').modal('show');
    });


    // ABOUT: Form validation code here
    // start order form validation
    $('#pickup-details-form').validate({
        rules: {
            order_fname: "required",
            order_lname: "required",
            order_email: {
                required: true,
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
        // ABOUT: Specify validation error messages
        message: {
            order_fname: "Please provide your first name",
            order_lname: "Please provide your last name",
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
    // ABOUT: initialize form validation on the contact form
    $('#contact-form').validate({
        // Specify validation rules
        rules: {
            name: "required",
            email: {
                required: true,
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
        // ABOUT: Specify validation error messages
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
    // ABOUT: Validation rules for the final details form
    $('.checkout-form').validate({
        // ABOUT: validation rules, everything required EXCECPT Special instruction
        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10
            },
            order_date: {
                required: true,
                date: true,
                minlength: 8
            },
            order_time: {
                required: true
            }
        },
        // ABOUT: validation messages here
        message: {
            first_name: "Please provide a First Name",
            last_name: "Please provide a Last Name",
            email: "Please provide a valid email address",
            phone: {
                required: "Please provide a valid phone number",
                minlength: "Phone number must be at least 10 digits"
            },
            order_date: {
                required: "Please provide a valid pickup date!",
                minlength: "Date must be in valid format and at least 8 characters"
            },
            order_time: "Please select a time"
        }

    });

    // ABOUT: Ajax to delete items from cart
    $('.delete-item').on('click', function () {
        var element = $(this);
        var menu_id = element.attr('id');
        var del_id = 'did=' + menu_id;
        $('#confirm-delete-item').modal('show');
        $('.btn-ok').on('click', function () {
            $.ajax({
                type: "POST",
                url: "remove_from_order.php",
                data: del_id,
                success: function () {
                    location.reload();
                }
            });
            $('#confirm-delete-item').modal('hide');
        });
    });

    // ABOUT: Js for the last date time modal
    $('#modalDateTime').modal('show');

    // Js Code for the jQuery UI Datepicker
    $('#startDate').datepicker({
        minDate: 2,
        defaultDate: 2
    });

    // ABOUT: Enable popovers everywhere
    $(function () {
        $('[data-toggle="popover"]').popover()
    });

    // ABOUT: This is the confirmation for the delete cart button
    $('#confirm-delete-cart').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

});