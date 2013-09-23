<?php

/*
  Вид для контроллера reqbuy, действия index
 */
class View_Admin_Reqbuy_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Запросы на покупку';
    public $menu_head = 'Запросы на покупку';
    public $reqbuys;
    public $reqbuy_count;

    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'delete': $this->message_data = $this->delete_reqbuy($_POST['work_id']);
                    break;
                case 'settings': $this->message_data = $this->update_settings($_POST);
            }
        }
        unset($_POST);

        // Выбираем все сообщения
        $reqbuysO = Sprig::factory('reqbuy')->load(DB::select('*')->order_by('time', 'DESC'), NULL);
        // Регистрируем количество
        $this->reqbuy_count = count($reqbuysO);

        // Проходимся по всем сообщениям
        for ($i = 0; $i < $this->reqbuy_count; $i++)
        {
            $this->reqbuys[$i] = $reqbuysO[$i]->as_array();
            // Добавляем человеческую дату добавления
            $this->reqbuys[$i]['human_date'] = date('d.m.Y H:i', $this->reqbuys[$i]['time']);
            $this->reqbuys[$i]['object_data'] = nl2br($this->reqbuys[$i]['object_data']);
        }
    }

    /*
     * Hook Menu
     * Метод срабатывает только для других модулей при построении меню
     * В данном случае, меню модуля не меняется и добавляется только выделение
     * для текущего раздела
     */
    public function menu_items($my = true)
    {
        $items = Array('name' => $this->menu_head);

        $items['items'][0] = Array(
            'name' => 'Запросы',
            'url' => '/admin/reqbuy/',
            'active_root' => $my,
        );
        $items['items'][1] = Array(
            'name' => 'Настройки',
            'url' => '/admin/reqbuy/settings',
        );

        return $items;
    }
    
    /*
     * Функция удаления записи
     */
    protected function delete_reqbuy($banner_id)
    {
        // Загружаем данные о баннера
        $reqbuy = Sprig::factory('reqbuy', array('id' => $banner_id))->load();
        // Удаляем запись в БД
        $reqbuy->delete();

        return Array('text' => 'Запись удалена', 'error' => 0);
    }
    
    /*
     * Функция сабмита формы обновления настроек
     * На входе массив POST
     */
    protected function update_settings(Array $post_arr)
    {
        // Проходим по всему массиву данных
        foreach ($post_arr as $key => $value)
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