<?php

/*
  Вид для контроллера reqbuy, действия Faqadd
 */
class View_Feedback_Ajax_Reqbuy extends View_Layout
{

    private $reqbuy_email;
    protected $_layout = 'feedback/ajax/reqbuy';

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотеку PHPMailer
        require('packages/PhpMailer/class.phpmailer.php');

        // Получаем параметры модуля
        $this->reqbuy_email = $this->get_variable('reqbuy_email');
    }

    /*
     * AJAX ответ
     */
    public function ajax_response()
    {
        session_start();

        // Проверяем, что форма была разблокирована
        if (isset($_SESSION['qaptcha_key']) and $_SESSION['qaptcha_key'] == 'iqaptcha' and isset($_POST['iqaptcha']) and empty($_POST['iqaptcha']))
        {
            // Проверяем заполненность всех обязательных полей
            if (!empty($_POST['fio']) and !empty($_POST['phone']) and !empty($_POST['catalog_id']) and !empty($_POST['object_data']))
            {
                // Обезопасим входные данные
                $this->set_safe($_POST, FALSE);
                
                // Добавим переводы строк
                $_POST['object_data'] = str_replace(';', "\r\n", $_POST['object_data']);

                // Сохраняем в админке
                // Создаем запрос
                $reqbuy = Sprig::factory('reqbuy');
                $reqbuy->values($_POST);
                $reqbuy->create();

                // Если в настройках задан email администратора - отправляем письмо
                if (!empty($this->reqbuy_email))
                {
                    // Создаем объект PHPMailer и задаем начальные настройки
                    $mail = new PHPMailer();
                    $mail->CharSet = 'utf-8';
                    $mail->From = 'no-reply@' . $_SERVER['HTTP_HOST'];
                    $mail->FromName = $_SERVER['HTTP_HOST'];
                    $mail->AddAddress($this->reqbuy_email, 'Получатель запросов');
                    $mail->Subject = 'Заявка на покупку объекта от: ' . $_POST['fio'];
                    $mail->Body = $this->email_tpl_render('reqbuyadminmail', $_POST);
                    $mail->Send();
                }

                return 'true';
            }
        }

        return 'false';
    }

}