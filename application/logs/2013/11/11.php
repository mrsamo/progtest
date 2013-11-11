<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-11-11 12:29:01 --- ERROR: Database_Exception [ 1146 ]: Table 'progtest.andts_infoblock' doesn't exist [ SELECT `andts_infoblock`.`id` AS `id`, `andts_infoblock`.`name` AS `name`, `andts_infoblock`.`content` AS `content`, `andts_infoblock`.`wysiwyg` AS `wysiwyg` FROM `andts_infoblock` WHERE `andts_infoblock`.`id` = 1 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-11-11 12:29:01 --- STRACE: Database_Exception [ 1146 ]: Table 'progtest.andts_infoblock' doesn't exist [ SELECT `andts_infoblock`.`id` AS `id`, `andts_infoblock`.`name` AS `name`, `andts_infoblock`.`content` AS `content`, `andts_infoblock`.`wysiwyg` AS `wysiwyg` FROM `andts_infoblock` WHERE `andts_infoblock`.`id` = 1 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\testpr.lc\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT `andts_i...', false, Array)
#1 Z:\home\testpr.lc\www\modules\sprig\classes\sprig\core.php(1229): Kohana_Database_Query->execute('default')
#2 Z:\home\testpr.lc\www\application\classes\view\layout.php(70): Sprig_Core->load()
#3 Z:\home\testpr.lc\www\application\classes\view\home\index.php(35): View_Layout->__construct()
#4 Z:\home\testpr.lc\www\application\classes\controller\auto.php(56): View_Home_Index->__construct('home/index')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Home))
#7 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\testpr.lc\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\testpr.lc\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-11-11 15:20:16 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'andts_news.lft' in 'field list' [ SELECT *, `andts_news`.`id` AS `id`, `andts_news`.`title` AS `title`, `andts_news`.`date_pub` AS `date_pub`, `andts_news`.`short_article` AS `short_article`, `andts_news`.`article` AS `article`, `andts_news`.`img` AS `img`, `andts_news`.`is_publish` AS `is_publish`, `andts_news`.`lft` AS `lft`, `andts_news`.`rgt` AS `rgt`, `andts_news`.`lvl` AS `lvl`, `andts_news`.`scope` AS `scope` FROM `andts_news` ORDER BY `date_pub` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-11-11 15:20:16 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'andts_news.lft' in 'field list' [ SELECT *, `andts_news`.`id` AS `id`, `andts_news`.`title` AS `title`, `andts_news`.`date_pub` AS `date_pub`, `andts_news`.`short_article` AS `short_article`, `andts_news`.`article` AS `article`, `andts_news`.`img` AS `img`, `andts_news`.`is_publish` AS `is_publish`, `andts_news`.`lft` AS `lft`, `andts_news`.`rgt` AS `rgt`, `andts_news`.`lvl` AS `lvl`, `andts_news`.`scope` AS `scope` FROM `andts_news` ORDER BY `date_pub` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\testpr.lc\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_News', Array)
#1 Z:\home\testpr.lc\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\testpr.lc\www\application\classes\view\news\index.php(15): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\testpr.lc\www\application\classes\controller\auto.php(56): View_News_Index->__construct('news/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_News))
#6 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\testpr.lc\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\testpr.lc\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-11-11 15:22:13 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'andts_news.lft' in 'field list' [ SELECT *, `andts_news`.`id` AS `id`, `andts_news`.`title` AS `title`, `andts_news`.`date_pub` AS `date_pub`, `andts_news`.`short_article` AS `short_article`, `andts_news`.`article` AS `article`, `andts_news`.`img` AS `img`, `andts_news`.`is_publish` AS `is_publish`, `andts_news`.`lft` AS `lft`, `andts_news`.`rgt` AS `rgt`, `andts_news`.`lvl` AS `lvl`, `andts_news`.`scope` AS `scope` FROM `andts_news` ORDER BY `date_pub` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-11-11 15:22:13 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'andts_news.lft' in 'field list' [ SELECT *, `andts_news`.`id` AS `id`, `andts_news`.`title` AS `title`, `andts_news`.`date_pub` AS `date_pub`, `andts_news`.`short_article` AS `short_article`, `andts_news`.`article` AS `article`, `andts_news`.`img` AS `img`, `andts_news`.`is_publish` AS `is_publish`, `andts_news`.`lft` AS `lft`, `andts_news`.`rgt` AS `rgt`, `andts_news`.`lvl` AS `lvl`, `andts_news`.`scope` AS `scope` FROM `andts_news` ORDER BY `date_pub` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\testpr.lc\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT *, `andt...', 'Model_News', Array)
#1 Z:\home\testpr.lc\www\modules\sprig\classes\sprig\core.php(1243): Kohana_Database_Query->execute('default')
#2 Z:\home\testpr.lc\www\application\classes\view\news\index.php(15): Sprig_Core->load(Object(Database_Query_Builder_Select), NULL)
#3 Z:\home\testpr.lc\www\application\classes\controller\auto.php(56): View_News_Index->__construct('news/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_News))
#6 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\testpr.lc\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\testpr.lc\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-11-11 16:09:24 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/news/list ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-11-11 16:09:24 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/news/list ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\testpr.lc\www\modules\KOstache\classes\kohana\kostache.php(127): Kohana_Kostache->_load('news/list')
#1 Z:\home\testpr.lc\www\modules\KOstache\classes\kohana\kostache.php(76): Kohana_Kostache->template('news/list')
#2 Z:\home\testpr.lc\www\application\classes\view\layout.php(98): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\testpr.lc\www\application\classes\view\news\list.php(23): View_Layout->__construct()
#4 Z:\home\testpr.lc\www\application\classes\controller\auto.php(56): View_News_List->__construct('news/index')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_News))
#7 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\testpr.lc\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\testpr.lc\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-11-11 16:40:51 --- ERROR: Database_Exception [ 1048 ]: Column 'status' cannot be null [ INSERT INTO `andts_news` (`title`, `date_pub`, `short_article`, `article`, `img`, `status`) VALUES ('ва', NULL, '', '', 0.000000, NULL) ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-11-11 16:40:51 --- STRACE: Database_Exception [ 1048 ]: Column 'status' cannot be null [ INSERT INTO `andts_news` (`title`, `date_pub`, `short_article`, `article`, `img`, `status`) VALUES ('ва', NULL, '', '', 0.000000, NULL) ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\testpr.lc\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(2, 'INSERT INTO `an...', false, Array)
#1 Z:\home\testpr.lc\www\modules\sprig\classes\sprig\core.php(1290): Kohana_Database_Query->execute('default')
#2 Z:\home\testpr.lc\www\application\classes\controller\news.php(21): Sprig_Core->create()
#3 [internal function]: Controller_News->action_create()
#4 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_News))
#5 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 Z:\home\testpr.lc\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 Z:\home\testpr.lc\www\index.php(109): Kohana_Request->execute()
#8 {main}
2013-11-11 16:42:25 --- ERROR: Database_Exception [ 1048 ]: Column 'status' cannot be null [ INSERT INTO `andts_news` (`title`, `date_pub`, `short_article`, `article`, `img`, `status`) VALUES ('1111', NULL, '', '', 0.000000, NULL) ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-11-11 16:42:25 --- STRACE: Database_Exception [ 1048 ]: Column 'status' cannot be null [ INSERT INTO `andts_news` (`title`, `date_pub`, `short_article`, `article`, `img`, `status`) VALUES ('1111', NULL, '', '', 0.000000, NULL) ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\testpr.lc\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(2, 'INSERT INTO `an...', false, Array)
#1 Z:\home\testpr.lc\www\modules\sprig\classes\sprig\core.php(1290): Kohana_Database_Query->execute('default')
#2 Z:\home\testpr.lc\www\application\classes\controller\news.php(22): Sprig_Core->create()
#3 [internal function]: Controller_News->action_create()
#4 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_News))
#5 Z:\home\testpr.lc\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 Z:\home\testpr.lc\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 Z:\home\testpr.lc\www\index.php(109): Kohana_Request->execute()
#8 {main}