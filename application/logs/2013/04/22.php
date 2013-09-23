<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-22 00:16:22 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/admin/reqviewer/index ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-22 00:16:22 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/admin/reqviewer/index ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(127): Kohana_Kostache->_load('admin/reqviewer...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(76): Kohana_Kostache->template('admin/reqviewer...')
#2 Z:\home\andts\www\application\classes\view\admin\layout.php(63): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\admin\reqviewer\index.php(16): View_Admin_Layout->__construct(NULL, NULL)
#4 Z:\home\andts\www\application\classes\view\admin\layout.php(89): View_Admin_Reqviewer_Index->__construct(NULL, NULL, true)
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(718): View_Admin_Layout->modules_menu()
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(700): Mustache->_findVariableInContext('modules_menu', Array)
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(216): Mustache->_getVariable('modules_menu')
#8 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('{{#modules_menu...')
#9 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{#modules_menu...', Array)
#10 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('{{#modules_menu...')
#11 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('left_menu', '???')
#12 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'left_menu', '???')
#13 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{>header}}??<d...')
#14 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{>header}}??<d...', Array)
#15 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#16 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#17 [internal function]: Controller_Auto->after()
#18 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Admin_Callback))
#19 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#20 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#21 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#22 {main}
2013-04-22 00:36:07 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 00:36:07 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT COUNT(*)...', false, Array)
#1 Z:\home\andts\www\application\classes\view\catalog\index.php(220): Kohana_Database_Query->execute()
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(182): View_Catalog_Index->get_products_count()
#3 Z:\home\andts\www\application\classes\controller\auto.php(61): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 01:07:54 --- ERROR: Sprig_Exception [ 0 ]: Model_Reqbuy model does not have a field catalog_id ~ MODPATH\sprig\classes\sprig\core.php [ 457 ]
2013-04-22 01:07:54 --- STRACE: Sprig_Exception [ 0 ]: Model_Reqbuy model does not have a field catalog_id ~ MODPATH\sprig\classes\sprig\core.php [ 457 ]
--
#0 [internal function]: Sprig_Core->__set('catalog_id', '3')
#1 Z:\home\andts\www\modules\database\classes\kohana\database\mysql\result.php(62): mysql_fetch_object(Resource id #17, 'Model_Reqbuy', NULL)
#2 Z:\home\andts\www\modules\database\classes\kohana\database\result.php(239): Kohana_Database_MySQL_Result->current()
#3 Z:\home\andts\www\application\classes\view\admin\reqbuy\index.php(38): Kohana_Database_Result->offsetGet(0)
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Admin_Reqbuy_Index->__construct('admin/reqbuy/in...')
#5 Z:\home\andts\www\application\classes\controller\admin\auto.php(21): Controller_Auto->before()
#6 [internal function]: Controller_Admin_Auto->before()
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Admin_Reqbuy))
#8 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#11 {main}
2013-04-22 01:09:03 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'andts_exchange.
Partial Texts
Full Texts
Relational key
Relational display field
Show binary contents
Show BLOB contents
Hide Browser transformation
	id 	fio 	phone 	comment 	object_da' in 'field list' [ SELECT *, `andts_exchange`.`id` AS `id`, `andts_exchange`.`fio` AS `fio`, `andts_exchange`.`phone` AS `phone`, `andts_exchange`.`object_data_1` AS `object_data_1`, `andts_exchange`.`object_data_2` AS `object_data_2`, `andts_exchange`.`
Partial Texts
Full Texts
Relational key
Relational display field
Show binary contents
Show BLOB contents
Hide Browser transformation
	id 	fio 	phone 	comment 	object_data 	catalog_id` AS `
Partial Texts
Full Texts
Relational key
Relational display field
Show binary contents
Show BLOB contents
Hide Browser transformation
	id 	fio 	phone 	comment 	object_data 	catalog_id`, `andts_exchange`.`time` AS `time` FROM `andts_exchange` ORDER BY `time` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 01:09:03 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'andts_exchange.
Partial Texts
Full Texts
Relational key
Relational display field
Show binary contents
Show BLOB contents
Hide Browser transformation
	id 	fio 	phone 	comment 	object_da' in 'field list' [ SELECT *, `andts_exchange`.`id` AS `id`, `andts_exchange`.`fio` AS `fio`, `andts_exchange`.`phone` AS `phone`, `andts_exchange`.`object_data_1` AS `object_data_1`, `andts_exchange`.`object_data_2` AS `object_data_2`, `andts_exchange`.`
Partial Texts
Full Texts
Relational key
Relational display field
Show binary contents
Show BLOB contents
Hide Browser transformation
	id 	fio 	phone 	comment 	object_data 	catalog_id` AS `
Partial Texts
Full Texts
Relational key
Relational display field
Show binary contents
Show BLOB contents
Hide Browser transformation
	id 	fio 	phone 	comment 	object_data 	catalog_id`, `andts_exchange`.`time` AS `time` FROM `andts_exchange` ORDER BY `time` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Exchange', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\admin\exchange\index.php(31): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\view\admin\layout.php(89): View_Admin_Exchange_Index->__construct(NULL, NULL, true)
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
#17 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Admin_Reqbuy))
#18 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#19 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#20 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#21 {main}
2013-04-22 02:24:21 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/front-slider ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-22 02:24:21 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/front-slider ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/front-...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('front-slider', 'partials/front-...')
#2 Z:\home\andts\www\application\classes\view\layout.php(70): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\home\index.php(20): View_Layout->__construct()
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Home_Index->__construct('home/index')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-22 03:47:44 --- ERROR: Sprig_Exception [ 0 ]: Model_Infoblock model does not have a field vysivyg ~ MODPATH\sprig\classes\sprig\core.php [ 457 ]
2013-04-22 03:47:44 --- STRACE: Sprig_Exception [ 0 ]: Model_Infoblock model does not have a field vysivyg ~ MODPATH\sprig\classes\sprig\core.php [ 457 ]
--
#0 [internal function]: Sprig_Core->__set('vysivyg', '0')
#1 Z:\home\andts\www\modules\database\classes\kohana\database\mysql\result.php(62): mysql_fetch_object(Resource id #54, 'Model_Infoblock', NULL)
#2 Z:\home\andts\www\modules\database\classes\kohana\database\result.php(104): Kohana_Database_MySQL_Result->current()
#3 Z:\home\andts\www\application\classes\view\admin\infoblock\index.php(29): Kohana_Database_Result->as_array()
#4 Z:\home\andts\www\application\classes\view\admin\layout.php(90): View_Admin_Infoblock_Index->menu_items(false)
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(718): View_Admin_Layout->modules_menu()
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(700): Mustache->_findVariableInContext('modules_menu', Array)
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(216): Mustache->_getVariable('modules_menu')
#8 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('{{#modules_menu...')
#9 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{#modules_menu...', Array)
#10 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('{{#modules_menu...')
#11 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('left_menu', '???')
#12 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'left_menu', '???')
#13 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{>header}}??<d...')
#14 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{>header}}??<d...', Array)
#15 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#16 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#17 [internal function]: Controller_Auto->after()
#18 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Admin_Content))
#19 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#20 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#21 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#22 {main}
2013-04-22 05:49:57 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'RAND()' at line 1 [ SELECT *, `andts_banners`.`id` AS `id`, `andts_banners`.`type` AS `type`, `andts_banners`.`link` AS `link`, `andts_banners`.`source` AS `source`, `andts_banners`.`width` AS `width`, `andts_banners`.`height` AS `height` FROM `andts_banners` ORDER BY `id` RAND() ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 05:49:57 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'RAND()' at line 1 [ SELECT *, `andts_banners`.`id` AS `id`, `andts_banners`.`type` AS `type`, `andts_banners`.`link` AS `link`, `andts_banners`.`source` AS `source`, `andts_banners`.`width` AS `width`, `andts_banners`.`height` AS `height` FROM `andts_banners` ORDER BY `id` RAND() ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Banner', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\home\index.php(29): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Home_Index->__construct('home/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 05:50:59 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'RAND()' in 'order clause' [ SELECT *, `andts_banners`.`id` AS `id`, `andts_banners`.`type` AS `type`, `andts_banners`.`link` AS `link`, `andts_banners`.`source` AS `source`, `andts_banners`.`width` AS `width`, `andts_banners`.`height` AS `height` FROM `andts_banners` ORDER BY `RAND()` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 05:50:59 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'RAND()' in 'order clause' [ SELECT *, `andts_banners`.`id` AS `id`, `andts_banners`.`type` AS `type`, `andts_banners`.`link` AS `link`, `andts_banners`.`source` AS `source`, `andts_banners`.`width` AS `width`, `andts_banners`.`height` AS `height` FROM `andts_banners` ORDER BY `RAND()` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Banner', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\home\index.php(29): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Home_Index->__construct('home/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 05:51:16 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'RAND()' at line 1 [ SELECT *, `andts_banners`.`id` AS `id`, `andts_banners`.`type` AS `type`, `andts_banners`.`link` AS `link`, `andts_banners`.`source` AS `source`, `andts_banners`.`width` AS `width`, `andts_banners`.`height` AS `height` FROM `andts_banners` ORDER BY `` RAND() ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 05:51:16 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'RAND()' at line 1 [ SELECT *, `andts_banners`.`id` AS `id`, `andts_banners`.`type` AS `type`, `andts_banners`.`link` AS `link`, `andts_banners`.`source` AS `source`, `andts_banners`.`width` AS `width`, `andts_banners`.`height` AS `height` FROM `andts_banners` ORDER BY `` RAND() ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Banner', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\home\index.php(29): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Home_Index->__construct('home/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 06:04:08 --- ERROR: MustacheException [ 2 ]: Unexpected close section: is_text ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
2013-04-22 06:04:08 --- STRACE: MustacheException [ 2 ]: Unexpected close section: is_text ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
--
#0 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(212): Mustache->_findSection('{{#banners_fron...')
#1 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('{{#banners_fron...')
#2 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{#banners_fron...', Array)
#3 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('{{#banners_fron...')
#4 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('front-banners', NULL)
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'front-banners', NULL)
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{>header}}??<d...')
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{>header}}??<d...', Array)
#8 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#9 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#10 [internal function]: Controller_Auto->after()
#11 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Home))
#12 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#13 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#14 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#15 {main}
2013-04-22 07:33:34 --- ERROR: MustacheException [ 1 ]: Unclosed section: hot_city_over3 ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 342 ]
2013-04-22 07:33:34 --- STRACE: MustacheException [ 1 ]: Unclosed section: hot_city_over3 ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 342 ]
--
#0 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(212): Mustache->_findSection('<div class="b-p...')
#1 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('<div class="b-p...')
#2 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('<div class="b-p...', Array)
#3 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('<div class="b-p...')
#4 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('front-promo', '        ')
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'front-promo', '        ')
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{>header}}??<d...')
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{>header}}??<d...', Array)
#8 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#9 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#10 [internal function]: Controller_Auto->after()
#11 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Home))
#12 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#13 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#14 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#15 {main}
2013-04-22 07:52:32 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 07:52:32 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT COUNT(*)...', false, Array)
#1 Z:\home\andts\www\application\classes\view\catalog\index.php(220): Kohana_Database_Query->execute()
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(182): View_Catalog_Index->get_products_count()
#3 Z:\home\andts\www\application\classes\controller\auto.php(61): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 07:52:44 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 07:52:44 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT COUNT(*)...', false, Array)
#1 Z:\home\andts\www\application\classes\view\catalog\index.php(220): Kohana_Database_Query->execute()
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(182): View_Catalog_Index->get_products_count()
#3 Z:\home\andts\www\application\classes\controller\auto.php(61): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 09:42:51 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/page ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-22 09:42:51 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/page ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/page')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('page', 'partials/page')
#2 Z:\home\andts\www\application\classes\view\layout.php(92): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\home\content.php(22): View_Layout->__construct()
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Home_Content->__construct('home/content')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-22 10:23:20 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/breadcrumd ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-22 10:23:20 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/breadcrumd ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/breadc...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('breadcrumd', 'partials/breadc...')
#2 Z:\home\andts\www\application\classes\view\layout.php(97): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\home\content.php(21): View_Layout->__construct()
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Home_Content->__construct('home/content')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-22 10:23:40 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/breadcrumd ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-22 10:23:40 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/breadcrumd ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/breadc...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('breadcrumd', 'partials/breadc...')
#2 Z:\home\andts\www\application\classes\view\layout.php(97): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\home\content.php(21): View_Layout->__construct()
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Home_Content->__construct('home/content')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-22 11:11:27 --- ERROR: MustacheException [ 2 ]: Unexpected close section: new_single ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
2013-04-22 11:11:27 --- STRACE: MustacheException [ 2 ]: Unexpected close section: new_single ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
--
#0 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(212): Mustache->_findSection('{{!?????????? ?...')
#1 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('{{!?????????? ?...')
#2 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{!?????????? ?...', Array)
#3 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('{{!?????????? ?...')
#4 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('content', NULL)
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'content', NULL)
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('<div class="l-2...')
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('<div class="l-2...', Array)
#8 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('<div class="l-2...')
#9 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('page-news', '        ')
#10 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'page-news', '        ')
#11 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{>header}}??<d...')
#12 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{>header}}??<d...', Array)
#13 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#14 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#15 [internal function]: Controller_Auto->after()
#16 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_News))
#17 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#18 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#19 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#20 {main}
2013-04-22 13:15:55 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/feedback/ajax/faqadd ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-22 13:15:55 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/feedback/ajax/faqadd ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(41): Kohana_Kostache->_load('feedback/ajax/f...')
#1 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#2 [internal function]: Controller_Auto->after()
#3 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Feedback))
#4 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#7 {main}
2013-04-22 14:28:59 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:28:59 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'id_1c' in 'where clause' [ SELECT COUNT(*) AS count_products FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT COUNT(*)...', false, Array)
#1 Z:\home\andts\www\application\classes\view\catalog\index.php(220): Kohana_Database_Query->execute()
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(182): View_Catalog_Index->get_products_count()
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 14:37:14 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 4 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:37:14 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 4 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(177): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 14:46:44 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 4 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:46:44 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 4 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(158): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 14:48:09 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:48:09 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(158): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 14:48:25 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:48:25 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(159): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 14:48:48 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:48:48 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(159): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 14:49:15 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:49:15 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(158): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 14:49:38 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 14:49:38 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(158): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 15:11:11 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 15:11:11 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(162): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 15:18:47 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 15:18:47 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 12 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(162): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-22 15:18:56 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 4 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-22 15:18:56 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT *, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `status` = 1 AND `id_1c` != '' AND `lft` > 1 AND `rgt` < 4 AND `article` != '' OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_Catalog', Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(162): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}