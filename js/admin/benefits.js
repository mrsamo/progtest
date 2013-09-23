$(document).ready(function() {

    /*
     * Функция сабмита изменения статуса
     */
    $('.status-benefit').click(function(){
        // Регистрируем действие
        $('#action').val('status');
        // Добавляем статус в поле формы
        $('#work_id').val($(this).attr('rel'));
        // Сабмитим форму
        $('#benefitsForm').submit();
        return false;
    });

    /*
     * Функция сабмита удаления преимущества
     */
    $('.delete-benefit').click(function(){
        // Узнаем, действительно ли нужно удаление
        var answer = confirm('Действительно хотите удалить преимущество?');

        // Удаление подтверждено
        if (answer == true)
        {
            // Регистрируем действие
            $('#action').val('delete');
            // Добавляем статус в поле формы
            $('#work_id').val($(this).attr('rel'));
            // Сабмитим форму
            $('#benefitsForm').submit();
        }
        return false;
    });

    /*
     * Функция сабмита добавления преимущества
     */
    $('.save-benefit').click(function(){
        // Сабмитим форму
        $('#addBenefitForm').submit();
        return false;
    });

    /*
     * Валидации формы создания/редактирования преимущества
     */
    $('#addBenefitForm').validate({
        focusInvalid: false,
        focusCleanup: false,
        //onkeyup: false,
        rules: {
            title: {
                required: true
            },
            content: {
                required: true
            },
            image: {
                image_valid: true
            }
        },
        messages: {
            title: {
                required: 'Введите заголовок преимущества'
            },
            content: {
                required: 'Введите текст преимущества'
            },
            image: {
                image_valid: 'Необходимо выбрать JPG, GIF или PNG файл для загрузки'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {},
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: "#error1 ul",
        wrapper: 'li'
    });

    // Метод проверки расширения изображения
    $.validator.addMethod('image_valid', function(value) {
        // Если изображение выбрано - проверяем его
        if (value != '')
        {
            ext = value.substring(value.lastIndexOf('.')+1, value.length).toLowerCase();
            if  (ext != 'jpg' && ext != 'gif' && ext != 'png')
                return false;
            return true;
        }
        return true;
    });
    
});