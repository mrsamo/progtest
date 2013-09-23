<?php

/*
  Вид для контроллера Infoblock, действия index
 */
class View_Admin_Infoblock_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Блоки информации';
    public $count_infoblocks = 0;
    public $menu_head = 'Блоки информации';

    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);
    }

    /*     * *
      Hook Menu
      Метод срабатывает только для других модулей при построении меню
      В данном случае, меню модуля не меняется и добавляется только выделение
      // для текущего инфоблока
     * * */
    public function menu_items()
    {
        $items = Array('name' => $this->menu_head);

        // Выбираем все инфоблоки
        $infoblocks = Sprig::factory('infoblock')->load(DB::select('*')->order_by('id', 'ASC'), NULL)->as_array();
        $this->count_infoblocks = count($infoblocks);

        // Если блоков нет - выдаем ссылку на главную станицу админки
        if (empty($this->count_infoblocks))
        {
            $items['items'][0] = Array(
                'name' => 'Блоки отсутствуют',
                'url' => '/admin',
            );
        }

        // Проходимся по всем инфоблокам и ставим ссылки на них в меню
        for ($i = 0; $i < $this->count_infoblocks; $i++)
        {
            $items['items'][$i] = Array(
                'name' => $infoblocks[$i]->name,
                'url' => '/admin/infoblock/edit/' . $infoblocks[$i]->id,
                'id' => $infoblocks[$i]->id,
            );
        }

        return $items;
    }

}