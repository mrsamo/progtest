<?php

/*
 * Вид для контроллера exchange, действия Settings
 * Наследуем от класса для действия Index
 */
class View_Admin_Exchange_Settings extends View_Admin_Exchange_Index
{
    public $exchange_email;

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
        $this->exchange_email = $this->get_variable('exchange_email');

        // Если настройик в системе нет - добавляем со значением по умолчанию
        if (empty($this->exchange_email))
            $this->exchange_email = $this->set_variable('exchange_email', 'Email для получения запросов на обмен', NULL, 0);

        // Замены мнемоника пустого поля на пустое поле :)
        if ($this->exchange_email == 'empty')
            $this->exchange_email = '';
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