<?php

/*
	Вид для контроллера Infoblock, действия Edit
*/

class View_Admin_Infoblock_Edit extends View_Admin_Infoblock_Index
{
	public $title = 'Администрирование :: Блоки информации :: Редактирование блока';
	public $message_data;
	
	/* * *
		В конструкторе сразу определяем текущий редактируемый блок
	* * */
	public function __construct($template = NULL, array $partials = NULL)
	{
		parent::__construct($template, $partials);

		// Создаем объект текущего инфоблока
		$this->cur_infoblock = Sprig::factory('infoblock', array('id' => $this->id))->load();

		// Если был сабмит формы обновления инфоблока - обновляем
		if (!empty($_POST['id']))
			$this->message_data = $this->update_infoblock($_POST);
	}

	/* * *
		Hook Menu
		Метод срабатывает только для других модулей при построении меню
		В данном случае, меню модуля не меняется и добавляется только выделение
		// для текущего инфоблока
	* * */
	public function menu_items()
	{
		// Получаем массив со всеми инфоблоками
		$items = parent::menu_items();

		// Проходим по массиву и добавляем активность текущему блоку
		for($i=0; $i<$this->count_infoblocks; $i++)
		{
			if ($items['items'][$i]['id'] == $this->cur_infoblock->id)
				$items['items'][$i]['active_root'] = true;
		}

		return $items;
	}

	/* * *
		Функция обновления инфоблока
	* * */
	private function update_infoblock(Array $post_arr)
	{
		// Привязываем POST данные
		$this->cur_infoblock->values($post_arr);
		$this->cur_infoblock->update();

		// После обновления инфоблока перегружаем его для вывода актуальной информации
		$this->cur_infoblock = Sprig::factory('infoblock', array('id' => $post_arr['id']))->load();

		return Array('text' => 'Блок информации обновлен', 'error' => 0);
	}
}