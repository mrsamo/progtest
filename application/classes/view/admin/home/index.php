<?php

/*
	Вид для контроллера home, действия index
*/

class View_Admin_Home_Index extends View_Admin_Layout
{
	public $title = 'Администрирование';

	/*
		Обновляем конструктор
	*/
	public function __construct()
	{
		parent::__construct();
	}
}