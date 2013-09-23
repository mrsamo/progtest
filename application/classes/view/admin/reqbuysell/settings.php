<?php

/*
 * Вид для контроллера reqbuysell, действия Settings
 * Наследуем от класса для действия Index
 */
class View_Admin_Reqbuysell_Settings extends View_Admin_Reqbuysell_Index
{
    public $reqbuysell_email;

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
        $this->reqbuysell_email = $this->get_variable('reqbuysell_email');

        // Если настройик в системе нет - добавляем со значением по умолчанию
        if (empty($this->reqbuysell_email))
            $this->reqbuysell_email = $this->set_variable('reqbuysell_email', 'Email для получения запросов на покупку/продажу', NULL, 0);

        // Замены мнемоника пустого поля на пустое поле :)
        if ($this->reqbuysell_email == 'empty')
            $this->reqbuysell_email = '';
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