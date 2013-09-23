<?php

/*
  Вид для контроллера Benefits, действия Edit
  Наследуем от класса для действия Index
 */
class View_Admin_Benefits_Edit extends View_Admin_Benefits_Index
{

    public $title = 'Администрирование :: Преимущества :: Редактирование преимущества';
    public $editable = true;
    public $cur_benefit;

    /*     * *
      Обновляем конструктор-родитель
      Сразу получаем данные о текущем преимуществе
     * * */
    public function __construct($template = NULL, array $partials = NULL)
    {
        // Шаблон берем от метода Add
        $template = 'admin/benefits/add';

        parent::__construct($template, $partials);

        // Создаем объект текущего преимущества
        $this->cur_benefit = Sprig::factory('benefits', array('id' => $this->id))->load()->as_array();
    }

}