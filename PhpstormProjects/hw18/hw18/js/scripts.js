(function($) {
    "use strict"; // Start of use strict
    // jQuery for page scrolling feature
    $('.page-scroll').on("click", function(e) {
        var $anchor = $(this).find('a');
        $("html, body").stop().animate({
            scrollTop: ($($anchor.attr("href")).offset().top)
        }, 1250, "easeInOutExpo");
        e.preventDefault();
    });

    $(".background-image-wrapper").each(function() {
        var image = $(this).children("img").attr("src");
        $(this).css("background", 'url("' + image + '")').css("background-position", "initial").css("opacity", "1");
    })

    // creating the skills section
    $("#skills .skill-bar").each(function() {
        var width = $(this).attr("data-width");
        $(this).addClass("skill-bar-" + width);
        $(this).css( "animation-name", "slideInLeft" );
        $(this).find('.skill-tip').text(width + '%');
    });
    $("#skill-dots .skill").each(function() {
        var score = $(this).find('.skill-progress').attr("data-score");
        var html = "";
        for (var i = 0; i < score; i++) {
            html += "<i class='fa active wow'></i>";
        }
        for (var i = score; i < 10; i++) {
            html += "<i class='fa wow'></i>";
        }
        $(this).find('.skill-progress').html(html);
    })

    // scrollspy is used to highlight the active menu
    $('body').scrollspy({
        target: '.nav-container',
        offset: 50
    });

    //Init WOW JS
    new WOW().init();

    //fixed top navigation on scroll
    $('#TopMenu').affix({
        offset: {
            top: 80
        }
    });

    // On load of total site ...  
    $(window).on("load", function(e) {
        // hide loader once site is loaded
        $(".loader-wrapper").fadeOut("slow");
        //Pretty photo lightbox
        $("a[data-gal^='prettyPhoto']").prettyPhoto({
            hook: 'data-gal',
            social_tools: false,
            deeplinking: false,
            animation_speed: 'normal',
            theme: 'dark_square',
            slideshow: 3000,
            autoplay_slideshow: false
        });
        // Isotope Portfolio
        $container.isotope({
            filter: '*',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            },
            masonry: {
                gutter: 10,
                itemSelector: '.item',
                columnWidth: 4
            },
        });

        // Email Submission and form validation
        $("form[name='emailSubmission']").validate({
            // Specify validation rules
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                email: {
                    required: true,
                    email: true
                },
                message: "required"
            },
            // Specify validation error messages
            messages: {
                name: "Please enter your Name",
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                message: "Please enter your comments"
            },
            submitHandler: function(form) {
                //form.submit();
                var $form = $(form),
                    $messageSuccess = $('#successMessage'),
                    $messageError = $('#errorMessage'),
                    $submitButton = $(this.submitButton);
                $submitButton.button('loading');

                // Ajax Submit
                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: {
                        name: $form.find('#name').val(),
                        email: $form.find('#email').val(),
                        message: $form.find('#message').val()
                    }
                }).always(function(data, textStatus, jqXHR) {
                    if (data.response == 'success') {
                        $messageSuccess.removeClass('hidden');
                        $messageError.addClass('hidden');
                        // Reset Form
                        $form.find('.minimal')
                            .val('')
                            .blur()
                            .parent()
                            .removeClass('has-success')
                            .removeClass('has-error')
                            .find('label.error')
                            .remove();
                        $submitButton.button('reset');
                        return;
                    }
                    $messageError.removeClass('hidden');
                    $messageSuccess.addClass('hidden');
                    $form.find('.has-success').removeClass('has-success');
                    $submitButton.button('reset');
                });
            }
        });

    })

    // Portfolio Filter
    var $container = $('.portfolioContainer');
    $('.portfolioFilter a').on("click", function() {
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        return false;
    });

})(jQuery);
