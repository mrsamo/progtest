$(document).ready(function() {

    /*
* Функция сабмита удаления image баннера
*/
    $('.delete_banner').click(function(){
	// Узнаем, действительно ли нужно удаление
	var answer = confirm('Действительно хотите удалить баннер?');

	// Удаление подтверждено
	if (answer == true)
	{
	    // Регистрируем действие
	    $('#action').val('delete');
	    // Добавляем статус в поля формы
	    $('#work_id').val($(this).attr('rel'));
	    // Сабмитим форму
	    $('#bannersForm').submit();
	}
	return false;
    });

    /*
 * Функция сабмита добавления/обновления image баннера
 */
    $('.save_banner').click(function(){
	// Сабмитим форму добавления/обновления баннера
	$('#addBannerForm').submit();
	return false;
    });
    
    /*
     * Отображение полей при изменении типа подарка
     */
    $('#type').change(function(){
	validator.resetForm();
	common_form($(this).val());
    });
    
    /*
     * Функция скрытия/отображения полей в
     * зависимости от выбора типа баннера
     */
    function common_form(type)
    {
	if(type == 'image')
	{
	    // Ставим метку, чтобы не проверять изображение
	    $('#no_flash').val(1);
	    if ($('#id').val() != '')
		$('#no_img').val(1);
	    else
		$('#no_img').val(0);
	    
	    // Скрываем нужные поля
	    $('div[rel="flash"]').hide();
	    $('div[rel="text"]').hide();
	    // Отображаем нужные поля
	    $('div[rel="image"]').fadeIn('slow');
	    
	    // Обнуляем ненужные поля
	    $('#width').val('');
	    $('#height').val('');
	    $('#flash').val('');
	    $('#source').val('');
	}
	else if(type == 'flash')
	{
	    // Ставим метку, чтобы не проверять изображение
	    $('#no_img').val(1);
	    if ($('#id').val() != '')
		$('#no_flash').val(1);
	    else
		$('#no_flash').val(0);
	    
	    // Скрываем нужные поля
	    $('div[rel="image"]').hide();
	    $('div[rel="text"]').hide();
	    // Отображаем нужные поля
	    $('div[rel="flash"]').fadeIn('slow');
	    
	    // Обнуляем ненужные поля
	    $('#link').val('');
	    $('#image').val('');
	    $('#source').val('');
	}
	else
	{
	    // Ставим метку, чтобы не проверять изображение и флэш
	    $('#no_img').val(1);
	    $('#no_flash').val(1);
	    
	    // Скрываем нужные поля
	    $('div[rel="image"]').hide();
	    $('div[rel="flash"]').hide();
	    // Отображаем нужные поля
	    $('div[rel="text"]').fadeIn('slow');
	    
	    // Обнуляем ненужные поля
	    $('#link').val('');
	    $('#image').val('');
	    $('#width').val('');
	    $('#height').val('');
	    $('#flash').val('');
	}
    }

    /*
     * Валидации формы создания/редактирования image баннера
     */
    validator = $('#addBannerForm').validate({
	focusInvalid: false,
	focusCleanup: false,
	rules: {
	    link: {
		url: true
	    },
	    image: {
		required_ifselect2: 'type:image:no_img',
		valid_image: true
	    },
	    width: {
		required_ifselect: 'type:flash'
	    },
	    height: {
		required_ifselect: 'type:flash'
	    },
	    flash: {
		required_ifselect2: 'type:flash:no_flash',
		valid_flash: true
	    }
	},
	messages: {
	    link: {
		url: 'Введите корректный адрес'
	    },
	    image: {
		required_ifselect2: 'Заполните поле изображения',
		valid_image: 'Необходимо выбрать JPG, GIF или PNG файл для загрузки'
	    },
	    width: {
		required_ifselect: 'Введите ширину баннера'
	    },
	    height: {
		required_ifselect: 'Введите высоту баннера'
	    },
	    flash: {
		required_ifselect2: 'Заполните поле Flash файла',
		valid_flash: 'Необходимо выбрать SWF файл для загрузки'
	    }
	},
	submitHandler: function(form) {
	    if (validate_wysiwyg())
		form.submit();
	},
	invalidHandler: function(form, validator) {
	    validate_wysiwyg();
	},
	errorClass: 'invalid',
	errorContainer: '#error1, #error2',
	errorLabelContainer: '#error1 ul',
	wrapper: 'li'
    });

    // Метод проверки расширения изображения
    $.validator.addMethod('valid_image', function(value) {
	// Если добавляется изображение
	// и если добавляется баннер - проверяем обязательность и расширение
	if ($('#no_img').val() != 1 || value != '')
	{
	    ext = value.substring(value.lastIndexOf('.')+1, value.length).toLowerCase();
	    if  (ext != 'jpg' && ext != 'gif' && ext != 'png')
		return false;
	    return true;
	}
	return true;
    });

    // Метод проверки расширения flash
    $.validator.addMethod('valid_flash', function(value) {
	// Если добавляется flash
	// и если добавляется баннер - проверяем обязательность и расширение
	if ($('#no_flash').val() != 1 || value != '')
	{
	    ext = value.substring(value.lastIndexOf('.')+1, value.length).toLowerCase();
	    if  (ext != 'swf')
		return false;
	    return true;
	}
	return true;
    });
    
    // Функция обновляет элементы визивига и выводит вручную ошибку
    // о пустых визивиг полях в общий контейнер ошибок
    function validate_wysiwyg()
    {
	for (instance in CKEDITOR.instances)
	    CKEDITOR.instances[instance].updateElement();
	if ($('#type').val() == 'text' && $('#source').val() == '')
	{
	    $('#wysiwyg_error').show('fast');
	    $('#error1').show('fast');
	    $('#error1 ul').show('fast');
	    $('#error2').show('fast');
	    return false;
	}
	else
	{
	    $('#wysiwyg_error').hide('fast');
	    return true;
	}
    }    
    
    // Изначально подготавливаем форму
    common_form($('#type').val());
});