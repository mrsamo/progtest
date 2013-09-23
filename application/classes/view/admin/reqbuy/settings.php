<?php

/*
 * Вид для контроллера reqbuy, действия Settings
 * Наследуем от класса для действия Index
 */
class View_Admin_Reqbuy_Settings extends View_Admin_Reqbuy_Index
{
    public $reqbuy_email;

    /*
     * Обновляем конструктор-родитель
     * Сразу получаем данные о текущих настройках
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);
        
        $this->title .= ' :: Настройки';

        // Если есть POST данные - обновляем настройки
        if (!empty($_POST))
            $this->message_data = $this->update_settings($_POST);

        // Загружаем настройки
        $this->reqbuy_email = $this->get_variable('reqbuy_email');

        // Если настройик в системе нет - добавляем со значением по умолчанию
        if (empty($this->reqbuy_email))
            $this->reqbuy_email = $this->set_variable('reqbuy_email', 'Email для получения запросов на покупку', NULL, 0);

        // Замены мнемоника пустого поля на пустое поле :)
        if ($this->reqbuy_email == 'empty')
            $this->reqbuy_email = '';
    }

    /*
     * Hook Menu
     * Добавляем активность текущему разделу
     */
    public function menu_items($my = FALSE)
    {
        $items = parent::menu_items($my);
        $items['items'][1]['active_root'] = TRUE;
        return $items;
    }    

}