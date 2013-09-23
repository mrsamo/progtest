<?php

defined('SYSPATH') or die('No direct script access.');
ini_set('max_execution_time', 0);

// -- Environment setup --------------------------------------------------------
// Load the core Kohana class
require SYSPATH . 'classes/kohana/core' . EXT;

if (is_file(APPPATH . 'classes/kohana' . EXT))
{
    // Application extends the core
    require APPPATH . 'classes/kohana' . EXT;
}
else
{
    // Load empty core extension
    require SYSPATH . 'classes/kohana' . EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Asia/Yekaterinburg');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('ru-ru');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
    Kohana::$environment = constant('Kohana::' . strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
    'base_url' => '/',
    'index_file' => '',
    'errors' => false,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH . 'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);
Cookie::$salt = 'pembi';

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
    'auth' => MODPATH . 'auth', // Basic authentication
    'sprig-auth' => MODPATH . 'sprig-auth', // Basic authentication
    'cache' => MODPATH . 'cache', // Caching with multiple backends
    'codebench' => MODPATH . 'codebench', // Benchmarking tool
    'database' => MODPATH . 'database', // Database access
    'image' => MODPATH . 'image', // Image manipulation
    'userguide' => MODPATH . 'userguide', // User guide and API documentation
    'sprig' => MODPATH . 'sprig', //
    'sprig-mptt' => MODPATH . 'sprig-mptt', //
    'KOstache' => MODPATH . 'KOstache', //
    'pagination' => MODPATH . 'kohana-pagination', //
//    'debug-toolbar' => MODPATH . 'debug-toolbar',
));

// Правила обработки URL текстовых разделов
Route::set('content', 'content/<page>', array(
            'id' => '\w+',
        ))
        ->defaults(array(
            'controller' => 'home',
            'action' => 'content',
            'page' => FALSE,
        ));

// Правила обработки URL страниц каталога
Route::set('catalog', 'catalog/<cat_id>(/city/<city>)(/rooms/<rooms>)(/floor/<floor_compare>_<floor>)(/floors/<floors_1>_<floors_2>)(/price/<price_1>_<price_2>)(/square/<square_1>_<square_2>)(/page/<page>)', array(
            'page' => '\d+',
            'cat_id' => '\d+',
            'rooms' => '\d+',
            'floor_compare' => '\d+',
            'floor' => '\d+',
            'floors_1' => '\d*',
            'floors_2' => '\d*',
            'price_1' => '\d+',
            'price_2' => '\d+',
            'square_1' => '\d*',
            'square_2' => '\d*',
        ))
        ->defaults(array(
            'controller' => 'catalog',
            'action' => 'index',
            'page' => 1,
            'cat_id' => 1,
            'city' => FALSE,
            'rooms' => FALSE,
            'floor_compare' => FALSE,
            'floor' => FALSE,
            'floors_1' => FALSE,
            'floors_2' => FALSE,
            'price_1' => FALSE,
            'price_2' => FALSE,
            'square_1' => FALSE,
            'square_2' => FALSE,
        ));

// Правила обработки URL страниц отдельных услуг
Route::set('catalog_view', 'catalog/view/<cat_id>', array(
            'cat_id' => '\d+',
        ))
        ->defaults(array(
            'controller' => 'catalog',
            'action' => 'view',
        ));

// CRON
// Правила обработки URL, которые используются для CRON работ
Route::set('cron', 'admin/<controller>/cron/<action>(/<id>)')
        ->defaults(array(
            'directory' => 'admin',
            'ajax' => 'cron',
            'id' => FALSE,
        ));

// AJAX
// Правила обработки URL, которые используются модулями в админ.части для AJAX запросов
Route::set('ajax_admin', 'admin/<controller>/ajax/<action>(/<id>)')
        ->defaults(array(
            'directory' => 'admin',
            'ajax' => 'ajax',
            'id' => FALSE,
        ));
// Правила обработки URL, которые используются модулями в пользовательской части для AJAX запросов
Route::set('ajax', '<controller>/ajax/<action>(/<id>)')
        ->defaults(array(
            'ajax' => 'ajax',
            'id' => FALSE,
        ));

// АДМИНКА
// Правила обработки URL для админ.части
Route::set('admin', 'admin(/<controller>(/<action>(/<id>)))')
        ->defaults(array(
            'directory' => 'admin',
            'controller' => 'home',
            'action' => 'index',
            'id' => FALSE,
        ));

// Правила обработки URL по умолчанию
Route::set('default', '(<controller>(/<action>(/<id>)))')
        ->defaults(array(
            'controller' => 'home',
            'action' => 'index',
            'id' => FALSE,
        ));

// Добавляем свой обработчик исключений для ловли 404 ошибки
set_exception_handler(Array('Exceptionhandler', 'handle'));