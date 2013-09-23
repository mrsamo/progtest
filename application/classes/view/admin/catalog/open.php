<?php

/*
 * Вид для контроллера Catalog, действия Open
 * Наследуем от класса для действия Index
 */
class View_Admin_Catalog_Open extends View_Admin_Catalog_Index
{

    public $title = 'Администрирование :: Каталог :: %s';
    public $cur_category;
    public $parent;
    public $grand_parent;
    public $childrens = Array();
    public $childrens_arr = Array();
    public $children_count = 0;
    public $childrens_root = FALSE;
    public $lvl0 = FALSE;
    public $lvl1 = FALSE;
    public $lvl2 = FALSE;
    public $message_data = Array();
    // Директории для изображений
    public $orig_images_dir = 'catalog_files/images/orig/';
    public $cat_images_dir = 'catalog_files/images/cat/';
    public $cart_images_dir = 'catalog_files/images/cart/';
    // Размеры для ресайза
    protected $crop_cat = array(263, 238);
    protected $resize_cart = array(353, NULL);
    // Метка категорий
    public $is_country = FALSE;
    public $is_city = FALSE;
    public $is_commercial = FALSE;
    public $is_business = FALSE;
    // Метка о добавлении/редактировании категории
    public $is_category = FALSE;
    // Метка о добавлении/редактировании объекта
    public $is_object = FALSE;
    // Зависимости типа недвижимости от scope
    public $scope_types_arr = array(
        1 => 'is_country',
        2 => 'is_city',
        3 => 'is_commercial',
        4 => 'is_business',
    );

    /*
     * В конструкторе сразу определяем требуемые показатели:
     * категорию-родитель, категории-дети
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотку WideImage
        require_once('packages/wideimage/WideImage.php');

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']) and !empty($_POST['ord']))
        {
            switch ($_POST['action'])
            {
                case 'status': $this->message_data = $this->update_status($_POST['work_id'], $_POST['status'][$_POST['work_id']]);
                    break;
                case 'order': $this->message_data = $this->update_ord($_POST['ord']);
                    break;
                case 'delete': $this->message_data = $this->delete($_POST['work_id']);
                    break;
                case 'create_category': $this->message_data = $this->create_category($_POST);
                    break;
                case 'update_category': $this->message_data = $this->update_category($_POST);
                    break;
                case 'create_object':
                case 'update_object': $this->message_data = $this->create_object($_POST, $_FILES);
            }
        }
        unset($_POST);

        // Создаем объект текущей категории
        $this->cur_category = Sprig::factory('catalog', array('id' => $this->id))->load();

        // Создаем метку о текущем типе недвижимости
        if (!empty($this->scope_types_arr[$this->cur_category->scope]))
            $this->{$this->scope_types_arr[$this->cur_category->scope]} = TRUE;

        // Получаем всех родителей категории
        $parents = $this->cur_category->parents;
        // Если мы находимся в создании или редактировании категории
        // Для корректого определения УВ, в качестве текущей
        // категории используем родительскую
        $count_perants = count($parents);
        $lvl_var = 'lvl' . $count_perants;
        $this->$lvl_var = TRUE;

        // Узнаем, что мы добавляем в текущей категории - объекты или категории
        if (!empty($this->is_business))
        {
            $this->is_object = TRUE;
        }
        else
        {
            if (!empty($this->lvl1))
                $this->is_object = TRUE;
            else
                $this->is_category = TRUE;
        }

        if (!$parents[0])
            $this->root = $this->cur_category;
        else
            $this->root = Sprig::factory('catalog', array('id' => $parents[0]->id))->load();

        $this->title = sprintf($this->title, $this->root->name);

        // Получение родителя и прародителя
        $this->parent = $this->cur_category->parent;
        $this->grand_parent = $this->parent->parent;
        // Получение разделов-детей
        $this->childrens = $this->cur_category->children();
        // Получаем количество детей
        $this->children_count = count($this->childrens);

        // Проходимся по всем детям
        for ($i = 0; $i < $this->children_count; $i++)
        {
            $this->childrens_arr[$i] = $this->childrens[$i]->as_array();
        }

        // Сортируем массив дочерних категорий
        usort($this->childrens_arr, Array('View_Layout', 'sort_func_ord_arr'));

        // Если текущая категория не равна корневой - получаем детей корневой директории
        if ($this->cur_category->id != $this->root->id)
        {
            $this->childrens_root = $this->root->children->as_array();
            // Сортируем массив дочерних категорий
            usort($this->childrens_root, Array('View_Layout', 'sort_func_ord'));
        }
    }

    /*
     * Hook Menu
     * Метод срабатывает для текущего раздела и перегружает метод
     * выдачи меню для других модулей (где выводится только корневой раздел)
     * Оставляем родительский метод (он выводит корневую категорию) и добавляем к нему подкатегории
     */
    public function menu_items()
    {
        // Получаем массив с корневой директорией
        $items = parent::menu_items();

        // Выделяем жирным корневую директорию - если активна она
        if ($this->cur_category->id == $this->root->id)
            $items['items'][$this->root->scope - 1]['active_root'] = true;

        // В зависимости от уровня текущей категории - берем нужных детей
        // Если выбра подпункт меню, то в качестве детей берем детей корновой категории
        if (empty($this->childrens_root))
            $childrens = & $this->childrens;
        else
            $childrens = & $this->childrens_root;

        // Добавляем категории первого уровня
        for ($i = 0; $i < count($childrens); $i++)
        {
            // Делаем маркер корневой категории открытым
            $items['items'][$this->root->scope - 1]['open_root'] = true;

            // Создаем пункт меню
            $items['items'][$this->root->scope - 1]['sub_items'][$i]['name'] = $childrens[$i]->name;
            $items['items'][$this->root->scope - 1]['sub_items'][$i]['url'] = '/admin/catalog/' . ((!empty($this->is_category)) ? 'open' : 'edit') . '/' . $childrens[$i]->id;
            $items['items'][$this->root->scope - 1]['sub_items'][$i]['hav_sub_items2'] = $this->get_have_childrens($childrens[$i]->id);

            // Выделяем активный элемент
            if ($this->cur_category->id == $childrens[$i]->id)
                $items['items'][$this->root->scope - 1]['sub_items'][$i]['active'] = true;

            // Если выбрана текущая категория первого уровня или
            // подпункт текущей категории - регистрируем подкатегории
            if ($this->cur_category->id == $childrens[$i]->id or $this->parent->id == $childrens[$i]->id)
            {
                // Если это подпункт категории - то берем детей	его родителя
                if ($this->parent->id == $childrens[$i]->id)
                {
                    $childrens_parent = $this->parent->children->as_array();
                    // Сортируем массив детей родителя
                    usort($childrens_parent, Array('View_Layout', 'sort_func_ord'));
                }
                else
                    $childrens_parent = & $this->childrens;

                // Проходим по всем детям текущей категории
                for ($r = 0; $r < count($childrens_parent); $r++)
                {
                    // Делаем маркер категории первого уровня открытым
                    $items['items'][$this->root->scope - 1]['sub_items'][$i]['open'] = true;

                    // Если открыта последняя категория первого уровня
                    // то для ее подкатегорий надо установить класс last - иначе остается линия левая
                    if ($i == count($childrens) - 1)
                        $items['items'][$this->root->scope - 1]['sub_items'][$i]['sub_items2'][$r]['last'] = true;

                    // Создаем пункт меню
                    $items['items'][$this->root->scope - 1]['sub_items'][$i]['sub_items2'][$r]['name'] = $childrens_parent[$r]->name;
                    $items['items'][$this->root->scope - 1]['sub_items'][$i]['sub_items2'][$r]['url'] = '/admin/catalog/edit/' . $childrens_parent[$r]->id;

                    // Выделяем активный элемент
                    if ($this->cur_category->id == $childrens_parent[$r]->id)
                        $items['items'][$this->root->scope - 1]['sub_items'][$i]['sub_items2'][$r]['active2'] = true;
                }
            }
        }

        return $items;
    }

    /*
     * Функция обновления статуса у категории/товара
     */
    private function update_status($id, $status)
    {
        // Загружаем данные о странице
        $category = Sprig::factory('catalog', array('id' => $id))->load();
        $category->status = $status;
        $category->update();

        return Array('text' => 'Статус обновлен', 'error' => 0);
    }

    /*
     * Функция обновления порядка категорий/товаров
     * На входе массив формата [category_id] => ord
     */
    private function update_ord(Array $ord_arr)
    {
        // Проходим по всем страницам, у которых обновляем статус
        foreach ($ord_arr as $key => $value)
        {
            // Еще раз производим срез всех символов, кроме цифр
            $value = preg_replace('![^0-9]!', '', $value);
            if (!empty($value))
            {
                // Загружаем данные о странице
                $category = Sprig::factory('catalog', array('id' => $key))->load();
                $category->ord = $value;
                $category->update();
            }
        }

        return Array('text' => 'Порядок сохранен', 'error' => 0);
    }

    /*
     * Создание категории
     * На входе массив POST
     */
    public function create_category(array $post_arr)
    {
        // Проверяем на сервере обязательные поля
        if (!empty($post_arr['name']) and !empty($post_arr['ord']))
        {
            // Загружаем данные о странице
            $category = Sprig::factory('catalog');
            $category->values($post_arr);
            $category->insert_as_last_child($this->id);

            return Array('text' => 'Категория создана', 'error' => 0);
        }
        // Если не все поля заполнены - выводим сообщение
        else
        {
            return Array('text' => 'Заполните обязательные поля', 'error' => 1);
        }
    }

    /*
     * Обновление категории
     * На входе массив POST
     */
    public function update_category(array $post_arr)
    {
        // Проверяем на сервере обязательные поля
        if (!empty($post_arr['name']) and !empty($post_arr['ord']))
        {
            // Загружаем данные о странице
            $category = Sprig::factory('catalog', array('id' => $post_arr['id']))->load();
            $category->values($post_arr);
            $category->update();

            return Array('text' => 'Категория обновлена', 'error' => 0);
        }
        // Если не все поля заполнены - выводим сообщение
        else
        {
            return Array('text' => 'Заполните обязательные поля', 'error' => 1);
        }
    }

    /*
     * Функция сабмита формы добавления/редактирования продукта
     * На входе массив POST, FILES
     */
    public function create_object(array $post_arr, array $files_arr)
    {
        // Проверяем на сервере обязательные поля
        if (!empty($post_arr['name']) and !empty($post_arr['ord']) and !empty($post_arr['price']) and !empty($post_arr['city']))
        {
            if (empty($post_arr['id']))
            {
                $object = Sprig::factory('catalog');
                $object->values($post_arr)->insert_as_last_child($this->id);
            }
            else
            {
                $object = Sprig::factory('catalog', array('id' => $post_arr['id']))->load();
                $object->values($post_arr);
            }            

            $object->hot_status = (!empty($post_arr['hot_status'])) ? 1 : NULL;
            $object->hypothec_status = (!empty($post_arr['hypothec_status'])) ? 1 : NULL;

            // Если нужно удаление изображения или загружается новое - удаляем старые картинки
            if (!empty($post_arr['del_image']) or !empty($files_arr['image']['tmp_name']))
            {
                $this->delete_image($post_arr['id']);
                $object->image = NULL;
            }

            // Если загружается новое изображение - загружаем
            if (!empty($files_arr['image']['tmp_name']))
            {
                // Создаем превьюшки
                $object->image = $this->upload_image($files_arr['image']['tmp_name'], $files_arr['image']['name'], $object->id);
            }

            $object->update();

            if (!empty($post_arr['id']))
                return Array('text' => 'Объект обновлен', 'error' => 0);
            else
                return Array('text' => 'Объект добавлен', 'error' => 0);
        }
        // Если ен все поля заполнены - выводим сообщение
        else
            return Array('text' => 'Заполните обязательные поля', 'error' => 1);
    }

    /*
     * Функция удаления объекта/категории с вложенными альбомами
     */
    private function delete($work_id)
    {
        // Загружаем данные о группе
        $catalog = Sprig::factory('catalog', array('id' => $work_id))->load();

        $parent = $catalog->parent();
        $parents = $catalog->parents;
        if (count($parents) == 1 and $parent->scope != 4)
        {
            $childrens = $catalog->children();
            for ($i = 0; $i < count($childrens); $i++)
            {
                // Удаляем картинки объекта
                delete_image($childrens[$i]->id);
                $childrens[$i]->delete();
            }

            // Удаляем категорию
            $catalog->delete();
            return Array('text' => 'Категория удалена', 'error' => 0);
        }
        else
        {
            // Удаляем объект
            $catalog->delete();
            return Array('text' => 'Объект удален', 'error' => 0);
        }
    }

    /*
     * Функция загрузки изображения новости
     */
    protected function upload_image($tmp_name, $name, $object_id)
    {
        // Создаем объект библиотеки WideImage
        $image = WideImage::load($tmp_name);
        // Определяем расширение
        $image_ext = preg_replace('!^.*\.(.+)$!', '\\1', $name);
        // Копируем оригинал
        copy($tmp_name, $this->orig_images_dir . $object_id . '.' . $image_ext);
        // Создаем из оригинала две картинки с ресайзом
        if (!empty($this->crop_cat[0]) or !empty($this->crop_cat[1]))
        {
            $image_resize = $image->resize($this->crop_cat[0], $this->crop_cat[1], 'outside');
            $image_crop = $image_resize->crop(0, 0, $this->crop_cat[0], $this->crop_cat[1]);
            $image_crop->saveToFile($this->cat_images_dir . $object_id . '.' . $image_ext);
        }
        if (!empty($this->resize_cart[0]) or !empty($this->resize_cart[1]))
        {
            $image_thumb = $image->resize($this->resize_cart[0], $this->resize_cart[1], 'inside', 'down');
            $image_thumb->saveToFile($this->cart_images_dir . $object_id . '.' . $image_ext);
        }

        // Возвращаем название картинки
        return ($object_id . '.' . $image_ext);
    }

    /*
     * Функция удаления картинок объекта
     */
    protected function delete_image($object_id)
    {
        // Создаем объект текущей новости
        $object = Sprig::factory('catalog', array('id' => $object_id))->load();
        if (!empty($object->image))
        {
            // Если файлы существуют - удаляем
            if (file_exists($this->orig_images_dir . $object->image))
                unlink($this->orig_images_dir . $object->image);
            if (file_exists($this->cat_images_dir . $object->image))
                unlink($this->cat_images_dir . $object->image);
            if (file_exists($this->cart_images_dir . $object->image))
                unlink($this->cart_images_dir . $object->image);
        }
    }

}