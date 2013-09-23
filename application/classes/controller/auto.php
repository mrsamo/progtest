<?php

/*
  Родительский контроллер для остальных
 */

class Controller_Auto extends Kohana_Controller {

    public $a;
    public $b;
    protected $directory;
    protected $controller_name;
    protected $action_name;
    protected $ajax;

    public function before()
    {
	/* list($usec, $sec) = explode(" ",microtime()); 
	  $this->a = (float)$usec + (float)$sec; */
	parent::before();
 
	// Получаем наименования контроллера и действия из запроса
	$this->directory = $this->request->directory() ? $this->request->directory() . '_' : '';
	$this->controller_name = $this->request->controller();
	$this->action_name = $this->request->action();

	// Пробуем получить параметр AJAX из запроса
	$this->ajax = $this->request->param('ajax');
	// Если метку AJAX есть - добавляем к директории путь до AJAX
	$this->ajax = (!empty($this->ajax)) ? $this->ajax . '_' : '';

	// Создаем имена главного и текущего видов заданного контроллера
	$view_name_prefix = 'View_' . $this->directory . $this->controller_name . '_' . $this->ajax;
	$view_name_index = $view_name_prefix . 'Index';
	$view_name = $view_name_prefix . $this->action_name;
	$view_file_index = strtolower(str_replace('_', '/', $view_name_index));
	$view_file = strtolower(str_replace('_', '/', $view_name_prefix)) . strtolower($this->action_name);

	// Формируем имена главного и текущего шаблонов
	$template_name_prefix = $this->directory . $this->controller_name . '_' . $this->ajax;
	$template_name_index = $template_name_prefix . 'Index';
	$template_name = $template_name_prefix . $this->action_name;
	$template_file_index = strtolower(str_replace('_', '/', $template_name_index));
	$template_file = strtolower(str_replace('_', '/', $template_name_prefix)) . strtolower($this->action_name);

	// Если в папке templates нет файла шаблона, берем основной шаблон
	if (!Kohana::find_file('templates', $template_file, 'mustache'))
	    $template_file = $template_file_index;

	/* var_dump($view_file);
	  exit; */

	// Если в папке classes есть нужный класс
	if (Kohana::find_file('classes', $view_file))
	{
	    $this->view = new $view_name($template_file);
	}
	// Если нет нужного - может есть основной класс
	elseif (Kohana::find_file('classes', $view_file_index))
	{
	    $this->view = new $view_name_index($template_file);
	}
    }

    public function after()
    {
	// Если вид успешно наден - формируем вывод
	if (!empty($this->view))
	{
	    $this->response->body(
		    $this->view->render()
	    );
	}
	// Если нет - выводим предупреждение
	else
	{
	    $this->response->body(
		    '<h1>Не найден шаблон для View_'
		    . $this->directory . $this->controller_name . '_' . $this->action_name . '!</h1>'
	    );
	}

	if (empty($this->ajax))
	{
	    //print_r($_POST);
	    /* list($usec, $sec) = explode(" ",microtime()); 
	      $this->b = (float)$usec + (float)$sec;
	      echo 'Страница генерировалась: ' . ($this->b - $this->a) . ' секунд'; */
	}
    }

}