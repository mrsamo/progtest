$(document).ready(function() {

    /* * *
     Функция отображения блока ссылки на материал
     * * */
    $('a.hyperlinkControl').click(function() {
        $('div.hyperlink[rel=' + $(this).attr('rel') + ']').toggle('slow');
        return false;
    });

    /* * *
     Отображение сообщения от системы администратору
     Если сообщение для администратора есть
     Показываем на 3 секунды и скрываем
     * * */
    $('.message').delay(500).slideToggle('slow').delay(2000).slideToggle('slow');
    
    // Submit module form
    $('.submit-module').click(function(event){
        event.preventDefault();
        // Сабмитим форму
        $(this).closest('form').submit();
    });


    /* * *
     Создаем эффект изменения прозрачности
     при наведении на картинку - не знаю зачем. но прикольно
     * * */
    if ($.browser.msie && $.browser.version > 5 && $.browser.version <= 8) {
        // Ничего не делаем для IE между 5 и 8 версией
    } else {
        $('img').hover(
                function() {
                    $(this).animate({
                        opacity: 0.6
                    }, 150);
                },
                function() {
                    $(this).animate({
                        opacity: 1.0
                    }, 50);
                }
        );
    }

});