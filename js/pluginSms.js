jQuery( document ).ready(function($) {

    //statistic information page

    $(".select-type-mess, .select-number-mess").on('change click', function(e) {
        e.preventDefault();
        let typeMessage = $(".select-type-mess").val(),
            dataType    = $(".select-type-mess").find(':selected').data('type'),
            urlData     = typeMessage +''+dataType;

        $('.popup-fade-spinner').fadeIn();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'GET',
            data: {
                action: 'statistic_inform'
            }
        })
        .done(function (response) {
            $('.popup-fade-spinner').fadeOut();
            window.location = urlData;
        })
    });
  // FOR SEND MESSAGE
    let valueLength = $('.valueLength');
    $(".textarea-message").on('change keyup paste', function() {
        if( $(".textarea-message").val().length != 0 ) {
            $('.translit').attr('hidden', false)
        } else {
            $('.translit').attr('hidden', true)
        }
        let message = $(".textarea-message").val();
        valueLength.text(message.length)
    });

    $('.send-message').on('click', function() {
        let message = $(".textarea-message").val();
        let phoneNumber = $(".phone-receiver").val();
        let alphaName = $("#alpha-name").val();
        if ( phoneNumber === '' || message === '' || alphaName == null ) {
            if ( phoneNumber === '' ) {
                $('.phone-error').attr('hidden', false)
            }

            if ( message === '' ) {
                $('.textarea-error').attr('hidden', false)
            }

            if ( alphaName == null ) {
                $('.alphaName-error').attr('hidden', false)
            }
        } else {
            let typePage = $('#type-message').val();
            let typeMessage;

            if ( typePage === 'sms' ) {
                typeMessage = 'sms'
            }

            if ( typePage === 'viber' ) {
                typeMessage = 'viber'
            }
            $('.popup-fade-spinner').fadeIn();

            let data = {
                action:      'send_message',
                message:     message,
                phoneNumber: phoneNumber,
                alphaName:   alphaName,
                typeMessage: typeMessage
            }
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: data
            })
            .done(function (response) {
                valueLength.text('0')
                let parseMessage = JSON.parse(response);
                $.fn.errorMessage(parseMessage);
                $('.popup-fade-spinner').fadeOut();
                $(".textarea-message").val('');
                $(".phone-receiver").val('')

            })
        }
    });

    $.fn.errorMessage = function(parseMessage) {
        if ( parseMessage[0] === 'error' ) {
            $('.error-message').text(parseMessage[2]);
            $('.popup-fade').fadeIn();
        }

        if ( parseMessage[0] === 'criticalError' ) {
            $('.error-message').text('Данные авторизации не верны');
            $('.popup-fade').fadeIn();
        }      

        if ( parseMessage[0] === 'success' ) {
            let successMessage = 'Сообщение отправлено';
            $('.success-message').text(successMessage);
            $('.popup-fade').fadeIn();
        }
    }
  // END FOR SEND MESSAGE


    $(".phone").bind("change keyup input click", function() {
        this.value = this.value.match(/^[\d\+\-\,\(\)\s]{1,}/g);
    });

    $('.translit').on('click', function() {
        $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
            action: 'translit_message',
            translit: 'yes',
            message: $(".textarea-message").val()
        }
        })
        .done(function (response) {
            $(".textarea-message").val(response);

        })
    })

    $(".login, .token, .phone-receiver, .textarea-message").bind("change keyup input click", function() {
        $('.error').attr('hidden', true)
    });
    
    // Validation input in setting page
    
    $('.account-data').on('click', function() {
        let token = $(".token").val();

        if ( token === '' ) {
            $('.token-error').attr('hidden', false);

            return false;
        }

        $('.popup-fade-spinner').fadeIn();
        let data = {
            action: 'user_account_data',
            token: token
        }
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: data
        })
        .done(function (response) {
            // clear input value
            $(".token").val('');
            $(".account-data").val('Обновить');

            $('.popup-fade-spinner').fadeOut();
            $('.popup-fade-settings').fadeIn();
            let successMessage = 'Данные успешно сохранены';
            $('.settings-message').text(successMessage);

            return false;
        })
    })

    $('.popup-close').click(function() {
        $(this).parents('.popup-fade').fadeOut();
        location.reload();
        return false;
    });        
    
    // Закрытие по клавише Esc.
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.popup-fade').fadeOut();
        }
    });
        
    // Клик по фону, но не по окну.
    $('.popup-fade').click(function(e) {
        if ($(e.target).closest('.popup').length == 0) {
            $(this).fadeOut();					
        }
    });
  // end Validation    
});