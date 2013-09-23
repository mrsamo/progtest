<?php

/*
  Вид для контроллера exchange, действия index
 */
class View_Admin_Exchange_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Запросы на обмен';
    public $menu_head = 'Запросы на обмен';
    public $exchanges;
    public $exchange_count;

    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'delete': $this->message_data = $this->delete_exchange($_POST['work_id']);
                    break;
                case 'settings': $this->message_data = $this->update_settings($_POST);
            }
        }
        unset($_POST);

        // Выбираем все сообщения
        $exchangesO = Sprig::factory('exchange')->load(DB::select('*')->order_by('time', 'DESC'), NULL);
        // Регистрируем количество
        $this->exchange_count = count($exchangesO);

        // Проходимся по всем сообщениям
        for ($i = 0; $i < $this->exchange_count; $i++)
        {
            $this->exchanges[$i] = $exchangesO[$i]->as_array();
            // Добавляем человеческую дату добавления
            $this->exchanges[$i]['human_date'] = date('d.m.Y H:i', $this->exchanges[$i]['time']);
            $this->exchanges[$i]['object_data_1'] = nl2br($this->exchanges[$i]['object_data_1']);
            $this->exchanges[$i]['object_data_2'] = nl2br($this->exchanges[$i]['object_data_2']);
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
            'url' => '/admin/exchange/',
            'active_root' => $my,
        );
        $items['items'][1] = Array(
            'name' => 'Настройки',
            'url' => '/admin/exchange/settings',
        );

        return $items;
    }
    
    /*
     * Функция удаления записи
     */
    protected function delete_exchange($banner_id)
    {
        // Загружаем данные о баннера
        $exchange = Sprig::factory('exchange', array('id' => $banner_id))->load();
        // Удаляем запись в БД
        $exchange->delete();

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