<?php

/*
  Вид для контроллера Feedback, действия index
 */
class View_Feedback_Index extends View_Layout
{
    /*
     * Обновляем конструктор
     */
    public function __construct($template = NULL, array $partials = NULL, $alien_call = false)
    {
        parent::__construct($template, $partials, $alien_call);
    }

}