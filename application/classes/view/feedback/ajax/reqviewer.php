<?php

/*
  Вид для контроллера reqviewer, действия Faqadd
 */
class View_Feedback_Ajax_Reqviewer extends View_Layout
{

    private $reqviewer_email;
    protected $_layout = 'feedback/ajax/reqviewer';

    /*
     * Обновляем конструктор-родитель
     */
    public function __construct($template = NULL, array $partials = NULL)
    {
        parent::__construct($template, $partials);

        // Подключаем библиотеку PHPMailer
        require('packages/PhpMailer/class.phpmailer.php');

        // Получаем параметры модуля
        $this->reqviewer_email = $this->get_variable('reqviewer_email');
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
            if (!empty($_POST['fio']) and !empty($_POST['phone']) and !empty($_POST['catalog_id']) and !empty($_POST['object_data']) and !empty($_POST['view_date']) and !empty($_POST['view_time']))
            {
                // Обезопасим входные данные
                $this->set_safe($_POST, FALSE);
                
                // Добавим переводы строк
                $_POST['object_data'] = str_replace(';', "\r\n", $_POST['object_data']);
                $view_date_arr = explode('.', $_POST['view_date']);
                $human_date = $_POST['view_date'];
                $_POST['view_date'] = $view_date_arr[2] . '.' . $view_date_arr[1] . '.' . $view_date_arr[0];

                // Сохраняем в админке
                // Создаем запрос
                $reqviewer = Sprig::factory('reqviewer');
                $reqviewer->values($_POST);
                $reqviewer->create();
                $_POST['view_date'] = $human_date;

                // Если в настройках задан email администратора - отправляем письмо
                if (!empty($this->reqviewer_email))
                {
                    // Создаем объект PHPMailer и задаем начальные настройки
                    $mail = new PHPMailer();
                    $mail->CharSet = 'utf-8';
                    $mail->From = 'no-reply@' . $_SERVER['HTTP_HOST'];
                    $mail->FromName = $_SERVER['HTTP_HOST'];
                    $mail->AddAddress($this->reqviewer_email, 'Получатель запросов');
                    $mail->Subject = 'Заявка на просмотр от: ' . $_POST['fio'];
                    $mail->Body = $this->email_tpl_render('reqvieweradminmail', $_POST);
                    $mail->Send();
                }

                return 'true';
            }
        }

        return 'false';
    }

}