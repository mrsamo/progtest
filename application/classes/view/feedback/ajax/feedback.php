<?php

/*
  Вид для контроллера Feedback, действия Faqadd
 */
class View_Feedback_Ajax_Feedback extends View_Layout
{

    private $fos_email;
    protected $_layout = 'feedback/ajax/feedback';

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотеку PHPMailer
        require('packages/PhpMailer/class.phpmailer.php');

        // Получаем параметры модуля
        $this->fos_email = $this->get_variable('fos_email');
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
            if (!empty($_POST['fio']) and !empty($_POST['phone']) and !empty($_POST['message']))
            {
                // Обезопасим входные данные
                $this->set_safe($_POST, FALSE);

                // Сохраняем в админке
                // Создаем запрос
                $feedback = Sprig::factory('feedback');
                $feedback->values($_POST);
                $feedback->create();

                // Если в настройках задан email администратора - отправляем письмо
                if (!empty($this->fos_email))
                {
                    // Создаем объект PHPMailer и задаем начальные настройки
                    $mail = new PHPMailer();
                    $mail->CharSet = 'utf-8';
                    $mail->From = 'no-reply@' . $_SERVER['HTTP_HOST'];
                    $mail->FromName = $_SERVER['HTTP_HOST'];
                    $mail->AddAddress($this->fos_email, 'Получатель запросов');
                    $mail->Subject = 'Сообщение с сайта от: ' . $_POST['fio'];
                    $mail->Body = $this->email_tpl_render('feedbackadminmail', $_POST);
                    $mail->Send();
                }

                return 'true';
            }
        }

        return 'false';
    }

}