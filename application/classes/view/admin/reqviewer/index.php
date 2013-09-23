<?php

/*
  Вид для контроллера reqviewer, действия index
 */
class View_Admin_Reqviewer_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Запросы на осмотр';
    public $menu_head = 'Запросы на осмотр';
    public $reqviewers;
    public $reqviewer_count;

    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'delete': $this->message_data = $this->delete_reqviewer($_POST['work_id']);
                    break;
                case 'settings': $this->message_data = $this->update_settings($_POST);
            }
        }
        unset($_POST);

        // Выбираем все сообщения
        $reqviewersO = Sprig::factory('reqviewer')->load(DB::select('*')->order_by('time', 'DESC'), NULL);
        // Регистрируем количество
        $this->reqviewer_count = count($reqviewersO);

        // Проходимся по всем сообщениям
        for ($i = 0; $i < $this->reqviewer_count; $i++)
        {
            $this->reqviewers[$i] = $reqviewersO[$i]->as_array();
            // Добавляем человеческую дату добавления
            $this->reqviewers[$i]['human_date'] = date('d.m.Y H:i', $this->reqviewers[$i]['time']);
            $this->reqviewers[$i]['object_data'] = nl2br($this->reqviewers[$i]['object_data']);
            $view_date_arr = explode('-', $this->reqviewers[$i]['view_date']);
            $this->reqviewers[$i]['view_date'] = $view_date_arr[2] . '.' . $view_date_arr[1] . '.' . $view_date_arr[0];
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
            'url' => '/admin/reqviewer/',
            'active_root' => $my,
        );
        $items['items'][1] = Array(
            'name' => 'Настройки',
            'url' => '/admin/reqviewer/settings',
        );

        return $items;
    }
    
    /*
     * Функция удаления записи
     */
    protected function delete_reqviewer($banner_id)
    {
        // Загружаем данные о баннера
        $reqviewer = Sprig::factory('reqviewer', array('id' => $banner_id))->load();
        // Удаляем запись в БД
        $reqviewer->delete();

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