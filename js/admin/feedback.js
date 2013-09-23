$(document).ready(function() {

    /*
     * Валидации формы сохранения настроек ФОС
     */
    $('#settings_feedback_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        ignore: '',
        rules: {
            fos_email: {
                required: true,
                email: true
            }
        },
        messages: {
            fos_email: {
                required: 'Заполните поле <b>Email</b>',
                email: 'Введите корректный <b>Email</b>'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {
        },
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: '#error1 ul',
        wrapper: 'li'
    });


/*
     * Валидации формы сохранения настроек ФОЗ
     */
    $('#settings_callback_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        ignore: '',
        rules: {
            callback_email: {
                required: true,
                email: true
            }
        },
        messages: {
            callback_email: {
                required: 'Заполните поле <b>Email</b>',
                email: 'Введите корректный <b>Email</b>'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {
        },
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: '#error1 ul',
        wrapper: 'li'
    });
    
    /*
     * Валидации формы сохранения настроек
     * формы запросов на осмотр
     */
    $('#settings_reqviewer_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        ignore: '',
        rules: {
            reqviewer_email: {
                required: true,
                email: true
            }
        },
        messages: {
            reqviewer_email: {
                required: 'Заполните поле <b>Email</b>',
                email: 'Введите корректный <b>Email</b>'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {
        },
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: '#error1 ul',
        wrapper: 'li'
    });
    
    /*
     * Валидации формы сохранения настроек
     * формы запроса на обмен
     */
    $('#settings_exchange_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        ignore: '',
        rules: {
            exchange_email: {
                required: true,
                email: true
            }
        },
        messages: {
            exchange_email: {
                required: 'Заполните поле <b>Email</b>',
                email: 'Введите корректный <b>Email</b>'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {
        },
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: '#error1 ul',
        wrapper: 'li'
    });
    
    /*
     * Валидации формы сохранения настроек
     * формы запроса на покупку
     */
    $('#settings_reqbuy_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        ignore: '',
        rules: {
            reqbuy_email: {
                required: true,
                email: true
            }
        },
        messages: {
            reqbuy_email: {
                required: 'Заполните поле <b>Email</b>',
                email: 'Введите корректный <b>Email</b>'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {
        },
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: '#error1 ul',
        wrapper: 'li'
    });
    
    /*
     * Валидации формы сохранения настроек
     * формы запроса на покупку
     */
    $('#settings_reqbuysell_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        ignore: '',
        rules: {
            reqbuysell_email: {
                required: true,
                email: true
            }
        },
        messages: {
            reqbuysell_email: {
                required: 'Заполните поле <b>Email</b>',
                email: 'Введите корректный <b>Email</b>'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {
        },
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: '#error1 ul',
        wrapper: 'li'
    });
    
    /*
     * Функция сабмита сохранения настроек
     */
    $('.save-feedback-settings').click(function(event) {
        event.preventDefault();
        // Сабмитим форму
        $(this).closest('form').submit();
    });

    /*
     * Функция сабмита удаления image баннера
     */
    $('.delete-row').click(function(event) {
        event.preventDefault();

        // Узнаем, действительно ли нужно удаление
        var answer = confirm('Действительно хотите удалить запись?');

        // Удаление подтверждено
        if (answer == true)
        {
            // Регистрируем действие
            $('#action').val('delete');
            // Добавляем статус в поля формы
            $('#work_id').val($(this).attr('rel'));
            // Сабмитим форму
            $(this).closest('form').submit();
        }
    });

})