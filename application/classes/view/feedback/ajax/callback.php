<?php

/*
  Вид для контроллера callback, действия Callback
 */
class View_Feedback_Ajax_Callback extends View_Layout
{

    protected $_layout = 'feedback/ajax/callback';
    private $cb_email;
    private $cb_phone;
    private $save_cb_email;

    /*     * *
      Обновляем конструктор-родитель
     * * */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотеку PHPMailer
        require('packages/PhpMailer/class.phpmailer.php');

        // Получаем параметры модуля
        $this->callback_email = $this->get_variable('callback_email');
    }

    /*     * *
      AJAX ответ
     * * */
    public function ajax_response()
    {
        session_start();
        
        // Проверяем, что форма была разблокирована
        if (isset($_SESSION['qaptcha_key']) and $_SESSION['qaptcha_key'] == 'iqaptcha' and isset($_POST['iqaptcha']) and empty($_POST['iqaptcha']))
        {
            // Проверяем заполненность всех обязательных полей
            if (!empty($_POST['fio']) and !empty($_POST['phone']))
            {
                // Обезопасим входные данные
                $this->set_safe($_POST, FALSE);

                // Сохраняем в админке
                $callback = Sprig::factory('callback');
                $callback->values($_POST);
                $callback->create();

                // Если в настройках задан email администратора - отправляем письмо
                if (!empty($this->callback_email))
                {
                    // Создаем объект PHPMailer и задаем начальные настройки
                    $mail = new PHPMailer();
                    $mail->CharSet = 'utf-8';
                    $mail->From = 'no-reply@' . $_SERVER['HTTP_HOST'];
                    $mail->FromName = $_SERVER['HTTP_HOST'];
                    $mail->AddAddress($this->callback_email, 'Получатель запросов');
                    $mail->Subject = 'Перезвоните мне: ' . $_POST['phone'] . ' ' . $_POST['fio'];
                    $mail->Body = $this->email_tpl_render('callbackadminmail', $_POST);
                    $mail->Send();
                }

                return 'true';
            }
        }

        return 'false';
    }

}