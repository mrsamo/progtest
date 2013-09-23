<?php

/*
	Вид для контроллера Content, действия Edit
	Наследуем от класса для действия Open
*/

class View_Admin_Content_Edit extends View_Admin_Content_Open
{
	public $title = 'Администрирование :: Работа с текстовыми страницами :: Редактирование страницы';
	public $editable = true;

	/* * *
		Обновляем конструктор-родитель
	* * */
	public function __construct($template = NULL, array $partials = NULL)
	{
		// Если был сабмит формы редактирования
		if (!empty($_POST['action']) && $_POST['action'] == 'update' && !empty($_POST['name']) && !empty($_POST['url']) && !empty($_POST['ord']))
			$this->message_data = $this->update_page($_POST);
		elseif (!empty($_POST['action']) && $_POST['action'] == 'update')
			$this->message_data = Array('text' => 'Заполните обязательные поля', 'error' => 1);

		// Шаблон берем от метода Add
		$template = 'admin/content/add';

		parent::__construct($template, $partials);
	}

	/* * *
		Функция сабмита формы редактирования страницы
		На входе массив POST
	* * */
	public function update_page(Array $post_arr)
	{
		// Загружаем данные о странице
		$page = Sprig::factory('content', array('id' => $post_arr['id']))->load();
		$page->values($post_arr);
		$page->update();

		// После добавления страницы необходимо перезагрузить ткущую категорию
		// Чтобы обновить список детей
		//$this->cur_page = Sprig::factory('content', array('id' => $this->id))->load();

		return Array('text' => 'Страница обновлена', 'error' => 0);
	}
}