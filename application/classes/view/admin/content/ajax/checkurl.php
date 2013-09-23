<?php

/*
	Вид для контроллера home, действия index
*/

class View_Admin_Content_Ajax_Checkurl extends Kohana_Kostache_Layout
{
	protected $_layout = 'admin/content/ajax/checkurl';

	/* * *
		Обновляем конструктор-родитель
	* * */
	public function __construct($template = NULL, array $partials = NULL)
	{
		parent::__construct($template, $partials);
	}

	/* * *
		AJAX ответ
	* * */
	public function ajax_response()
	{
		// Если передан URL - обрабатываем запрос
		if (!empty($_GET['url']))
		{
			// Создаем объект страницы с таким URL
			$page = Sprig::factory('content', array('url' => $_GET['url']))->load();
			// Если записи с таким URL нет - все хорошо (хотя такого быть не должно)
			if (!$page->loaded())
			{
				return 'true';
			}
			// Нашли страницу с таким URL
			// Проверяем, не это ли страница, с которой идет проверка
			else
			{
				if ($page->id == $_GET['id'])
					return 'true';
				else
					return 'false';
			}
		}
		return 'false';
	}
}