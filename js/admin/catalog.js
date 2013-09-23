$(document).ready(function() {

    /* * *
     Валидация вводимых значений в поля задания порядка
     * * */
    $('.ord_catalog').keyup(function(event) {
        var reg_number = /[^0-9]/g;

        // Задаем новое корректное значение
        $(this).val($(this).val().replace(reg_number, ''));
    });

    /* * *
     Функция сабмита применения порядка
     * * */
    $('.ord_catalog_submit').click(function() {
        // Регистрируем действие
        $('#action').val('order');
        // Сабмитим форму применения порядка
        $('#open_catalog_form').submit();
        return false;
    });

    /* * *
     Функция сабмита изменения статуса
     * * */
    $('.status_catalog').click(function() {
        // Регистрируем действие
        $('#action').val('status');
        // Добавляем статус в поля формы
        $('#work_id').val($(this).attr('rel'));
        // Сабмитим форму применения порядка
        $('#open_catalog_form').submit();
        return false;
    });

    $('.delete-catalog').click(function() {
        // Узнаем, действительно ли нужно удаление
        var answer = confirm($(this).data('confirm'));

        // Удаление подтверждено
        if (answer == true)
        {
            // Регистрируем действие
            $('#action').val('delete');
            // Добавляем статус в поля формы
            $('#work_id').val($(this).attr('rel'));
            // Сабмитим форму применения порядка
            $(this).closest('form').submit();
        }
        return false;
    });

    /* * *
     * Валидации формы добавления/редактирования категории
     * * */
    $('#add_category_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        rules: {
            ord: {
                required: true,
                number: true
            },
            name: {
                required: true
            }
        },
        messages: {
            ord: {
                required: 'Введите <b>порядок</b> для категории',
                number: '<b>Порядок</b> может содержать только цифры'
            },
            name: {
                required: 'Введите <b>имя</b> для категории'
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

    /* * *
     * Валидации формы добавления/редактирования
     * объекта недвижимости
     * * */
    $('#add_object_form').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        rules: {
            ord: {
                required: true,
                number: true
            },
            name: {
                required: true
            },
            price: {
                required: true,
                number: true
            },
            city: {
                required: true
            },
            floor: {
                required: true,
                number: true
            },
            floors: {
                number: true
            },
            square: {
                required: true,
                number: true
            },
            square_2: {
                required: true,
                number: true
            },
            rooms: {
                required: true,
                number: true
            },
            image: {
                image_valid: true
            },
            virtour: {
                url: true
            }
        },
        messages: {
            ord: {
                required: 'Введите <b>порядок</b> для объекта',
                number: '<b>Порядок</b> может содержать только цифры'
            },
            name: {
                required: 'Введите <b>наименование</b> объекта'
            },
            price: {
                required: 'Введите <b>стоимость</b> объекта',
                number: '<b>Цена</b> может содержать только цифры'
            },
            city: {
                required: 'Введите <b>город</b> объекта',
            },
            floor: {
                required: 'Введите <b>этаж</b> объекта',
                number: '<b>Этаж</b> может содержать только цифры'
            },
            floors: {
                number: '<b>Этажность</b> может содержать только цифры'
            },
            square: {
                required: 'Введите <b>общую площадь</b>',
                number: '<b>Общая площадь</b> может быть только числом'
            },
            square_2: {
                required: 'Введите <b>общую площадь участка</b>',
                number: '<b>Общая площадь участка</b> может быть только числом'
            },
            rooms: {
                required: 'Введите <b>количество комнат</b>',
                number: '<b>Количество комнат</b> может быть только числом'
            },
            image: {
                image_valid: 'Необходимо выбрать JPG, GIF или PNG изображение для загрузки'
            },
            virtour: {
                url: 'Поле <b>виртуальный тур</b> может содержать только корректный URL адрес'
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

    // Метод проверки расширения изображения
    $.validator.addMethod('image_valid', function(value) {
        // Если изображение выбрано - проверяем его
        if (value != '')
        {
            ext = value.substring(value.lastIndexOf('.') + 1, value.length).toLowerCase();
            if (ext != 'jpg' && ext != 'gif' && ext != 'png')
                return false;
            return true;
        }
        return true;
    });
});