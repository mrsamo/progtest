<?php

/*
  Отображение для страницы каталога
 */
class View_Catalog_Index extends View_Layout
{

    public $cat_id;
    public $page;
    public $cur_category;
    public $parent;
    public $grandparent;
    public $parents;
    public $products = array();
    public $catalog_page_structure;
    // Метка, что это каталог
    public $is_catalog = TRUE;
    // Директории для изображений
    public $orig_images_dir = 'catalog_files/images/orig/';
    public $cat_images_dir = 'catalog_files/images/cat/';
    public $cart_images_dir = 'catalog_files/images/cart/';
    // Фильтры (табы)
    public $filters_tabs = array();
    public $filters_tabs_exists = FALSE;
    // Количество позиций на странице
    public $count_per_page = 4;
    // Цены в ползунке по умолчанию
    public $price_min = 100;
    public $price_max = 100000;
    // Выбор сравнения этажа
    public $floor_compare_arr = array(
        0 => array('id' => 1, 'compare' => 'Не выше', 'active' => 0),
        1 => array('id' => 2, 'compare' => 'Не ниже', 'active' => 0),
        2 => array('id' => 3, 'compare' => 'Равен', 'active' => 0),
    );
    // Метка о работающих фильтрах
    public $filter_works = FALSE;
    // Метка категорий
    public $is_country = FALSE;
    public $is_city = FALSE;
    public $is_commercial = FALSE;
    public $is_business = FALSE;
    // Зависимости типа недвижимости от scope
    public $scope_types_arr = array(
        1 => 'is_country',
        2 => 'is_city',
        3 => 'is_commercial',
        4 => 'is_business',
    );

    public function __construct($template = NULL, array $partials = NULL, $alien_call = FALSE)
    {
        // Категория и страница для каталога
        $this->cat_id = Request::current()->param('cat_id');
        $this->page = Request::current()->param('page');
        $this->page = (!empty($this->page)) ? $this->page : 1;
        // Фильтры
        $this->city = Request::current()->param('city');
        $this->rooms = Request::current()->param('rooms');
        $this->floor_compare = Request::current()->param('floor_compare');
        $this->floor = Request::current()->param('floor');
        $this->floors_1 = Request::current()->param('floors_1');
        $this->floors_2 = Request::current()->param('floors_2');
        $this->price_1 = Request::current()->param('price_1');
        $this->price_2 = Request::current()->param('price_2');
        $this->square_1 = Request::current()->param('square_1');
        $this->square_2 = Request::current()->param('square_2');
        
        // Регистрируем метку, что включен фильтр
        if (!empty($this->city) or !empty($this->rooms) or !empty($this->floor) or !empty($this->floors_1) or !empty($this->floors_2) or !empty($this->price_1) or !empty($this->price_2) or !empty($this->square_1) or !empty($this->square_2))
            $this->filter_works = TRUE;

        // Создаем объект текущей категории (товара)
        $this->cur_category = Sprig::factory('catalog', array('id' => $this->cat_id))->load();
        
        // Создаем метку о текущем типе недвижимости
        if (!empty($this->scope_types_arr[$this->cur_category->scope]))
            $this->{$this->scope_types_arr[$this->cur_category->scope]} = TRUE;

        // Выкидываем 404 ошибку
        if (!empty($this->cat_id) and !$this->cur_category->loaded())
            throw new HTTP_Exception_404('Раздел каталога отсутствует');

        // Получаем всех родителей категории
        $this->parent = $this->cur_category->parent;
        $this->grandparent = $this->parent->parent;
        $this->parents = $this->cur_category->parents;
        $count_perants = count($this->parents);
        $lvl_var = 'lvl' . $count_perants;
        $this->$lvl_var = TRUE;

        // Если мы не в разделе готового бизнеса - определяем табы фильтров
        if ($this->cur_category->scope != 4)
        {
            // Если мы в подкатегории недвижимости, берем на уровень выше
            $category_root = ($this->cur_category->lvl == 1) ? $this->parent : $this->cur_category;
            $query_filter = DB::select('*')->where('scope', '=', $category_root->scope)->where('status', '=', 1)->where('lvl', '!=', 2)->where('lft', '>=', $category_root->lft)->where('rgt', '<=', $category_root->rgt)->order_by('lvl', 'ASC')->order_by('ord', 'ASC');
            $filtersO = Sprig::factory('catalog')->load($query_filter, NULL);

            // Массивы для уникальных значений
            $rooms = $cities = array();
            for ($i = 0; $i < count($filtersO); $i++)
            {
                $this->filters_tabs[$i] = $filtersO[$i]->as_array();
                $this->filters_tabs[$i]['rooms'] = array();
                $this->filters_tabs[$i]['cities'] = array();
                $this->filters_tabs[$i]['floor_compare'] = $this->floor_compare_arr;

                // Если это таб Все
                if ($filtersO[$i]->id == $category_root->id)
                {
                    $this->filters_tabs[$i]['name'] = 'Все';
                    $this->filters_tabs[$i]['active'] = TRUE;
                }

                // Добавляем активности
                if ($filtersO[$i]->id == $this->cat_id)
                {
                    $this->filters_tabs[0]['active'] = FALSE;
                    $this->filters_tabs[$i]['active'] = TRUE;

                    // Уже выбранные фильтры
                    if (!empty($this->price_1))
                        $this->filters_tabs[$i]['def_filters']['price_1'] = $this->price_1;
                    if (!empty($this->price_2))
                        $this->filters_tabs[$i]['def_filters']['price_2'] = $this->price_2;

                    if (!empty($this->square_1))
                        $this->filters_tabs[$i]['def_filters']['square_1'] = $this->square_1;
                    if (!empty($this->square_2))
                        $this->filters_tabs[$i]['def_filters']['square_2'] = $this->square_2;

                    if (!empty($this->floors_1))
                        $this->filters_tabs[$i]['def_filters']['floors_1'] = $this->floors_1;
                    if (!empty($this->floors_2))
                        $this->filters_tabs[$i]['def_filters']['floors_2'] = $this->floors_2;

                    if (!empty($this->floor))
                        $this->filters_tabs[$i]['def_filters']['floor'] = $this->floor;
                    if (!empty($this->floor_compare))
                        $this->filters_tabs[$i]['floor_compare'][$this->floor_compare - 1]['active'] = 1;
                }

                // Выбираем мин. и максимальную цену
                $query_price_min = DB::select(DB::expr('MIN(price) as min_price'))->from('catalog')->where('scope', '=', $category_root->scope)->where('status', '=', 1)->where('lvl', '=', 2)->where('lft', '>', $filtersO[$i]->lft)->where('rgt', '<', $filtersO[$i]->rgt);
                $result_price_min = $query_price_min->execute();
                $this->filters_tabs[$i]['min_price'] = (!empty($result_price_min[0])) ? $result_price_min[0]['min_price'] : $this->price_min;
                if (empty($this->filters_tabs[$i]['min_price']))
                    $this->filters_tabs[$i]['min_price'] = 1;

                $query_price_max = DB::select(DB::expr('MAX(price) as max_price'))->from('catalog')->where('scope', '=', $category_root->scope)->where('status', '=', 1)->where('lvl', '=', 2)->where('lft', '>', $filtersO[$i]->lft)->where('rgt', '<', $filtersO[$i]->rgt);
                $result_price_max = $query_price_max->execute();
                $this->filters_tabs[$i]['max_price'] = (!empty($result_price_max[0])) ? $result_price_max[0]['max_price'] : $this->price_max;

                if ($this->filters_tabs[$i]['min_price'] == $this->filters_tabs[$i]['max_price'] + 1)
                    $this->filters_tabs[$i]['max_price'] += 1000;

                // Комнаты и Города добавляем только для дочерных категорий
                // Для категории Все заполняем в последующем из дочерних
                if ($filtersO[$i]->id != $category_root->id)
                {
                    // Выбираем возможное количество комнат
                    $query_rooms = DB::select(DB::expr('DISTINCT rooms'))->from('catalog')->where('scope', '=', $category_root->scope)->where('status', '=', 1)->where('lvl', '=', 2)->where('lft', '>', $filtersO[$i]->lft)->where('rgt', '<', $filtersO[$i]->rgt)->order_by('rooms', 'ASC');
                    $result_rooms = $query_rooms->execute();
                    for ($r = 0; $r < count($result_rooms); $r++)
                    {
                        $room = $result_rooms[$r]['rooms'];
                        if (empty($room))
                            continue;

                        $active = 0;
                        if ($filtersO[$i]->id == $this->cat_id and $this->rooms == $room)
                            $active = 1;

                        $this->filters_tabs[$i]['rooms'][] = array('room' => $room, 'active' => $active);
                        if (empty($rooms[$room]))
                        {
                            $active = 0;
                            if ($category_root->id == $this->cat_id and $this->rooms == $room)
                                $active = 1;
                            $this->filters_tabs[0]['rooms'][] = array('room' => $room, 'active' => $active);
                        }

                        $rooms[$room] = 1;
                    }

                    // Выбираем возможное количество комнат
                    $query_cities = DB::select(DB::expr('DISTINCT city'))->from('catalog')->where('scope', '=', $category_root->scope)->where('status', '=', 1)->where('lvl', '=', 2)->where('lft', '>', $filtersO[$i]->lft)->where('rgt', '<', $filtersO[$i]->rgt)->order_by('city', 'ASC');
                    $result_cities = $query_cities->execute();
                    $city_decode = base64_decode($this->city);
                    for ($r = 0; $r < count($result_cities); $r++)
                    {
                        $city = $result_cities[$r]['city'];
                        if (empty($city))
                            continue;

                        $active = 0;
                        if ($filtersO[$i]->id == $this->cat_id and $city_decode == $city)
                            $active = 1;

                        $this->filters_tabs[$i]['cities'][] = array('city' => $city, 'active' => $active);
                        if (empty($cities[$city]))
                        {
                            $active = 0;
                            if ($category_root->id == $this->cat_id and $this->rooms == $room)
                                $active = 1;
                            $this->filters_tabs[0]['cities'][] = array('city' => $city, 'active' => $active);
                        }

                        $cities[$city] = 1;
                    }
                }
            }

//            print_r($this->filters_tabs);
//            exit;
        }

        // Уровень, на котором разсположены объекты
        $object_lvl = 2;
        // Для раздела Готовый бизнес этот уровень меньше не единицу
        if ($this->cur_category->scope == 4)
            $object_lvl = 1;

        // Запрос на выборку нужных объектов
        $query_products = DB::select('*')->where('scope', '=', $this->cur_category->scope)->where('status', '=', 1)->where('lvl', '=', $object_lvl)->where('lft', '>', $this->cur_category->lft)->where('rgt', '<', $this->cur_category->rgt)->order_by('ord', 'ASC');

        // Узнаем ID страницы каталога в структуре контента
        $this->catalog_page_structure = Sprig::factory('content', Array('url' => 'catalog/' . $this->cur_category->scope))->load();

        // Регистрируем мета-тэги и текст на странице категории
        if (!empty($this->lvl0))
        {
            $this->title = $this->catalog_page_structure->meta_title;
            $this->description = $this->catalog_page_structure->meta_description;
            $this->keywords = $this->catalog_page_structure->meta_keywords;

            $this->content = $this->catalog_page_structure->content;
        }
        // Для внутренних страниц берем значения из данных категории
        else
        {
            $this->title = $this->cur_category->meta_title;
            $this->description = $this->cur_category->meta_description;
            $this->keywords = $this->cur_category->meta_keywords;

            $this->content = $this->cur_category->content;
        }

        // Хлебные крошки        
        for ($i = 0; $i < count($this->parents); $i++)
        {
            if (empty($i))
            {
                $path[0]['title'] = $this->catalog_page_structure->name;
                $path[0]['url'] = $this->catalog_page_structure->url;
            }
            else
            {
                $path[$i]['title'] = $this->parents[$i]->name;
                $path[$i]['url'] = 'catalog/' . $this->parents[$i]->id;
            }
        }
        $path[$i]['title'] = $this->cur_category->name;

        // Регистрируем хлебные крошки
        $this->breadcrumbs = $this->prepare_table($path, 1);

        // Если объект создается сторонним приложением для использования
        // определенных функция - конструктор надо освободить от выполнения
        // лишних операций
        if (!empty($alien_call))
        {
            parent::__construct();
            return;
        }

        // Добавляем фильтры
        if (!empty($this->city))
            $query_products = $query_products->where('city', '=', base64_decode($this->city));
        if (!empty($this->rooms))
            $query_products = $query_products->where('rooms', '=', $this->rooms);
        if (!empty($this->floor) and !empty($this->floor_compare))
        {
            switch ($this->floor_compare)
            {
                case 1: $compare = '<=';
                    break;
                case 2: $compare = '>=';
                    break;
                default: $compare = '=';
            }
            $query_products = $query_products->where('floor', $compare, $this->floor);
        }
        if (!empty($this->floors_1))
            $query_products = $query_products->where('floors', '>=', $this->floors_1);
        if (!empty($this->floors_2))
            $query_products = $query_products->where('floors', '<=', $this->floors_2);
        
        if (!empty($this->price_1))
            $query_products = $query_products->where('price', '>=', $this->price_1);
        if (!empty($this->price_2))
            $query_products = $query_products->where('price', '<=', $this->price_2);
        
        if (!empty($this->square_1))
            $query_products = $query_products->where('square', '>=', $this->square_1);
        if (!empty($this->square_2))
            $query_products = $query_products->where('square', '<=', $this->square_2);

        // Добавляем назначенные фильтры
        // Создаем объект пагинатора с нужными парметрами
        $pagination = Pagination::factory(Array(
                    'total_items' => $this->get_products_count($query_products),
                    'current_page' => Array('source' => 'route', 'key' => 'page'),
                    'items_per_page' => $this->count_per_page,
                    'auto_hide' => true,
                    'view' => 'pagination/catalog',
        ));

        $this->page_links = $pagination->render();

        // Высчитываем смещение для пагинации
        $offset = $this->count_per_page * ($this->page - 1);
        $query_products = $query_products->limit($this->count_per_page)->offset($offset);
        $productsO = Sprig::factory('catalog')->load($query_products, NULL);

        // Проходим по всем товарам на странице и формируем конечный массив
        for ($i = 0; $i < count($productsO); $i++)
        {
            $this->products[$i] = $productsO[$i]->as_array();
        }

        parent::__construct();
    }

    /*
     * Функция возвращает количество товаров в текущей категории
     */
    private function get_products_count($query_products)
    {
        $products = $query_products->from('catalog')->execute();
        return count($products);
    }

    /*
     * Функция выдачи текущего URL страницы
     */
    public function cur_url()
    {
        $url = '/' . $this->catalog_page_structure->url;
        if (!empty($this->cat_id))
            $url .= '/' . $this->cat_id;
        // Если страница не первая - добавляем страницу
        if (!empty($this->page) and $this->page != 1)
            $url .= '/page/' . $this->page;

        return $url;
    }

}