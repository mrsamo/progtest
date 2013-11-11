<?php

/*
  Отображение для страницы каталога
 */
class View_News_Create extends View_Layout
{
    public $is_content = TRUE;
    public $news=array();


    public function __construct($template = NULL, array $partials = NULL, $alien_call = FALSE)
    {

        parent::__construct();
    }

}