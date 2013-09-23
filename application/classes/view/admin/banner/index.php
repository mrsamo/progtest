<?php

/*
 * Вид для контроллера Banner, действия index
 */
class View_Admin_Banner_Index extends View_Admin_Layout
{

    public $title = 'Администрирование :: Баннеры';
    public $menu_head = 'Баннеры';
    public $banner_dir = 'images/banners/';
    public $banners_max_count = 6;
    public $banners = Array();
    public $banners_count = 0;
    // Размеры для ресайза
    protected $resize_main = array(271, NULL);

    /*
     * Обновляем конструктор
     * В конструкторе сразу загружаем список всех баннеров
     * и регистрируем количество баненров для шаблона первой страницы
     */
    public function __construct($template = NULL, array $partials = NULL, $alien_call = FALSE)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотку WideImage
        require_once('packages/wideimage/WideImage.php');

        // Выбираем все баннеры
        $bannersO = Sprig::factory('banner')->load(DB::select('*'), NULL);
        // Регистрируем количество
        $this->banners_count = count($bannersO);

        // Если баннеров больше заданного значения - закрываем возможность добавления\
        if ($this->banners_count >= $this->banners_max_count)
            $this->add_opport = FALSE;
        else
            $this->add_opport = TRUE;

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']))
        {
            switch ($_POST['action'])
            {
                case 'delete': $this->message_data = $this->delete_banner($_POST['work_id']);
                    break;
                case 'create': $this->message_data = $this->create_banner($_POST, $_FILES);
                    break;
                case 'update': $this->message_data = $this->update_banner($_POST, $_FILES);
            }
            unset($_POST['action']);
        }        

        // Не грузим лишнее
        if (!empty($alien_call))
            return;

        // Выбираем все баннеры
        $bannersO = Sprig::factory('banner')->load(DB::select('*'), NULL);
        // Регистрируем количество
        $this->banners_count = count($bannersO);
        // Проходимся по всем новостям
        for ($i = 0; $i < $this->banners_count; $i++)
        {
            $this->banners[$i] = $bannersO[$i]->as_array();
            // Добавляем человеческое описание
            // типа и содержимого баннера
            switch ($this->banners[$i]['type'])
            {
                case 'image':
                    $this->banners[$i]['type_word'] = 'Изображение';
                    $this->banners[$i]['source'] = '<img src="/' . $this->banner_dir . $this->banners[$i]['source'] . '" border="0" alt="Баннер">';
                    break;
                case 'flash':
                    $this->banners[$i]['type_word'] = 'Flash';
                    $this->banners[$i]['source'] = '<object type="application/x-shockwave-flash" data="/' . $this->banner_dir . $this->banners[$i]['source'] . '" height="' . $this->banners[$i]['height'] . '" width="' . $this->banners[$i]['width'] . '"><param name="movie" value="/' . $this->banner_dir . $this->banners[$i]['source'] . '"><param name="wmode" value="transparent"></object>';
                    break;
                case 'text':
                    $this->banners[$i]['type_word'] = 'Текст';
                    $this->banners[$i]['source'] = $this->banners[$i]['source'];
            }
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
            'name' => 'Баннеры',
            'url' => '/admin/banner',
            'active_root' => $my
        );

        return $items;
    }

    /*
     * Функция сабмита формы создания баннера
     * На входе массив POST и FILES
     */
    protected function create_banner(Array $post_arr, Array $files_arr)
    {
        // Проверяем - не дошли ли мы до лимита баннеров
        if (!empty($this->add_opport))
        {
            // В зависимости от типа баннера
            // Проверяем заполненность нужных полей
            switch ($post_arr['type'])
            {
                case 'image':
                    if (!empty($files_arr['image']['tmp_name']))
                    {
                        // Добавляем баннер
                        $banner = Sprig::factory('banner');
                        $banner->values($post_arr)->create();

                        // Добавляем картинку
                        $banner->source = $this->upload_image($files_arr['image']['name'], $files_arr['image']['tmp_name'], $banner->id);
                        $banner->update();

                        return Array('text' => 'Баннер добавлен', 'error' => 0);
                    }
                    else
                    {
                        return Array('text' => 'Заполните обязательные поля', 'error' => 1);
                    }
                    break;
                case 'flash':
                    if (!empty($post_arr['height']) and !empty($post_arr['width']) and !empty($files_arr['flash']['tmp_name']))
                    {
                        // Добавляем баннер
                        $banner = Sprig::factory('banner');
                        $banner->values($post_arr)->create();

                        // Добавляем flash
                        $banner->source = $this->upload_file($files_arr['flash']['name'], $files_arr['flash']['tmp_name'], $banner->id);
                        $banner->update();

                        return Array('text' => 'Баннер добавлен', 'error' => 0);
                    }
                    else
                    {
                        return Array('text' => 'Заполните обязательные поля', 'error' => 1);
                    }
                    break;
                case 'text':
                    if (!empty($post_arr['source']))
                    {
                        // Добавляем баннер
                        $banner = Sprig::factory('banner');
                        $banner->values($post_arr)->create();

                        return Array('text' => 'Баннер добавлен', 'error' => 0);
                    }
                    else
                    {
                        return Array('text' => 'Заполните обязательные поля', 'error' => 1);
                    }
                    break;
            }
        }
        else
        {
            return Array('text' => 'Вы уже добавили максимальное количество баннеров', 'error' => 1);
        }
    }

    /*     * *
      Функция сабмита формы обновления баннера
      На входе массив POST и FILES и ID новости
     * * */
    protected function update_banner(Array $post_arr, Array $files_arr)
    {
        $this->cur_banner = Sprig::factory('banner', array('id' => $post_arr['id']))->load();

        // В зависимости от типа баннера
        // Проверяем заполненность нужных полей
        switch ($post_arr['type'])
        {
            case 'image':
                $this->cur_banner->values($post_arr);
                // Если загружено новое изображение
                if (!empty($files_arr['image']['tmp_name']))
                {
                    // Удаляем старую картинку
                    $this->delete_banner_file($post_arr['id']);
                    // Добавляем картинку
                    $this->cur_banner->source = $this->upload_image($files_arr['image']['name'], $files_arr['image']['tmp_name'], $post_arr['id']);
                }
                $this->cur_banner->update();

                return Array('text' => 'Баннер обновлен', 'error' => 0);
                break;
            case 'flash':
                if (!empty($post_arr['height']) and !empty($post_arr['width']))
                {
                    $this->cur_banner->values($post_arr);
                    // Если загружено новое изображение
                    if (!empty($files_arr['flash']['tmp_name']))
                    {
                        // Удаляем старую картинку
                        $this->delete_banner_file($post_arr['id']);
                        // Добавляем картинку
                        $this->cur_banner->source = $this->upload_file($files_arr['flash']['name'], $files_arr['flash']['tmp_name'], $post_arr['id']);
                    }
                    $this->cur_banner->update();

                    return Array('text' => 'Баннер обновлен', 'error' => 0);
                }
                else
                {
                    return Array('text' => 'Заполните обязательные поля', 'error' => 1);
                }
                break;
            case 'text':
                if (!empty($post_arr['source']))
                {
                    $this->cur_banner->values($post_arr)->update();

                    return Array('text' => 'Баннер обновлен', 'error' => 0);
                }
                else
                {
                    return Array('text' => 'Заполните обязательные поля', 'error' => 1);
                }
                break;
        }

        // Проверяем заполненность нужных полей
        if (!empty($post_arr['link']))
        {
            $this->cur_banner->values($post_arr);
            // Если загружено новое изображение
            if (!empty($files_arr['image']['tmp_name']))
            {
                // Удаляем старую картинку
                $this->delete_banner_file($post_arr['id']);
                // Добавляем картинку
                $this->cur_banner->source = $this->upload_file($files_arr['image']['name'], $files_arr['image']['tmp_name'], $post_arr['id']);
            }
            $this->cur_banner->update();

            return Array('text' => 'Баннер обновлен', 'error' => 0);
        }
        else
        {
            return Array('text' => 'Заполните обязательные поля', 'error' => 1);
        }
    }

    /*
     * Функция удаления баннера
     */
    protected function delete_banner($banner_id)
    {
        // Загружаем данные о баннера
        $banner = Sprig::factory('banner', array('id' => $banner_id))->load();
        // Удаляем картинку
        $this->delete_banner_file($banner_id);
        // Удаляем запись в БД
        $banner->delete();

        return Array('text' => 'Баннер удален', 'error' => 0);
    }

    /*
     * Функция удаления файла баннера
     */
    protected function delete_banner_file($banner_id)
    {
        // Загружаем данные о новости
        $banner = Sprig::factory('banner', array('id' => $banner_id))->load();
        $banner_path = $this->banner_dir . $banner->source;
        if (file_exists($banner_path))
            unlink($banner_path);
    }

    /*
     * Функция загрузки изображения
     */
    protected function upload_image($name, $tmp_name, $banner_id)
    {
        // Создаем объект библиотеки WideImage
        $image = WideImage::load($tmp_name);
        // Определяем расширение
        $image_ext = preg_replace('!^.*\.(.+)$!', '\\1', $name);
        // Создаем из оригинала две картинки с ресайзом
        if (!empty($this->resize_main[0]) or !empty($this->resize_main[1]))
        {
            $image_orig = $image->resize($this->resize_main[0], $this->resize_main[1], 'inside', 'down');
            $image_orig->saveToFile($this->banner_dir . $banner_id . '.' . $image_ext);
        }

        // Возвращаем название картинки
        return ($banner_id . '.' . $image_ext);
    }

    /*
     * Функция загрузки файла на сервер
     */
    protected function upload_file($name, $tmp_name, $id)
    {
        // Определяем расширение
        $image_ext = preg_replace('!^.*\.(.+)$!', '\\1', $name);
        // Копируем в директорию баннеров
        $file_dest = $this->banner_dir . $id . '.' . $image_ext;
        copy($tmp_name, $file_dest);

        return ($id . '.' . $image_ext);
    }

}