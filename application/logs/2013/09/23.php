<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-09-23 13:50:32 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/page-news ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-09-23 13:50:32 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/page-news ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\progtest\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/page-n...')
#1 Z:\home\progtest\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('page-news', 'partials/page-n...')
#2 Z:\home\progtest\www\application\classes\view\layout.php(100): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\progtest\www\application\classes\view\home\index.php(38): View_Layout->__construct()
#4 Z:\home\progtest\www\application\classes\controller\auto.php(56): View_Home_Index->__construct('home/index')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\progtest\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#7 Z:\home\progtest\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\progtest\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\progtest\www\index.php(109): Kohana_Request->execute()
#10 {main}