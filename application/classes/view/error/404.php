<?php

/*
  Вид для отображения 404 ошибки
 */
class View_Error_404 extends View_Layout
{

    public $title = '404 ошибка :: страница не найдена';
    public $is_content = TRUE;
    

    /*
      Обновляем конструктор
      При создании класса сразу регистрируем крошки
     */
    public function __construct()
    {
        parent::__construct();

        // Регистрируем крошки
        $path[0]['title'] = 'Страница не найдена';
        $this->breadcrumbs = $this->prepare_table($path, 1);
    }

}