<?php

/*
  Вид для контроллера callback, действия index
 */
class View_Admin_Callback_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Запросы обратного звонка';
    public $menu_head = 'Обратные звонки';
    public $callbacks;
    public $callback_count;

    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'delete': $this->message_data = $this->delete_callback($_POST['work_id']);
                    break;
                case 'settings': $this->message_data = $this->update_settings($_POST);
            }
        }
        unset($_POST);

        // Выбираем все сообщения
        $callbacksO = Sprig::factory('callback')->load(DB::select('*')->order_by('time', 'DESC'), NULL);
        // Регистрируем количество
        $this->callback_count = count($callbacksO);

        // Проходимся по всем сообщениям
        for ($i = 0; $i < $this->callback_count; $i++)
        {
            $this->callbacks[$i] = $callbacksO[$i]->as_array();
            // Добавляем человеческую дату добавления
            $this->callbacks[$i]['human_date'] = date('d.m.Y H:i', $this->callbacks[$i]['time']);
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
            'url' => '/admin/callback/',
            'active_root' => $my,
        );
        $items['items'][1] = Array(
            'name' => 'Настройки',
            'url' => '/admin/callback/settings',
        );

        return $items;
    }
    
    /*
     * Функция удаления записи
     */
    protected function delete_callback($banner_id)
    {
        // Загружаем данные о баннера
        $callback = Sprig::factory('callback', array('id' => $banner_id))->load();
        // Удаляем запись в БД
        $callback->delete();

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