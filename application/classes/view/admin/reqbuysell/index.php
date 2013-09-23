<?php

/*
  Вид для контроллера reqbuysell, действия index
 */
class View_Admin_Reqbuysell_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Запросы на покупку/продажу';
    public $menu_head = 'Запросы на покупку/продажу';
    public $reqbuysells;
    public $reqbuysell_count;

    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'delete': $this->message_data = $this->delete_reqbuysell($_POST['work_id']);
                    break;
                case 'settings': $this->message_data = $this->update_settings($_POST);
            }
        }
        unset($_POST);

        // Выбираем все сообщения
        $reqbuysellsO = Sprig::factory('reqbuysell')->load(DB::select('*')->order_by('time', 'DESC'), NULL);
        // Регистрируем количество
        $this->reqbuysell_count = count($reqbuysellsO);

        // Проходимся по всем сообщениям
        for ($i = 0; $i < $this->reqbuysell_count; $i++)
        {
            $this->reqbuysells[$i] = $reqbuysellsO[$i]->as_array();
            // Добавляем человеческую дату добавления
            $this->reqbuysells[$i]['human_date'] = date('d.m.Y H:i', $this->reqbuysells[$i]['time']);
            $this->reqbuysells[$i]['object_data'] = nl2br($this->reqbuysells[$i]['object_data']);
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
            'url' => '/admin/reqbuysell/',
            'active_root' => $my,
        );
        $items['items'][1] = Array(
            'name' => 'Настройки',
            'url' => '/admin/reqbuysell/settings',
        );

        return $items;
    }
    
    /*
     * Функция удаления записи
     */
    protected function delete_reqbuysell($banner_id)
    {
        // Загружаем данные о баннера
        $reqbuysell = Sprig::factory('reqbuysell', array('id' => $banner_id))->load();
        // Удаляем запись в БД
        $reqbuysell->delete();

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