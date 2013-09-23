<?php

/*
 * Вид для контроллера Catalog, действия Open
 * Наследуем от класса для действия Open
 */
class View_Admin_Catalog_Add extends View_Admin_Catalog_Open
{

    public $addable = TRUE;

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);
        
        $this->is_category = $this->is_object = FALSE;
        // Узнаем, что мы добавляем - объект или категорию
        if (!empty($this->is_business))
        {
            $this->is_object = TRUE;
        }
        else
        {
            if (!empty($this->lvl0))
                $this->is_category = TRUE;
            else
                $this->is_object = TRUE;
        }
        
        $this->title .= ' :: Создание ' . (!empty($this->is_category) ? 'категории' : 'объекта');
    }

}