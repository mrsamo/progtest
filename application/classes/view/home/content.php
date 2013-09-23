<?php

/*
  Вид для контроллера home, действия content
 */
class View_Home_Content extends View_Layout
{

    public $is_content = TRUE;
    public $cur_content;
    public $sub_menu;
    public $sub_menu_yes;
    private $content_id;
    private $parent_id;
    private $root_id;
    private $include_unknow_module = 'Модуль %s не найден в системе';

    public function __construct()
    {
        // Родительский конструктор
        parent::__construct();

        $sub_menu_arr = Array();

        // Выбираем текущую секцию из базы
        $this->cur_content = Sprig::factory('content', Array('url' => $this->page))->load();
        // Выкидываем 404 ошибку
        if (empty($this->cur_content->id))
            throw new HTTP_Exception_404('Раздел отсутствует');

        // Определяем ID текущей категории, родительской и корневой
        $this->cur_content_id = $this->cur_content->id;
        $this->parent_id = $this->cur_content->parent->id;
        $this->root_id = Sprig::factory('content')->root(1)->id;

        // Формируем тайтлы и мета-тэги
        $this->title = $this->cur_content->meta_title;
        $this->description = $this->cur_content->meta_description;
        $this->keywords = $this->cur_content->meta_keywords;

        // Хлебные крошки
        $path = $this->select_path($this->cur_content_id);
        // Регистрируем хлебные крошки
        $this->breadcrumbs = $this->prepare_table($path, 1);

        // Находим в содержимом страницы вызовы других модулей
        if (preg_match_all('!\[include module:([^:]+)(?:::(.+))?\]!i', $this->cur_content->content, $modules_include_arr))
        {
            // Метка, что на странице будет форма подачи заявки
            $this->is_service = TRUE;
            // Проходим по всем найденным подключенным модулям
            for ($i = 0; $i < count($modules_include_arr[1]); $i++)
            {
                // Создаем объект модуля
                $module = Sprig::factory('module', Array('name' => $modules_include_arr[1][$i]))->load();
                if ($module->loaded())
                {
                    // Костыль. Узнаем раздел с формой обратной связи
                    if ($module->mid == 5)
                        $this->is_feedback = TRUE;
                    // Формируем имя представления, генерируем вывод и вставляем на страницу
                    $view_name = 'View_' . $modules_include_arr[1][$i] . '_' . ((!empty($modules_include_arr[2][$i])) ? $modules_include_arr[2][$i] : 'index');
                    $view = new $view_name();
                    $this->cur_content->content = str_replace($modules_include_arr[0][$i], $view->render(), $this->cur_content->content);
                }
                else
                {
                    $this->cur_content->content = str_replace($modules_include_arr[0][$i], sprintf($this->include_unknow_module, $modules_include_arr[1][$i]), $this->cur_content->content);
                }
            }
        }

        // Регистрируем крошки
        $path[0]['title'] = $this->cur_content->name;
        $path[0]['url'] = '/content/' . $this->cur_content->url;
        // Для второго уровня вложенности показываем крошки
        if ($this->cur_content->lvl > 1)
        {
            $path[0]['title'] = $this->cur_content->parent->name;
            $path[0]['url'] = '/content/' . $this->cur_content->parent->url;
            $path[1]['title'] = $this->cur_content->name;
        }
        $this->breadcrumbs = $this->prepare_table($path, 1);
    }

    public function select_path(& $curent_id)
    {
        $path = Array();
        $continue = true;
        $i = 0;

        while ($continue)
        {
            $current = Sprig::factory('content', Array('id' => $curent_id))->load();
            $path[$i]['title'] = $current->name;
            $path[$i++]['url'] = '/content/' . $current->url;

            // Если родитель = основная категория Разделы, останавливаемся
            if ($current->parent->id == $this->root_id)
                $continue = false;

            $curent_id = $current->parent->id;
        }
        $path = array_reverse($path);

        return $path;
    }

}