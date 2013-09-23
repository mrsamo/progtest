<?php

/*
	Вид для контроллера Catalog, действия Settings
	Наследуем от класса для действия Index
*/

class View_Admin_Catalog_Settings extends View_Admin_Catalog_Index
{
	public $title = 'Администрирование :: Работа с каталогом услуг :: Настройки';
	public $catalog_content;
	public $catalog_meta_title;
	public $catalog_meta_keywords;
	public $catalog_meta_description;


	/* * *
		Обновляем конструктор-родитель
		Сразу получаем данные о текущих настройках
	* * */
	public function __construct($template = NULL, array $partials = NULL)
	{
		parent::__construct($template, $partials);

		// Если есть POST данные - обновляем настройки
		if (!empty($_POST))
			$this->message_data = $this->update_settings($_POST);

		// Загружаем настройки
		$this->catalog_content = $this->get_variable('catalog_content');
		$this->catalog_meta_title = $this->get_variable('catalog_meta_title');
		$this->catalog_meta_keywords = $this->get_variable('catalog_meta_keywords');
		$this->catalog_meta_description = $this->get_variable('catalog_meta_description');

		// Если настройик в системе нет - добавляем со значением по умолчанию
		if (empty($this->catalog_content))
			$this->catalog_content = $this->set_variable('catalog_content', 'Описание в каталоге', NULL, 0);
		if (empty($this->catalog_meta_title))
			$this->catalog_meta_title = $this->set_variable('catalog_meta_title', 'Meta-title в каталоге', NULL, 0);
		if (empty($this->catalog_meta_keywords))
			$this->catalog_meta_keywords = $this->set_variable('catalog_meta_keywords', 'Meta-keywords в каталоге', NULL, 0);
		if (empty($this->catalog_meta_description))
			$this->catalog_meta_description = $this->set_variable('catalog_meta_description', 'Meta-description в каталоге', NULL, 0);

		// Замены мнемоника пустого поля на пустое поле :)
		if($this->catalog_content == 'empty')
			$this->catalog_content = '';
		if($this->catalog_meta_title == 'empty')
			$this->catalog_meta_title = '';
		if($this->catalog_meta_keywords == 'empty')
			$this->catalog_meta_keywords = '';
		if($this->catalog_meta_description == 'empty')
			$this->catalog_meta_description = '';
	}

	/* * *
		Hook Menu
		Добавляем активность текущему разделу
	* * */
	public function menu_items($my = false)
	{
		$items = parent::menu_items($my);

		$items['items'][1]['active_root'] = true;

		return $items;
	}

	/* * *
		Функция сабмита формы обновления настроек
		На входе массив POST
	* * */
	protected function update_settings(Array $post_arr)
	{
		$post_arr['catalog_content'] = $post_arr['content'];
		// Проходим по всему массиву данных
		foreach($post_arr as $key => $value)
		{
			// Загружаем данные о настройке
			$settings = Sprig::factory('settings', array('param' => $key))->load();
			// Если такая настройка есть - обновляем ее
			if ($settings->loaded())
			{
				$settings->value = $value;
				$settings->update();
			}
		}

		return Array('text' => 'Настройки обновлены', 'error' => 0);
	}
}