<?php

/*
 * Вид для контроллера Baner, действия Edit
 * Наследуем от класса для действия Index
 */

class View_Admin_Banner_Edit extends View_Admin_Banner_Index {

    public $title = 'Администрирование :: Баннеры :: Редактирование баннера';
    public $editable = TRUE;
    public $cur_banner;

    /*
     * Обновляем конструктор-родитель
     * Сразу получаем данные о текущем баннере
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
	// Шаблон берем от метода Add
	$template = 'admin/banner/add';

	parent::__construct($template, $partials, TRUE);
	
	// Создаем объект текущей новости
	$this->cur_banner = Sprig::factory('banner', array('id' => $this->id))->load()->as_array();
	// Регистрируем метку о типе баннера
	$this->cur_banner[$this->cur_banner['type']] = TRUE;
    }

}