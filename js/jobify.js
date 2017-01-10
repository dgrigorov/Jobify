// Jobify Theme JavaScript

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    $("#myModal").modal();

    $('#datePicker')
        .datepicker({
            format: 'dd-mm-yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#profileForm').formValidation('revalidateField', 'date');
        });

        function adjustIframeHeight() {
            var $body   = $('body'),
                $iframe = $body.data('iframe.fv');
            if ($iframe) {
                // Adjust the height of iframe
                $iframe.height($body.height());
            }
        }

        // IMPORTANT: You must call .steps() before calling .formValidation()
        $('#profileForm')
            .steps({
                headerTag: 'h2',
                bodyTag: 'section',
                onStepChanged: function(e, currentIndex, priorIndex) {
                    // You don't need to care about it
                    // It is for the specific demo
                    adjustIframeHeight();
                },
                // Triggered when clicking the Previous/Next buttons
                onStepChanging: function(e, currentIndex, newIndex) {
                    var fv         = $('#profileForm').data('formValidation'), // FormValidation instance
                        // The current step container
                        $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                    // Validate the container
                    fv.validateContainer($container);

                    var isValidStep = fv.isValidContainer($container);
                    if (isValidStep === false || isValidStep === null) {
                        // Do not jump to the next step
                        return false;
                    }

                    return true;
                },
                // Triggered when clicking the Finish button
                onFinishing: function(e, currentIndex) {
                    var fv         = $('#profileForm').data('formValidation'),
                        $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                    // Validate the last step container
                    fv.validateContainer($container);

                    var isValidStep = fv.isValidContainer($container);
                    if (isValidStep === false || isValidStep === null) {
                        return false;
                    }

                    return true;
                },
                onFinished: function(e, currentIndex) {
                    // Uncomment the following line to submit the form using the defaultSubmit() method
                    // $('#profileForm').formValidation('defaultSubmit');

                    // For testing purpose
                    $('#welcomeModal').modal();
                }
            })
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                // This option will not ignore invisible fields which belong to inactive panels
                excluded: ':disabled',
                fields: {
                    firstName: {
                        validators: {
                            notEmpty: {
                                message: 'The field is required'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\s]+$/,
                                message: 'The first name can only consist of alphabetical and space'
                            }
                        }
                    },
                    lastName: {
                        validators: {
                            notEmpty: {
                                message: 'The field is required'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\s]+$/,
                                message: 'The last name can only consist of alphabetical and space'
                            }
                        }
                    },
                    phoneNumber: {
                        validators: {
                            notEmpty: {
                                message: 'The field is required'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'The phone number can only consist of alphabetical and space'
                            }
                        }
                    },
                    email: {
                        verbose: false,
                        validators: {
                            notEmpty: {
                                message: 'The field is required and can\'t be empty'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            },
                            stringLength: {
                                max: 512,
                                message: 'Cannot exceed 512 characters'
                            },
                            remote: {
                                type: 'GET',
                                url: 'https://api.mailgun.net/v2/address/validate?callback=?',
                                crossDomain: true,
                                name: 'address',
                                data: {
                                    // Registry a Mailgun account and get a free API key
                                    // at https://mailgun.com/signup
                                    api_key: 'pubkey-83a6-sl6j2m3daneyobi87b3-ksx3q29'
                                },
                                dataType: 'jsonp',
                                validKey: 'is_valid',
                                message: 'The email is not valid'
                            }
                        }
                    }
                }
            })
            .find('[name="dob"]')
            .datepicker({
                onSelect: function(date, inst) {
                    /* Revalidate the field when choosing it from the datepicker */
                    $('#profileForm').formValidation('revalidateField', 'dob');
                }
            });

})(jQuery); // End of use strict
