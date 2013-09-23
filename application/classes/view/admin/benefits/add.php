<?php

/*
  Вид для контроллера Benefits, действия Add
  Наследуем от класса для действия Index
 */
class View_Admin_Benefits_Add extends View_Admin_Benefits_Index
{

    public $title = 'Администрирование :: Преимущества :: Создание преимущества';

    /*     * *
      Обновляем конструктор-родитель
     * * */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);
    }

}