<?php

/*
  Вид для контроллера home, действия index
 */
class View_Mail_Noticemail extends View_Layout
{
    /*
      Обновляем конструктор
     */
    public function __construct($template)
    {
        $this->_layout = $template;
        $this->domen = $_SERVER['HTTP_HOST'];
        parent::__construct($template);
    }

}