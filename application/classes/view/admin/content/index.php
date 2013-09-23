<?php

/*
  Вид для контроллера home, действия index
 */
class View_Admin_Content_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Работа с текстовыми страницами';
    public $menu_head = 'Разделы и страницы';
    public $root;

    /*     * *
      В конструкторе сразу определяем требуемые показатели:
      категорию-родитель, категории-дети, и корневую категорию
     * * */
    public function __construct($template = NULL, array $partials = NULL, $alien_call = false)
    {
        parent::__construct($template, $partials, $alien_call);

        // Находим корневой раздел
        $this->root = Sprig::factory('content')->root(1);
        // Если раздела нет - создаем
        if (!$this->root->loaded())
        {
            $this->root->name = 'Основные разделы';
            try
            {
                $this->root->insert_as_new_root(1);
            }
            catch (Validate_Exception $e)
            {
                echo 'Не удалось создать корневой раздел';
            }
        }
    }

    /*     * *
      Hook Menu
      Метод срабатывает только для других модулей при построении меню
      поэтому здесь достаточно выводить корневой раздел
     * * */
    public function menu_items()
    {
        $items = Array('name' => $this->menu_head);
        $items['items'][0] = Array(
            'name' => $this->root->name,
            'url' => '/admin/content/open/' . $this->root->id,
            'hav_sub_items' => $this->get_have_childrens($this->root->id),
        );
        return $items;
    }

    /*     * *
      Функция возвращает истину, если у категории
      есть дети и ложь в противном случае
     * * */
    protected function get_have_childrens($page_id)
    {
        // Создаем объект страницы
        $page = Sprig::factory('content', array('id' => $page_id))->load();
        // Получение разделов-детей
        $childrens = $page->children;
        // Получаем количество детей
        $children_count = count($childrens);

        return (!empty($children_count)) ? true : false;
    }

}