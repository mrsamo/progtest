<?php

/*
 * Вид для контроллера Feedback, действия Settings
 * Наследуем от класса для действия Index
 */
class View_Admin_Feedback_Settings extends View_Admin_Feedback_Index
{

    public $title = 'Администрирование :: Обратная связь :: Настройки';
    public $fos_email;

    /*
     * Обновляем конструктор-родитель
     * Сразу получаем данные о текущих настройках
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Если есть POST данные - обновляем настройки
        if (!empty($_POST))
            $this->message_data = $this->update_settings($_POST);

        // Загружаем настройки
        $this->fos_email = $this->get_variable('fos_email');

        // Если настройик в системе нет - добавляем со значением по умолчанию
        if (empty($this->fos_email))
            $this->fos_email = $this->set_variable('fos_email', 'Email для получения писем ФОС', NULL, 0);

        // Замены мнемоника пустого поля на пустое поле :)
        if ($this->fos_email == 'empty')
            $this->fos_email = '';
    }

    /*
     * Hook Menu
     * Добавляем активность текущему разделу
     */
    public function menu_items($my = false)
    {
        $items = parent::menu_items($my);

        $items['items'][1]['active_root'] = true;

        return $items;
    }    

}