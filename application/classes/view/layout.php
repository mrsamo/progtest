<?php

/*
 * Родительский класс для всех видов Kohana
 * Здесь размещены свойства и методы, общие для всех видов
 */
class View_Layout extends Kohana_Kostache_Layout
{

    protected $_layout = 'layout';
    public $is_front = FALSE;
    // Метка закрытого раздела для неавторизованных пользователей в состоянии FALSE
    protected $auth_zone = FALSE;
    // Метка закрытого раздела для авторизованных пользователей в состоянии FALSE
    protected $no_auth_zone = FALSE;
    // Инфоблоки
    public $header_phone_block;
    public $footer_copyright_block;
    public $footer_address_block;
    public $footer_phone_block;
    public $footer_counters_block;
    public $year;
    // Баннеры
    public $banners_dir = 'images/banners/';
    // Преимущества
    public $benefits_dir = 'images/benefits/';
    // Метки для блока преимущества
    public $benefit = FALSE;
    // Каталог
    public $orig_images_dir = 'catalog_files/images/orig/';
    public $cat_images_dir = 'catalog_files/images/cat/';
    public $cart_images_dir = 'catalog_files/images/cart/';
    // Переменные для хранения пользователя и объекта авторизации
    public $auth;
    public $user;
    // Цепляем все составные части страницы
    protected $_partials = array(
        'header' => 'partials/header',
        'footer' => 'partials/footer',
        'top-menu' => 'partials/top-menu',
        'breadcrumb' => 'partials/breadcrumb',
        'form-os' => 'partials/form-os',
        'form-callback' => 'partials/form-callback',
        'form-reqbuysell' => 'partials/form-reqbuysell',
        'form-reqbuy' => 'partials/form-reqbuy',
        'page-content' => 'partials/page-content',
        'page-front' => 'partials/page-front',
        'page-catalog' => 'partials/page-catalog',
        'front-promo' => 'partials/front-promo',
        'front-business' => 'partials/front-business',
        'front-banners' => 'partials/front-banners',
        'one-benefit' => 'partials/one-benefit',
        'mortgage-block' => 'partials/mortgage-block',
        'form-viewer' => 'partials/form-viewer',
        'form-exchange' => 'partials/form-exchange',
    );

    /*
     * Обновляем конструктор
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        if (Request::current() !== null)
        {
            // URL страницы
            $this->page = Request::current()->param('page');
        }

        // Register infoblocks
        $this->header_phone_block = Sprig::factory('infoblock', Array('id' => 1))->load()->content;
        $this->footer_copyright_block = Sprig::factory('infoblock', Array('id' => 2))->load()->content;
        $this->footer_address_block = Sprig::factory('infoblock', Array('id' => 3))->load()->content;
        $this->footer_phone_block = Sprig::factory('infoblock', Array('id' => 4))->load()->content;
        $this->footer_counters_block = Sprig::factory('infoblock', Array('id' => 5))->load()->content;

        // Current year
        $this->year = date('Y');

        // Split phone number for two parts - code and phone
        if (preg_match('!^\(([^)]+)\)(.*)$!', $this->header_phone_block, $header_phone_parts))
        {
            $header_phone_block_tmp = array();
            $header_phone_block_tmp['code'] = $header_phone_parts[1];
            $header_phone_block_tmp['phone'] = $header_phone_parts[2];
            $this->header_phone_block = $header_phone_block_tmp;
        }
        else
        {
            $header_phone_block_tmp = array();
            $header_phone_block_tmp['code'] = $this->header_phone_block;
            $this->header_phone_block = $header_phone_block_tmp;
        }

        // Выбираем случайно одно преимущество
        $benefitO = Sprig::factory('benefits')->load(DB::select('*')->where('status', '=', '1')->order_by(NULL, 'RAND()'), 1);
        $this->benefit = $benefitO->as_array();

        parent::__construct($template, $partials);
    }

    /*
     * Функция построения массива для вывода верхнего меню разделов
     */
    public function menu()
    {
        $contents_arr = array();

        // Получаем корневую категорию и категории первого уровня
        $root_content = Sprig::factory('content')->root(1);
        $contents_id = $root_content->id;
        $root_childrens = $root_content->children->as_array();

        // Сортируем массив дочерних категорий
        usort($root_childrens, Array('View_Layout', 'sort_func_ord'));

        // Если мы не на главной странице - определяем родителя
        if (!empty($this->page))
            $parent = Sprig::factory('content', Array('url' => $this->page))->load()->parent();

        // Формируем новый массив с нужными значениями разделов первого уровня
        $index = -1;
        for ($i = 0; $i < count($root_childrens); $i++)
        {
            // Пропускаем страницы со статусом Не отображать
            if (empty($root_childrens[$i]->status))
                continue;

            $contents_arr[++$index]['name'] = $root_childrens[$i]->name;
            $contents_arr[$index]['num'] = $index + 1;
            // По умолчанию второго уровня меню нет
            $contents_arr[$index]['sub_menu']['exists'] = FALSE;
            // Если к странице привязан модуль - получаем данные о модуле
            if (!empty($root_childrens[$i]->module_id))
            {
                // Находим нужный модуль
                $module = Sprig::factory('module', array('mid' => $root_childrens[$i]->module_id))->load();
                if ($module->loaded())
                {
                    $contents_arr[$index]['url'] = $root_childrens[$i]->url;
                    // Добавляем активность пункта меню, если текущий контроллер совпадает с модулем
                    if ($module->name == Request::current()->controller())
                        $contents_arr[$index]['active'] = TRUE;

                    // Костылим, определяем жестко 4 типа каталога
                    if ($root_childrens[$i]->module_id == 3)
                    {
                        if ($root_childrens[$i]->url == 'catalog/1')
                            $contents_arr[$index]['icon'] = 'house';
                        elseif ($root_childrens[$i]->url == 'catalog/2')
                            $contents_arr[$index]['icon'] = 'city';
                        elseif ($root_childrens[$i]->url == 'catalog/3')
                            $contents_arr[$index]['icon'] = 'commerce';
                        elseif ($root_childrens[$i]->url == 'catalog/4')
                            $contents_arr[$index]['icon'] = 'business';

                        $contents_arr[$index]['name'] = preg_replace('!\s!', '<br>', $contents_arr[$index]['name'], 1);
                    }
                }
            }
            // Если страница - просто текстовый элемент
            else
            {
                $contents_arr[$index]['icon'] = 'services';

                // Для главной страницы URL не создаем
                if ($root_childrens[$i]->url != 'index')
                    $contents_arr[$index]['url'] = 'content/' . $root_childrens[$i]->url;

                // Добавляем активность пункта меню
                if ($this->page == $root_childrens[$i]->url or (isset($parent) and $root_childrens[$i]->id == $parent->id) or (empty($this->page) and $root_childrens[$i]->url == 'index'))
                {
                    $contents_arr[$index]['active'] = TRUE;
                }

                // Строим меню со вторым уровнем вложенности
                $childrens_2 = $root_childrens[$i]->children->as_array();
                // Сортируем массив дочерних категорий
                usort($childrens_2, Array('View_Layout', 'sort_func_ord'));
                // Формируем новый массив с нужными значениями разделов второго уровня
                $index2 = -1;
                for ($r = 0; $r < count($childrens_2); $r++)
                {
                    // Пропускаем страницы со статусом Не отображать
                    if (empty($childrens_2[$r]->status))
                        continue;

                    $contents_arr[$index]['sub_menu']['menu_items'][++$index2]['name'] = $childrens_2[$r]->name;
                    $contents_arr[$index]['sub_menu']['exists'] = TRUE;
                    // Если к странице привязан модуль - получаем данные о модуле
                    if (!empty($childrens_2[$r]->module_id))
                    {
                        // Находим нужный модуль
                        $module = Sprig::factory('module', array('mid' => $childrens_2[$r]->module_id))->load();
                        if ($module->loaded())
                            $contents_arr[$index]['sub_menu']['menu_items'][$index2]['url'] = $module->name;
                        // Добавляем активность пункта меню, если текущий контроллер совпадает с модулем
                        if ($module->name == Request::current()->controller())
                        {
                            $contents_arr[$index]['active'] = TRUE;
                            $contents_arr[$index]['sub_menu']['menu_items'][$index2]['active_2'] = TRUE;
                        }
                    }
                    // Если страница - просто текстовый элемент
                    else
                    {
                        // Для главной страницы URL не создаем
                        if ($childrens_2[$r]->url != 'index')
                            $contents_arr[$index]['sub_menu']['menu_items'][$index2]['url'] = 'content/' . $childrens_2[$r]->url;

                        // Добавляем активность пункта меню
                        if ($this->page == $childrens_2[$r]->url)
                        {
                            $contents_arr[$index]['active'] = TRUE;
                            $contents_arr[$index]['sub_menu']['menu_items'][$index2]['active_2'] = TRUE;
                        }
                    }
                }
            }
        }

        $contents_arr[0]['first'] = TRUE;
        $contents_arr[count($contents_arr) - 1]['last'] = TRUE;
//        print_r($contents_arr);
        return $contents_arr;
    }

    /*
     * Обновляем конструктор
     */
    public function prepare_table($data, $cols)
    {
        $table = $row = array();
        $even = $last = FALSE;
        $r = 0;
        $first = TRUE;

        for ($i = 0; $i < count($data); $i++)
        {
            $r++;
            $row[] = $data[$i];
            if ($r == $cols)
            {
                $table[] = array('data' => $row, 'even' => $even, 'first' => $first, 'last' => $last);
                $row = array();
                $first = FALSE;
                $r = 0;
                $even = !$even;
            }
        }

        if (($r > 0) and ($r < $cols))
        {
            for ($j = $r; $j <= $cols; $j++)
                $row[] = array('_empty_data' => TRUE);
            $table[] = array('data' => $row, 'even' => $even, 'first' => $first, 'last' => TRUE);
        }
        $table[count($table) - 1]['last'] = TRUE;

        return $table;
    }

    /*
     * Функция удаления тэгов и квотирования
     * для всех значений из массива $postData
     */
    protected function set_safe(& $post_arr, $def_dash = true)
    {
        foreach ($post_arr as $key => $value)
        {
            $post_arr[$key] = strip_tags($value);
            if (empty($post_arr[$key]) and !empty($def_dash))
                $post_arr[$key] = '-';
        }
    }

    /*
     * Функция получения настроек админ.панели
     */
    protected function get_variable($param)
    {
        $variable = Sprig::factory('settings', array('param' => $param))->load();
        return ($variable->loaded()) ? $variable->value : false;
    }

    /*
     * Функция фомирования тела письма из шаблона
     */
    protected function email_tpl_render($tpl_name, $vars_arr = array())
    {
        // Создаем объект нужного вида
        $tpl_path = 'mail/' . $tpl_name;
        // Подключаем класс с видом вручную
        require_once('application/classes/view/mail/index.php');
        $view = new View_Mail_Noticemail($tpl_path, $vars_arr);

        // Регистрируем переменные
        foreach ($vars_arr as $key => $value)
            $view->$key = $value;

        // Создаем служебные переменные
        $view->domen = $_SERVER['HTTP_HOST'];
        $view->date = date('d.m.Y H:i');

        // Генерируем контент
        $tpl_content = $view->render();

        return $tpl_content;
    }

    /*
     * Функция callback для сортировки дочерних категорий
     */
    static function sort_func_ord($a, $b)
    {
        return ($a->ord > $b->ord) ? +1 : -1;
    }

    static function sort_func_ord_arr($a, $b)
    {
        return ($a['ord'] > $b['ord']) ? +1 : -1;
    }

    /*
     * Функция для сортировки дочерних категорий по дате добавления
     */
    static function sort_func_time_add_arr($a, $b)
    {
        return ($a['time_add'] < $b['time_add']) ? +1 : -1;
    }

    static function sort_func_time_add($a, $b)
    {
        return ($a->time_add < $b->time_add) ? +1 : -1;
    }

    /*
     * Функция возвращает истину для всех четных вызовов
     * Используется в модулях для создания строк-зебр
     */
    public function even()
    {
        static $even;

        if (empty($even))
            $even = 1;

        if ($even == 2)
        {
            $even = 1;
            return true;
        }

        $even++;
    }

    public function even2()
    {
        static $even;

        if (empty($even))
            $even = 1;

        if ($even == 2)
        {
            $even = 1;
            return true;
        }

        $even++;
    }

    /*
     * Get one banner
     */
    public function one_banner()
    {
        static $banners;
        static $index = 0;

        if (!empty($banners))
        {
            if (isset($banners[$index]))
            {
                $banner = $banners[$index++];
                return $banner;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            // select all banners
            $bannersO = Sprig::factory('banner')->load(DB::select('*')->order_by(NULL, 'RAND()'), NULL);
            // Проходимся по всем баннерам
            for ($i = 0; $i < count($bannersO); $i++)
            {
                $banners[$i] = $bannersO[$i]->as_array();
                $banners[$i]['is_' . $banners[$i]['type']] = TRUE;
            }

            if (!empty($banners))
            {
                $banner = $banners[$index++];
                return $banner;
            }
            else
            {
                return FALSE;
            }
        }
    }

}