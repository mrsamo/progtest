<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-21 23:43:05 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'andts_callback.call_time' in 'field list' [ SELECT *, `andts_callback`.`id` AS `id`, `andts_callback`.`fio` AS `fio`, `andts_callback`.`phone` AS `phone`, `andts_callback`.`call_time` AS `call_time`, `andts_callback`.`time` AS `time` FROM `andts_callback` ORDER BY `time` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-21 23:43:05 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'andts_callback.call_time' in 'field list' [ SELECT *, `andts_callback`.`id` AS `id`, `andts_callback`.`fio` AS `fio`, `andts_callback`.`phone` AS `phone`, `andts_callback`.`call_time` AS `call_time`, `andts_callback`.`time` AS `time` FROM `andts_callback` ORDER BY `time` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Callback', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\admin\callback\index.php(31): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\view\admin\layout.php(89): View_Admin_Callback_Index->__construct(NULL, NULL, true)
#4 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(718): View_Admin_Layout->modules_menu()
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(700): Mustache->_findVariableInContext('modules_menu', Array)
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(216): Mustache->_getVariable('modules_menu')
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('{{#modules_menu...')
#8 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{#modules_menu...', Array)
#9 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('{{#modules_menu...')
#10 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('left_menu', '???')
#11 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'left_menu', '???')
#12 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{>header}}??<d...')
#13 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{>header}}??<d...', Array)
#14 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#15 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#16 [internal function]: Controller_Auto->after()
#17 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Admin_Feedback))
#18 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#19 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#20 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#21 {main}