<?php

/*
 * Вид для контроллера callback, действия Settings
 * Наследуем от класса для действия Index
 */
class View_Admin_Callback_Settings extends View_Admin_Callback_Index
{
    public $callback_email;

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
        $this->callback_email = $this->get_variable('callback_email');

        // Если настройик в системе нет - добавляем со значением по умолчанию
        if (empty($this->callback_email))
            $this->callback_email = $this->set_variable('callback_email', 'Email для получения запросов обратного звонка', NULL, 0);

        // Замены мнемоника пустого поля на пустое поле :)
        if ($this->callback_email == 'empty')
            $this->callback_email = '';
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