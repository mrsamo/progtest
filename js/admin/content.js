$(document).ready(function() {

    /* * *
	Валидация вводимых значений в поля задания порядка
* * */
    $('.ord_content').keyup(function(event){
        var reg_number = /[^0-9]/g;

        // Если нажат Enter - производим сабмит формы порядка
        //if (event.keyCode == 13){}
        // Получаем введенное значение
        /*value = $(this).val();alert($(this).val());
	// Удаляем все, кроме цифр
	value = value.replace(reg_number, '');alert($(this).val());*/
	
        // Задаем новое корректное значение
        $(this).val($(this).val().replace(reg_number, ''));
    });

    /* * *
	Функция сабмита применения порядка
* * */
    $('.ord_content_submit').click(function(){
        // Регистрируем действие
        $('#action').val('order');
        // Сабмитим форму применения порядка
        $('#openContentForm').submit();
        return false;
    });

    /* * *
	Функция сабмита изменения статуса
* * */
    $('.status_content').click(function(){
        // Регистрируем действие
        $('#action').val('status');
        // Добавляем статус в поля формы
        $('#work_id').val($(this).attr('rel'));
        // Сабмитим форму применения порядка
        $('#openContentForm').submit();
        return false;
    });

    /* * *
	Функция сабмита удаления страницы
* * */
    $('.delete_content').click(function(){
        // Узнаем, действительно ли нужно удаление
        var answer = confirm('Действительно хотите удалить страницу?');

        // Удаление подтверждено
        if (answer == true)
        {
            // Регистрируем действие
            $('#action').val('delete');
            // Добавляем статус в поля формы
            $('#work_id').val($(this).attr('rel'));
            // Сабмитим форму применения порядка
            $('#openContentForm').submit();
        }
        return false;
    });

    /* * *
	Функция сабмита добавления страницы
* * */
    $('.save_content').click(function(){
        // Сабмитим форму
        $('#addContentForm').submit();
        return false;
    });

    /* * *
	Валидации формы создания/редактирования страницы
* * */
    $('#addContentForm').validate({
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
            url: {
                required: true,
                regex: '^[a-zA-Z0-9_-/]+$',
                remote: {
                    url: '/admin/content/ajax/checkurl',
                    data: {
                        id: function() {
                            return $('#id').val();
                        }
                    }
                }
            }
        },
        messages: {
            ord: {
                required: 'Введите порядок для страницы',
                number: 'Порядок может содержать только цифры'
            },
            name: {
                required: 'Введите имя для страницы'
            },
            url: {
                required: 'Введите вербальный путь для страницы',
                regexp: 'Вербальный путь может содержать только латинские буквы, цифры и знак подчеркивания',
                remote: '<a href="/section/' + $('#url').val() + '" target="_blank" style="color:black;text-decoration:underline;">Страница</a> с таким вербальным путем уже существует'
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(form, validator) {

        },
        errorClass: 'invalid',
        errorContainer: '#error1, #error2',
        errorLabelContainer: "#error1 ul",
        wrapper: 'li'
    });

});