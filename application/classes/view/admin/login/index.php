<?php

/*
	Вид для контроллера home, действия index
*/

class View_Admin_Login_Index extends View_Admin_Layout
{
	public $title = 'Администрирование :: Авторизация';

	// Задаем свой слой обработки шаблона, направленный
	// сразу на конечный шаблон, чтобы использовать свои header и footer
	protected $_layout = 'admin/login/index';

	public function __construct($template = NULL, array $partials = NULL)
	{
		parent::__construct($template, $partials);
	}
}