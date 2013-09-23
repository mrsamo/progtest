<?php

/*
  Вид для контроллера exchange, действия Faqadd
 */
class View_Feedback_Ajax_Exchange extends View_Layout
{

    private $exchange_email;
    protected $_layout = 'feedback/ajax/exchange';

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотеку PHPMailer
        require('packages/PhpMailer/class.phpmailer.php');

        // Получаем параметры модуля
        $this->exchange_email = $this->get_variable('exchange_email');
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
            if (!empty($_POST['fio']) and !empty($_POST['phone']) and !empty($_POST['catalog_id']) and !empty($_POST['object_data_1']) and !empty($_POST['object_data_2']))
            {
                // Обезопасим входные данные
                $this->set_safe($_POST, FALSE);
                
                // Добавим переводы строк
                $_POST['object_data_2'] = str_replace(';', "\r\n", $_POST['object_data_2']);

                // Сохраняем в админке
                // Создаем запрос
                $exchange = Sprig::factory('exchange');
                $exchange->values($_POST);
                $exchange->create();

                // Если в настройках задан email администратора - отправляем письмо
                if (!empty($this->exchange_email))
                {
                    // Создаем объект PHPMailer и задаем начальные настройки
                    $mail = new PHPMailer();
                    $mail->CharSet = 'utf-8';
                    $mail->From = 'no-reply@' . $_SERVER['HTTP_HOST'];
                    $mail->FromName = $_SERVER['HTTP_HOST'];
                    $mail->AddAddress($this->exchange_email, 'Получатель запросов');
                    $mail->Subject = 'Заявка на обмен от: ' . $_POST['fio'];
                    $mail->Body = $this->email_tpl_render('exchangeadminmail', $_POST);
                    $mail->Send();
                }

                return 'true';
            }
        }

        return 'false';
    }

}