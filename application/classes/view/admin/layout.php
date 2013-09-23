<?php

class View_Admin_Layout extends Kohana_Kostache_Layout {

    public $errors;
    protected $_layout = 'admin/layout';
    // Настройки админ.части
    public $site_name;
    public $js_path;
    public $css_path;
    public $image_path;
    public $packages_path;
    public $datetime;
    public $id;
    protected $auth = false;
    public $user = false;
    protected $request;
    public $role;
    public $message_data;
    protected $_partials = array(
	'header' => 'admin/partials/header',
	'footer' => 'admin/partials/footer',
	'left_menu' => 'admin/partials/left_menu',
    );
    
    public function __construct($template = NULL, array $partials = NULL, $alien_call = false)
    {
	// Если объект создается сторонним приложением для использования
	// определенных функция - конструктор надо освободить от выполнения
	// лишних операций
	if (!empty($alien_call))
	    return;

	// Получаем нужные настройки админ.части
	$this->site_name = $this->get_variable('site_name');
	$this->js_path = $this->get_variable('js_path');
	$this->css_path = $this->get_variable('css_path');
	$this->image_path = $this->get_variable('image_path');
	$this->packages_path = $this->get_variable('packages_path');

	// Фомируем текущую дату для использования в шаблоне
	$this->datetime = date('H:i d/m/y');

	// Получаем ID из запроса
	$this->request = new Request(Request::detect_uri());
	$this->id = $this->request->param('id');

	// Формируем пользователя
	if (empty($this->auth))
	{
	    $this->auth = Auth::instance();
	    $this->user = $this->auth->get_user();
	    if (!empty($this->user))
	    {
		// Узнаем роль пользователя (помимо роли Login)
		$roleuser = Sprig::factory('roleuser')->load(DB::select('*')->where('user_id', '=', $this->user->id)->and_where('role_id', '!=', '1'), NULL);
		// Вытаскиваем роль
		if (!empty($roleuser[0]->role_id))
		    $this->role = Sprig::factory('role', Array('id' => $roleuser[0]->role_id))->load();
	    }
	}

	parent::__construct($template, $partials);
    }

    /*     * *
      Функция создания меню админ.части из доступных модулей
     * * */
    public function modules_menu()
    {
	$items = Array();

	// Проходим по всем разрешенных для данного пользователя модулям и собираем меню
	foreach ($this->access_modules as $module_id => $module_name)
	{
	    $classname_prefix = 'View_Admin_' . $module_name;
	    $classname = $classname_prefix . '_Index';

	    // Определяем, в каком модуле мы находимся в текущий момент
	    // Для данного модуля мы берем меню из текущего объекта, а не создаем новый
	    if (preg_match('!^' . $classname_prefix . '_!i', get_class($this)))
	    {
		$items[] = $this->menu_items();
	    }
	    elseif (class_exists($classname))
	    {
		// Третий аргумент говорит о стороннем вызове, чтобы конструктор
		// не совершал лишних действий
		$view = new $classname(null, null, true);
		$items[] = $view->menu_items(false);
	    }
	}

	return $items;
    }

    /*     * *
      Функция получения настроек админ.панели
     * * */
    protected function get_variable($param)
    {
	$variable = Sprig::factory('settings', array('param' => $param))->load();
	return ($variable->loaded()) ? (!empty($variable->value)) ? $variable->value : 'empty'  : false;
    }

    /*     * *
      Функция задания настроек админ.панели
     * * */
    protected function set_variable($param, $name, $value, $show)
    {
	// Создаем настройку и заполняем данными
	$variable = Sprig::factory('settings');
	$variable->name = $name;
	$variable->param = $param;
	$variable->value = $value;
	$variable->show = $show;
	// Добавляем запись в БД
	$variable->create();

	return $value;
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

    /*
     * Функция удаления тэгов и квотирования
     * для всех значений из массива $postData
     */
    protected function set_safe(& $post_arr, $def_dash = true)
    {
	foreach ($post_arr as $key => $value)
	{
	    $post_arr[$key] = strip_tags($value);
	    if (empty($post_arr[$key]) && !empty($def_dash))
		$post_arr[$key] = '-';
	}
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

}