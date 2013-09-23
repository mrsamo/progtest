<?php

/*
  Родительский контроллер для остальных в админ.части
  Расширяем родительский контроллер для пользовательской части сайта
  Добавляем проверку доступа к админ.части
 */
class Controller_Admin_Auto extends Controller_Auto
{

    protected $auth;
    protected $user;
    protected $access_modules = Array();

    /*     * *
      Проверяем доступ к админ.части
     * * */
    public function before()
    {
        // Вызываем метод для определения вида и шаблона
        parent::before();

        // Создаем объект запроса
        $request = Request::factory(false);
        $last_url = Request::detect_uri();

        //var_dump($last_url);
        //exit;
        // Создаем сессию для сохранения запрошенного пути в админку
        $session = Session::instance();
        // Если запрошенный URL не равен странице авторизации
        if (!preg_match('!^/admin/login!i', $last_url))
            $session->set('last_url', $last_url);

        // Проверяем - авторизован ли пользователь как администратор
        $this->auth = Auth::instance();
        // Изначально доступ для данного модуля для роли закрыт
        $perm_cur_module = false;
        // Массив ролей, имеющих доступ в админку
        $roles_access = Array('admin', 'manager', 'rop');
        if ($this->ajax == 'cron_')
        {

        }
        elseif ($this->auth->logged_in($roles_access))
        {
            $this->user = $this->auth->get_user();
            // Вытаскиваем все роли пользователя
            $roles = Sprig::factory('roleuser')->load(DB::select('*')->where('user_id', '=', $this->user->id), NULL);
            for ($i = 0; $i < count($roles); $i++)
            {
                // Вытаскиваем разрешение на модули для роли пользователя
                $perm = Sprig::factory('roleperm')->load(DB::select('*')->where('role_id', '=', $roles[$i]->role_id), NULL);

                // Проходим по всем разрешенным модулям для роли
                for ($r = 0; $r < count($perm); $r++)
                {
                    // Если запись для роли есть и она равна 1 - разрешение есть
                    if ($perm[$r]->permission == 1)
                    {
                        // Вытаскиваем название модуля
                        $module = Sprig::factory('module', Array('mid' => $perm[$r]->module_id))->load();
                        // Если запрашиваемый модуль входит в список разрешенных для данной роли - ставим метку
                        if (($module->loaded() && $this->controller_name == $module->name))
                            $perm_cur_module = true;

                        // Добавляем модуль в список разрешенных
                        $this->access_modules[$module->mid] = $module->name;
                    }
                }
            }
            
            // Если доступа к запрашиваемому модулю нет - редиректим на главную станицу админки
            if (empty($perm_cur_module) and $last_url != '/admin')
                $request->redirect('/admin');

            // Регистрируем список разрешенных модулей в виде
            $this->view->access_modules = $this->access_modules;
        }
        elseif ($last_url != '/admin/subscribe/ajax/send')
        {
            // Если была засабмичена форма авторизации
            if (!empty($_POST['login']) && !empty($_POST['password']))
            {
                // Пробуем авторизоваться по введенным данным
                if ($this->auth->login($_POST['login'], $_POST['password']))
                {
                    // Вытаскиваем запрошенный URL админки из сессии auth_path
                    $path = $session->get('last_url');
                    if (!empty($path))
                        $request->redirect($path);
                    else
                        $request->redirect('/admin');
                }
            }

            // Если пользователь не авторизован и не находится на странице
            // авторизации, редиректим его на страницу авторизации
            if (!preg_match('!^/admin/login!i', $last_url))
            {
                $request->redirect('/admin/login');
            }
        }

        //$this->auth->logout();
    }

}