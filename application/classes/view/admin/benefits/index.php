<?php

/*
  Вид для контроллера benefits, действия index
 */
class View_Admin_Benefits_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Преимущества';
    public $benefits_count = 0;
    public $benefits = Array();
    public $menu_head = 'Преимущества';
    public $benefits_image_path = 'images/benefits/';
    // Размеры для ресайза
    protected $resize_main = array(150, NULL);

    /*     * *
      Обновляем конструктор
      В конструкторе сразу загружаем список всех преимуществ
      и регистрируем количество преимуществ для шаблона первой страницы
     * * */
    public function __construct($template = NULL, array $partials = NULL, $alien_call = false)
    {
        parent::__construct($template, $partials, $alien_call);

        // Если объект создается сторонним приложением для использования
        // определенных функций - конструктор надо освободить от выполнения
        // лишних операций
        if (!empty($alien_call))
            return;

        // Подключаем библиотку WideImage
        require_once('packages/wideimage/WideImage.php');

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'status': $this->message_data = $this->update_status($_POST['work_id'], $_POST['status'][$_POST['work_id']]);
                    break;
                case 'delete': $this->message_data = $this->delete_benefit($_POST['work_id']);
                    break;
                case 'create': $this->message_data = $this->create_benefit($_POST, $_FILES);
                    break;
                case 'update': $this->message_data = $this->update_benefit($_POST, $_FILES);
            }
        }
        unset($_POST['action']);

        // Выбираем все преимущества
        $this->benefits = Sprig::factory('benefits')->load(DB::select('*')->order_by('id', 'DESC'), NULL)->as_array();
        // Регистрируем количество
        $this->benefits_count = count($this->benefits);
    }

    /*     * *
      Hook Menu
      Метод срабатывает только для других модулей при построении меню
      В данном случае меню не меняет внешнего вида, добавляется только активность пункта
     * * */
    public function menu_items($my = true)
    {
        $items = Array('name' => $this->menu_head);
        $items['items'][0] = Array(
            'name' => $this->menu_head,
            'url' => '/admin/benefits',
            'active_root' => $my,
        );
        return $items;
    }

    /*     * *
      Функция обновления статуса у преимущества
     * * */
    private function update_status($id, $status)
    {
        // Загружаем данные о преимуществе
        $benefit = Sprig::factory('benefits', array('id' => $id))->load();
        $benefit->status = $status;
        $benefit->update();

        return Array('text' => 'Статус обновлен', 'error' => 0);
    }

    /*     * *
      Функция сабмита формы создания преимущества
      На входе массив POST
     * * */
    protected function create_benefit(array $post_arr, array $files_arr)
    {
        // Проверяем заполненность нужных полей
        if (!empty($files_arr['image']['tmp_name']) and !empty($post_arr['content']))
        {
            // Добавляем преимущество
            $benefit = Sprig::factory('benefits');
            $benefit->values($post_arr)->create();

            // Загружаем изображение
            $benefit->image = $this->upload_image($files_arr['image']['tmp_name'], $files_arr['image']['name'], $benefit->id);
            $benefit->update();

            return Array('text' => 'Преимущество добавлено', 'error' => 0);
        }
        else
        {
            return Array('text' => 'Заполните обязательные поля', 'error' => 1);
        }
    }

    /*     * *
      Функция сабмита формы редактирования преимущества
      На входе массив POST
     * * */
    protected function update_benefit(array $post_arr, array $files_arr)
    {
        // Проверяем заполненность нужных полей
        if (!empty($post_arr['content']))
        {
            // Загружаем данные о преимуществе
            $benefit = Sprig::factory('benefits', array('id' => $post_arr['id']))->load();

            // Привязываем POST данные
            $benefit->values($post_arr);
            
            // Если нужно удаление изображения или загружается новое - удаляем старые картинки
	    if (!empty($post_arr['del_image']) or !empty($files_arr['image']['tmp_name']))
	    {
		if (file_exists($this->benefits_image_path . $benefit->image))
                    unlink($this->benefits_image_path . $benefit->image);
		$benefit->image = '';
	    }

            // Если имеется картинка - удаляем старую и загружаем новую
            if (!empty($files_arr['image']['tmp_name']))
            {
                // Загружаем изображение
                $benefit->image = $this->upload_image($files_arr['image']['tmp_name'], $files_arr['image']['name'], $benefit->id);
            }

            // Обновляем
            $benefit->update();

            // После обновления преимущества - обновляем его данные
            $this->cur_benefit = $benefit->as_array();

            return Array('text' => 'Преимущество обновлено', 'error' => 0);
        }
        else
        {
            return Array('text' => 'Заполните обязательные поля', 'error' => 1);
        }
    }

    /*     * *
      Функция удаления преимущества
     * * */
    private function delete_benefit($id)
    {
        // Загружаем данные о преимуществе
        $benefit = Sprig::factory('benefits', array('id' => $id))->load();

        // Удаляем изображение
        if (file_exists($this->benefits_image_path . $benefit->image))
            unlink($this->benefits_image_path . $benefit->image);

        $benefit->delete();

        return Array('text' => 'Преимущество удалено', 'error' => 0);
    }

    /*
     * Функция загрузки изображения категории
     */
    protected function upload_image($tmp_name, $name, $benefit_id, $suffix = '')
    {
        // Создаем объект библиотеки WideImage
        $image = WideImage::load($tmp_name);
        // Определяем расширение
        $image_ext = preg_replace('!^.*\.(.+)$!', '\\1', $name);
        // Создаем из оригинала ресайз под дизайн
        $image_resize = $image->resize($this->resize_main[0], $this->resize_main[1], 'inside', 'down');
        $image_resize->saveToFile($this->benefits_image_path . $benefit_id . $suffix . '.' . $image_ext);

        // Возвращаем название картинки
        return ($benefit_id . $suffix . '.' . $image_ext);
    }

}