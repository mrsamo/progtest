<?php

/*
  Вид для контроллера Content, действия Open
  Наследуем от класса для действия Index
 */
class View_Admin_Content_Open extends View_Admin_Content_Index
{

    public $title = 'Администрирование :: Работа с текстовыми страницами';
    public $cur_page;
    public $parent;
    public $childrens = Array();
    public $childrens_arr = Array();
    public $children_count = 0;
    public $childrens_root = false;
    public $lvl1 = false;
    public $lvl2 = false;
    public $message_data = Array();
    public $editable = false;
    public $domen;

    /*     * *
      В конструкторе сразу определяем требуемые показатели:
      категорию-родитель, категории-дети
     * * */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Создаем объект текущей категории
        $this->cur_page = Sprig::factory('content', array('id' => $this->id))->load();
        
        $this->domen = $_SERVER['HTTP_HOST'];

        // Если был сабмит админ.формы - узнаем действие и вызываем нужный метод
        if (!empty($_POST['action']) && !empty($_POST['ord']))
        {
            switch ($_POST['action'])
            {
                case 'status': $this->message_data = $this->update_status($_POST['work_id'], $_POST['status'][$_POST['work_id']]);
                    break;
                case 'order': $this->message_data = $this->update_ord($_POST['ord']);
                    break;
                case 'delete': $this->message_data = $this->delete_page($_POST['work_id']);
                    break;
                case 'create': $this->message_data = $this->create_page($_POST);
            }
        }
        unset($_POST);

        // Получение раздела-родителя
        $this->parent = $this->cur_page->parent;

        // Получение разделов-детей
        $this->childrens = $this->cur_page->children->as_array();
        // Получаем количество детей
        $this->children_count = count($this->childrens);

        // Проходимся по всем детям
        for ($i = 0; $i < $this->children_count; $i++)
        {
            $this->childrens_arr[$i] = $this->childrens[$i]->as_array();
            // Если к странице привязан модуль
            if (!empty($this->childrens_arr[$i]['module_id']))
            {
                // Находим нужный модуль
                $module = Sprig::factory('module', array('mid' => $this->childrens_arr[$i]['module_id']))->load();
                if ($module->loaded())
                    $this->childrens_arr[$i]['module'] = $module->name;
            }
            
            // У главной страницы убираем возможность создания подразделов
            if ($this->childrens_arr[$i]['url'] == 'index')
            {
                $this->childrens_arr[$i]['is_index'] = TRUE;
            }
        }

        // Сортируем массив дочерних категорий
        usort($this->childrens_arr, Array('View_Layout', 'sort_func_ord_arr'));

        // Если текущая категория не равна корневой - получаем детей корневой директории
        if ($this->cur_page->id != $this->root->id)
        {
            $this->childrens_root = $this->root->children->as_array();
            // Сортируем массив дочерних категорий
            usort($this->childrens_root, Array('View_Layout', 'sort_func_ord'));
        }

        // Регистрируем переменные для шаблонов, определяющие уровень категории
        if ($this->parent->id == $this->root->id)
            $this->lvl1 = true;
        elseif (!empty($this->parent->id))
            $this->lvl2 = true;
    }

    /*     * *
      Hook Menu
      Метод срабатывает для текущего раздела и перегружает метод
      выдачи меню для других модулей (где выводится только корневой раздел)
      Оставляем родительский метод (он выводит корневую категорию) и добавляем к нему подкатегории
     * * */
    public function menu_items()
    {
        // Получаем массив с корневой директорией
        $items = parent::menu_items();

        // Выделяем жирным корневую директорию - если активна она
        if ($this->cur_page->id == $this->root->id)
            $items['items'][0]['active_root'] = true;

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
            $items['items'][0]['open_root'] = true;

            // Создаем пункт меню
            $items['items'][0]['sub_items'][$i]['name'] = $childrens[$i]->name;
            $items['items'][0]['sub_items'][$i]['url'] = '/admin/content/open/' . $childrens[$i]->id;
            $items['items'][0]['sub_items'][$i]['hav_sub_items2'] = $this->get_have_childrens($childrens[$i]->id);

            // Выделяем активный элемент
            if ($this->cur_page->id == $childrens[$i]->id)
                $items['items'][0]['sub_items'][$i]['active'] = true;

            // Если выбрана текущая категория первого уровня или
            // подпункт текущей категории - регистрируем подкатегории
            if ($this->cur_page->id == $childrens[$i]->id || $this->parent->id == $childrens[$i]->id)
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
                    $items['items'][0]['sub_items'][$i]['open'] = true;

                    // Если открыта последняя категория первого уровня
                    // то для ее подкатегорий надо установить класс last - иначе остается линия левая
                    if ($i == count($childrens) - 1)
                        $items['items'][0]['sub_items'][$i]['sub_items2'][$r]['last'] = true;

                    // Создаем пункт меню
                    $items['items'][0]['sub_items'][$i]['sub_items2'][$r]['name'] = $childrens_parent[$r]->name;
                    $items['items'][0]['sub_items'][$i]['sub_items2'][$r]['url'] = '/admin/content/edit/' . $childrens_parent[$r]->id;

                    // Выделяем активный элемент
                    if ($this->cur_page->id == $childrens_parent[$r]->id)
                        $items['items'][0]['sub_items'][$i]['sub_items2'][$r]['active2'] = true;
                }
            }
        }

        return $items;
    }

    /*     * *
      Функция обновления статуса у страницы
     * * */
    private function update_status($id, $status)
    {
        // Загружаем данные о странице
        $page = Sprig::factory('content', array('id' => $id))->load();
        $page->status = $status;
        $page->update();

        return Array('text' => 'Статус обновлен', 'error' => 0);
    }

    /*     * *
      Функция удаления страницы
     * * */
    private function delete_page($id)
    {
        // Загружаем данные о странице
        $page = Sprig::factory('content', array('id' => $id))->load();
        // Получаем дочерние категории
        $this->childrens = $page->children->as_array();
        // Если дети есть - выдаем сообщение, что удалить непустую категорию нельзя
        if (count($this->childrens) > 0)
            return Array('text' => 'Удалить можно только пустую категорию', 'error' => 1);
        $page->delete();

        return Array('text' => 'Страница удалена', 'error' => 0);
    }

    /*     * *
      Функция обновления порядка страниц
      На входе массив формата [page_id] => ord
     * * */
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
                $page = Sprig::factory('content', array('id' => $key))->load();
                $page->ord = $value;
                $page->update();
            }
        }

        return Array('text' => 'Порядок сохранен', 'error' => 0);
    }

    /*     * *
      Функция создания новой страницы
      На входе массив POST
     * * */
    private function create_page(Array $post_arr)
    {
        // Проверяем на сервере обязательные поля
        if (!empty($post_arr['name']) && !empty($post_arr['url']) && !empty($post_arr['ord']))
        {
            // Вставляем страницу как последнего ребенка в родительскую категорию
            $page = Sprig::factory('content');
            $page->values($post_arr);
            $page->insert_as_last_child($this->cur_page);

            // После добавления страницы необходимо перезагрузить ткущую категорию
            // Чтобы обновить список детей
            $this->cur_page = Sprig::factory('content', array('id' => $this->id))->load();

            return Array('text' => 'Страница создана', 'error' => 0);
        }
        // Если ен все поля заполнены - выводим сообщение
        else
            return Array('text' => 'Заполните обязательные поля', 'error' => 1);
    }

}