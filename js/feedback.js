$(document).ready(function() {

    // phone mask
    $('#feedback-form #phone').mask('+7 (999) 999-9999');
    $('#callback-form #phone').mask('+7 (999) 999-9999');
    $('#reqbuysell-form #phone').mask('+7 (999) 999-9999');
    $('#reqbuy-form #phone').mask('+7 (999) 999-9999');
    $('#exchange-form #phone').mask('+7 (999) 999-9999');
    $('#reqviewer-form #phone').mask('+7 (999) 999-9999');

    // callback form validate
    $('#feedback-form').validate({
        focusInvalid: true,
        focusCleanup: false,
        ignore: '',
        rules: {
            fio: {
                required: true
            },
            phone: {
                required: true
            },
            email: {
                email: true
            },
            message: {
                required: true,
                minlength: 10
            },
            agree_private: {
                required: true
            },
            iqaptcha: {
                empty: true
            }
        },
        messages: {
            fio: {
                required: 'введите <b>ФИО</b>'
            },
            phone: {
                required: 'введите <b>телефон</b>'
            },
            email: {
                email: 'некорректный <b>email</b>'
            },
            message: {
                required: 'наберите <b>сообщение</b>',
                minlength: '<b>сообщение</b> меньше 10 символов'
            },
            agree_private: {
                required: 'подтвердите <b>согласие</b>'
            },
            iqaptcha: {
                empty: '<b>разблокируйте</b> форму'
            }
        },
        submitHandler: function(form) {
            $('#feedback-submit').hide();
            $('#process-feedback').fadeIn(500);

            // Отсылаем запрос
            $.post(
                    '/feedback/ajax/feedback',
                    $('#feedback-form').serialize(),
                    function(data) {
                        if (data === 'true')
                        {
                            setTimeout(function() {
                                $('#process-feedback').hide();
                                $('#success-feedback').fadeIn(500);
                                setTimeout(function() {
                                    $('.b-popup').fadeOut(300, function() {
                                        $('#overlay').fadeOut(300);
                                        $('#success-feedback').hide();
                                        $('#feedback-submit').show();
                                        clear_form($('#feedback-form'));
                                    });
                                }, 3000);
                            }, 2000);
                        }
                    }
            );
        },
        errorClass: 'form-validate-error'
    });

    // callback form validate
    $('#callback-form').validate({
        focusInvalid: true,
        focusCleanup: false,
        ignore: '',
        rules: {
            fio: {
                required: true
            },
            phone: {
                required: true
            },
            agree_private: {
                required: true
            },
            iqaptcha: {
                empty: true
            }
        },
        messages: {
            fio: {
                required: 'введите <b>ФИО</b>'
            },
            phone: {
                required: 'введите <b>телефон</b>'
            },
            agree_private: {
                required: 'подтвердите <b>согласие</b>'
            },
            iqaptcha: {
                empty: '<b>разблокируйте</b> форму'
            }
        },
        submitHandler: function(form) {
            $('#callback-submit').hide();
            $('#process-callback').fadeIn(500);

            // Отсылаем запрос
            $.post(
                    '/feedback/ajax/callback',
                    $('#callback-form').serialize(),
                    function(data) {
                        if (data === 'true')
                        {
                            setTimeout(function() {
                                $('#process-callback').hide();
                                $('#success-callback').fadeIn(500);
                                setTimeout(function() {
                                    $('.b-popup').fadeOut(300, function() {
                                        $('#overlay').fadeOut(300);
                                        $('#success-callback').hide();
                                        $('#callback-submit').show();
                                        clear_form($('#callback-form'));
                                    });
                                }, 3000);
                            }, 2000);
                        }
                    }
            );
        },
        errorClass: 'form-validate-error'
    });

    // request for sell/buy form validate
    $('#reqbuysell-form').validate({
        focusInvalid: true,
        focusCleanup: false,
        ignore: '',
        rules: {
            fio: {
                required: true
            },
            phone: {
                required: true
            },
            object_data: {
                required: true
            },
            agree_private: {
                required: true
            },
            iqaptcha: {
                empty: true
            }
        },
        messages: {
            fio: {
                required: 'введите <b>ФИО</b>'
            },
            phone: {
                required: 'введите <b>телефон</b>'
            },
            object_data: {
                required: 'введите <b>информацию</b>'
            },
            agree_private: {
                required: 'подтвердите <b>согласие</b>'
            },
            iqaptcha: {
                empty: '<b>разблокируйте</b> форму'
            }
        },
        submitHandler: function(form) {
            $('#reqbuysell-submit').hide();
            $('#process-reqbuysell').fadeIn(500);

            // Отсылаем запрос
            $.post(
                    '/feedback/ajax/reqbuysell',
                    $('#reqbuysell-form').serialize(),
                    function(data) {
                        if (data === 'true')
                        {
                            setTimeout(function() {
                                $('#process-reqbuysell').hide();
                                $('#success-reqbuysell').fadeIn(500);
                                setTimeout(function() {
                                    $('#success-reqbuysell').hide();
                                    $('#reqbuysell-submit').show();
                                    clear_form($('#reqbuysell-form'));
                                }, 3000);
                            }, 2000);
                        }
                    }
            );
        },
        errorClass: 'form-validate-error'
    });

    // request for buy form validate
    $('#reqbuy-form').validate({
        focusInvalid: true,
        focusCleanup: false,
        ignore: '',
        rules: {
            fio: {
                required: true
            },
            phone: {
                required: true
            },
            agree_private: {
                required: true
            },
            iqaptcha: {
                empty: true
            }
        },
        messages: {
            fio: {
                required: 'введите <b>ФИО</b>'
            },
            phone: {
                required: 'введите <b>телефон</b>'
            },
            agree_private: {
                required: 'подтвердите <b>согласие</b>'
            },
            iqaptcha: {
                empty: '<b>разблокируйте</b> форму'
            }
        },
        submitHandler: function(form) {
            $('#reqbuy-submit').hide();
            $('#process-reqbuy').fadeIn(500);

            // Отсылаем запрос
            $.post(
                    '/feedback/ajax/reqbuy',
                    $('#reqbuy-form').serialize(),
                    function(data) {
                        if (data === 'true')
                        {
                            setTimeout(function() {
                                $('#process-reqbuy').hide();
                                $('#success-reqbuy').fadeIn(500);
                                setTimeout(function() {
                                    $('#success-reqbuy').hide();
                                    $('#reqbuy-submit').show();
                                    clear_form($('#reqbuy-form'));
                                }, 3000);
                            }, 2000);
                        }
                    }
            );
        },
        errorClass: 'form-validate-error'
    });

    // request for exchange object
    $('#exchange-form').validate({
        focusInvalid: true,
        focusCleanup: false,
        ignore: '',
        rules: {
            fio: {
                required: true
            },
            phone: {
                required: true
            },
            object_data_1: {
                required: true
            },
            agree_private: {
                required: true
            },
            iqaptcha: {
                empty: true
            }
        },
        messages: {
            fio: {
                required: 'введите <b>ФИО</b>'
            },
            phone: {
                required: 'введите <b>телефон</b>'
            },
            object_data_1: {
                required: 'введите <b>информацию</b>'
            },
            agree_private: {
                required: 'подтвердите <b>согласие</b>'
            },
            iqaptcha: {
                empty: '<b>разблокируйте</b> форму'
            }
        },
        submitHandler: function(form) {
            $('#exchange-submit').hide();
            $('#process-exchange').fadeIn(500);

            // Отсылаем запрос
            $.post(
                    '/feedback/ajax/exchange',
                    $('#exchange-form').serialize(),
                    function(data) {
                        if (data === 'true')
                        {
                            setTimeout(function() {
                                $('#process-exchange').hide();
                                $('#success-exchange').fadeIn(500);
                                setTimeout(function() {
                                    $('.b-popup').fadeOut(300, function() {
                                        $('#overlay').fadeOut(300);
                                        $('#success-exchange').hide();
                                        $('#exchange-submit').show();
                                        clear_form($('#exchange-form'))
                                    });
                                }, 3000);
                            }, 2000);
                        }
                    }
            );
        },
        errorClass: 'form-validate-error'
    });
    
    // request for exchange object
    $('#reqviewer-form').validate({
        focusInvalid: true,
        focusCleanup: false,
        ignore: '',
        rules: {
            fio: {
                required: true
            },
            phone: {
                required: true
            },
            view_date: {
                required: true
            },
            view_time: {
                required: true
            },
            agree_private: {
                required: true
            },
            iqaptcha: {
                empty: true
            }
        },
        messages: {
            fio: {
                required: 'введите <b>ФИО</b>'
            },
            phone: {
                required: 'введите <b>телефон</b>'
            },
            view_date: {
                required: 'выберите <b>дату</b>'
            },
            view_time: {
                required: 'выберите <b>время</b>'
            },
            agree_private: {
                required: 'подтвердите <b>согласие</b>'
            },
            iqaptcha: {
                empty: '<b>разблокируйте</b> форму'
            }
        },
        submitHandler: function(form) {
            $('#reqviewer-submit').hide();
            $('#process-reqviewer').fadeIn(500);

            // Отсылаем запрос
            $.post(
                    '/feedback/ajax/reqviewer',
                    $('#reqviewer-form').serialize(),
                    function(data) {
                        if (data === 'true')
                        {
                            setTimeout(function() {
                                $('#process-reqviewer').hide();
                                $('#success-reqviewer').fadeIn(500);
                                setTimeout(function() {
                                    $('.b-popup').fadeOut(300, function() {
                                        $('#overlay').fadeOut(300);
                                        $('#success-reqviewer').hide();
                                        $('#reqviewer-submit').show();
                                        clear_form($('#reqviewer-form'))
                                    });
                                }, 3000);
                            }, 2000);
                        }
                    }
            );
        },
        errorClass: 'form-validate-error'
    });

    // Метод проверки поля на пустоту, TRUE - если поле пустое
    $.validator.addMethod('empty', function(value) {
        return (value == '');
    });

    // qaptcha generate
    if ($.fn.QapTcha && $('.qaptcha').length)
    {
        qaptcha_generate();
    }

// bind datepicker for rewuest viewer form
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    $('#reqviewer-form #view_date').datepicker({
        dateFormat: 'dd.mm.yy'
    });
});