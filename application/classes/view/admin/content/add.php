<?php

/*
	Вид для контроллера Content, действия Open
	Наследуем от класса для действия Open
*/

class View_Admin_Content_Add extends View_Admin_Content_Open
{
	public $title = 'Администрирование :: Работа с текстовыми страницами :: Создание страницы';
	
	/* * *
		Обновляем конструктор-родитель
	* * */
	public function __construct($template = NULL, array $partials = NULL)
	{
		parent::__construct($template, $partials);
	}
}