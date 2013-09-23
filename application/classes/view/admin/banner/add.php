<?php

/*
 * Вид для контроллера Banners, действия Add
 * Наследуем от класса для действия Index
 */

class View_Admin_Banner_Add extends View_Admin_Banner_Index {

    public $title = 'Администрирование :: Баннеры :: Создание баннера';
    public $editable = FALSE;

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
	parent::__construct($template, $partials);
    }

}