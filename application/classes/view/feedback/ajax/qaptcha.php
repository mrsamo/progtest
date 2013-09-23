<?php

/*
 * Вид для контроллера Feedback, действия index
 */
class View_Feedback_Ajax_Qaptcha extends Kohana_Kostache_Layout
{

    protected $_layout = 'feedback/ajax/qaptcha';

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);
    }

    /*
     * AJAX ответ
     */
    public function ajax_response()
    {
        session_start();

        $response['error'] = false;
        if (isset($_POST['action']) and isset($_POST['qaptcha_key']))
        {
            $_SESSION['qaptcha_key'] = false;

            if (htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'qaptcha')
            {
                $_SESSION['qaptcha_key'] = $_POST['qaptcha_key'];
                return json_encode($response);
            }
            else
            {
                $response['error'] = true;
                return json_encode($response);
            }
        }
        else
        {
            $response['error'] = true;
            return json_encode($response);
        }
    }

}