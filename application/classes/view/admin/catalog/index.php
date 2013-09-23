<?php

/*
 * Вид для контроллера home, действия index
 */
class View_Admin_Catalog_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Каталог';
    public $menu_head = 'Каталог';
    public $root;
    public $root_1;
    public $root_2;
    public $root_3;
    public $root_4;
    public $domen;

    /*
     * В конструкторе сразу определяем требуемые показатели:
     * категорию-родитель, категории-дети, и корневую категорию
     */
    public function __construct($template = NULL, array $partials = NULL, $alien_call = false)
    {
        parent::__construct($template, $partials, $alien_call);

        $this->domen = $_SERVER['HTTP_HOST'];

        // Находим корневые разделы
        $this->root_1 = Sprig::factory('catalog')->root(1);
        $this->root_2 = Sprig::factory('catalog')->root(2);
        $this->root_3 = Sprig::factory('catalog')->root(3);
        $this->root_4 = Sprig::factory('catalog')->root(4);
        // Если раздела нет - создаем
        if (!$this->root_1->loaded() or $this->root_2->loaded() or $this->root_3->loaded() or $this->root_4->loaded())
        {
            $this->root_1->name = 'Загородная недвижимость';
            $this->root_2->name = 'Городская недвижимость';
            $this->root_3->name = 'Коммерческая недвижимость';
            $this->root_4->name = 'Готовый бизнес';
            try
            {
                $this->root_1->insert_as_new_root(1);
                $this->root_2->insert_as_new_root(2);
                $this->root_3->insert_as_new_root(3);
                $this->root_4->insert_as_new_root(4);
            }
            catch (Validate_Exception $e)
            {
                echo 'Не удалось создать корневые разделы';
            }
        }
    }

    /*
     * Hook Menu
     * Метод срабатывает только для других модулей при построении меню
     * поэтому здесь достаточно выводить корневой раздел
     */
    public function menu_items()
    {
        $items = Array('name' => $this->menu_head);
        $items['items'][0] = Array(
            'name' => $this->root_1->name,
            'url' => '/admin/catalog/open/' . $this->root_1->id,
            'hav_sub_items' => $this->get_have_childrens($this->root_1->id),
        );
        $items['items'][1] = Array(
            'name' => $this->root_2->name,
            'url' => '/admin/catalog/open/' . $this->root_2->id,
            'hav_sub_items' => $this->get_have_childrens($this->root_2->id),
        );
        $items['items'][2] = Array(
            'name' => $this->root_3->name,
            'url' => '/admin/catalog/open/' . $this->root_3->id,
            'hav_sub_items' => $this->get_have_childrens($this->root_3->id),
        );
        $items['items'][3] = Array(
            'name' => $this->root_4->name,
            'url' => '/admin/catalog/open/' . $this->root_4->id,
            'hav_sub_items' => $this->get_have_childrens($this->root_4->id),
        );

        return $items;
    }

    /*
     * Функция возвращает истину, если у категории
     * есть дети и ложь в противном случае
     */
    protected function get_have_childrens($category_id)
    {
        // Создаем объект категории
        $category = Sprig::factory('catalog', array('id' => $category_id))->load();
        // Получение разделов-детей
        $childrens = $category->children;
        // Получаем количество детей
        $children_count = count($childrens);

        return (!empty($children_count)) ? true : false;
    }

}