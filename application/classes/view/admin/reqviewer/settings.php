<?php

/*
 * Вид для контроллера reqviewer, действия Settings
 * Наследуем от класса для действия Index
 */
class View_Admin_Reqviewer_Settings extends View_Admin_Reqviewer_Index
{
    public $reqviewer_email;

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
        $this->reqviewer_email = $this->get_variable('reqviewer_email');

        // Если настройик в системе нет - добавляем со значением по умолчанию
        if (empty($this->reqviewer_email))
            $this->reqviewer_email = $this->set_variable('reqviewer_email', 'Email для получения запросов на осмотр', NULL, 0);

        // Замены мнемоника пустого поля на пустое поле :)
        if ($this->reqviewer_email == 'empty')
            $this->reqviewer_email = '';
    }

    /*
     * Hook Menu
     * Добавляем активность текущему разделу
     */
    public function menu_items($my = false)
    {
        $items = parent::menu_items($my);

        $items['items'][1]['active_root'] = TRUE;

        return $items;
    }    

}