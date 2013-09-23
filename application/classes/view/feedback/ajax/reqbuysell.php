<?php

/*
  Вид для контроллера reqbuysell, действия Faqadd
 */
class View_Feedback_Ajax_Reqbuysell extends View_Layout
{

    private $reqbuysell_email;
    protected $_layout = 'feedback/ajax/reqbuysell';

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотеку PHPMailer
        require('packages/PhpMailer/class.phpmailer.php');

        // Получаем параметры модуля
        $this->reqbuysell_email = $this->get_variable('reqbuysell_email');
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
            if (!empty($_POST['fio']) and !empty($_POST['phone']) and !empty($_POST['object_data']))
            {
                // Обезопасим входные данные
                $this->set_safe($_POST, FALSE);

                // Сохраняем в админке
                // Создаем запрос
                $reqbuysell = Sprig::factory('reqbuysell');
                $reqbuysell->values($_POST);
                $reqbuysell->create();

                // Если в настройках задан email администратора - отправляем письмо
                if (!empty($this->reqbuysell_email))
                {
                    // Создаем объект PHPMailer и задаем начальные настройки
                    $mail = new PHPMailer();
                    $mail->CharSet = 'utf-8';
                    $mail->From = 'no-reply@' . $_SERVER['HTTP_HOST'];
                    $mail->FromName = $_SERVER['HTTP_HOST'];
                    $mail->AddAddress($this->reqbuysell_email, 'Получатель запросов');
                    $mail->Subject = 'Заявка на покупку/продажу/обмен от: ' . $_POST['fio'];
                    $mail->Body = $this->email_tpl_render('reqbuyselladminmail', $_POST);
                    $mail->Send();
                }

                return 'true';
            }
        }

        return 'false';
    }

}