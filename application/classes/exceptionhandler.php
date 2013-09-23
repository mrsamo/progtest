<?php

defined('SYSPATH') or die('No direct script access.');
class Exceptionhandler
{
    public static function handle(Exception $e)
    {
        switch (get_class($e))
        {
            case 'HTTP_Exception_404':
                // Посылаем статус страницы 404
                $response = new Response();
                $response->status(404);
                $response->protocol('HTTP/1.1');

                // Посылаем корректный статус 404 ошибки
                /* header('HTTP/1.0 404 Not Found');
                  header('HTTP/1.1 404 Not Found');
                  header('Status: 404 Not Found'); */

                // Создаем вид для отображения 404 ошибки
                $view = new View_Error_404('error/404');
                $view->message = $e->getMessage();

                // Если шаблон есть - отображаем страницу ошибки
                if (!empty($view))
                {
                    // Выводим шаблон
                    echo $response->send_headers()->body(
                            $view->render()
                    );
                }
                else
                {
                    echo $response->body(
                            '<h1>Не найден шаблон для View_Error_404</h1>'
                    );
                }
                return true;
                break;
            default:
                Kohana_Exception::handler($e);
        }
    }

}