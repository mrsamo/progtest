<?php

/*
	Вид для контроллера exit, действия index
*/

class View_Admin_Exit_Index extends View_Admin_Layout
{
	public function __construct($template = NULL, array $partials = NULL)
	{
		parent::__construct($template, $partials);

		$this->auth = Auth::instance();
		$this->auth->logout();
		$request = Request::factory(false);
		$request->redirect('/admin/login');
	}
}