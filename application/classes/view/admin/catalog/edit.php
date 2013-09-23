<?php

/*
 * Вид для контроллера Content, действия Edit
 * Наследуем от класса для действия Open
 */
class View_Admin_Catalog_Edit extends View_Admin_Catalog_Open
{

    public $editable = TRUE;

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        // Шаблон берем от метода Add
        $template = 'admin/catalog/add';

        parent::__construct($template, $partials);
        
        $this->is_category = $this->is_object = FALSE;
        // Узнаем, что мы добавляем - объект или категорию
        if (!empty($this->is_business))
        {
            $this->is_object = TRUE;
        }
        else
        {
            if (!empty($this->lvl1))
                $this->is_category = TRUE;
            else
                $this->is_object = TRUE;
        }
        
        $this->title .= ' :: Редактирование ' . (!empty($this->is_category) ? 'категории' : 'объекта');
    }
}