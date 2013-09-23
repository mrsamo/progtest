<?php

/*
 * Класс вида отображения карточки товара
 */
class View_Catalog_View extends View_Catalog_Index
{

    public $product = array();
    public $is_product = TRUE;

    /*
     * Обновляем конструктор
     * При создании класса сразу заисываем данные об услуге в переменную
     */
    public function __construct($template = NULL, array $partials = NULL, $alien_call = FALSE)
    {
        parent::__construct($template, $partials, TRUE);

        // Формируем массив с данными по продукту
        $this->product = $this->cur_category->as_array();
        $this->product['price'] = number_format($this->product['price'], '', '', ' ');
    }

}