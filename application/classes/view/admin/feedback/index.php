<?php

/*
  Вид для контроллера feedback, действия index
 */
class View_Admin_Feedback_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Обратная связь';
    public $menu_head = 'Обратная связь';
    public $feedbacks;
    public $feedback_count;

    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'delete': $this->message_data = $this->delete_feedback($_POST['work_id']);
                    break;
                case 'settings': $this->message_data = $this->update_settings($_POST);
            }
        }
        unset($_POST);

        // Выбираем все сообщения
        $feedbacksO = Sprig::factory('feedback')->load(DB::select('*')->order_by('time', 'DESC'), NULL);
        // Регистрируем количество
        $this->feedback_count = count($feedbacksO);

        // Проходимся по всем сообщениям
        for ($i = 0; $i < $this->feedback_count; $i++)
        {
            $this->feedbacks[$i] = $feedbacksO[$i]->as_array();
            // Добавляем человеческую дату добавления
            $this->feedbacks[$i]['human_date'] = date('d.m.Y H:i', $this->feedbacks[$i]['time']);
            $this->feedbacks[$i]['message'] = nl2br($this->feedbacks[$i]['message']);
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
            'name' => 'Обращения посетителей',
            'url' => '/admin/feedback/',
            'active_root' => $my,
        );
        $items['items'][1] = Array(
            'name' => 'Настройки',
            'url' => '/admin/feedback/settings',
        );

        return $items;
    }
    
    /*
     * Функция удаления записи
     */
    protected function delete_feedback($banner_id)
    {
        // Загружаем данные о баннера
        $feedback = Sprig::factory('feedback', array('id' => $banner_id))->load();
        // Удаляем запись в БД
        $feedback->delete();

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