<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-25 09:57:25 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'MIN(price)' in 'field list' [ SELECT `MIN(price)`, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`data` AS `data`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 2 AND `rgt` < 11 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-25 09:57:25 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'MIN(price)' in 'field list' [ SELECT `MIN(price)`, `andts_catalog`.`id` AS `id`, `andts_catalog`.`name` AS `name`, `andts_catalog`.`content` AS `content`, `andts_catalog`.`map` AS `map`, `andts_catalog`.`data` AS `data`, `andts_catalog`.`price` AS `price`, `andts_catalog`.`city` AS `city`, `andts_catalog`.`street` AS `street`, `andts_catalog`.`tract` AS `tract`, `andts_catalog`.`house` AS `house`, `andts_catalog`.`corps` AS `corps`, `andts_catalog`.`floor` AS `floor`, `andts_catalog`.`square` AS `square`, `andts_catalog`.`square_2` AS `square_2`, `andts_catalog`.`rooms` AS `rooms`, `andts_catalog`.`image` AS `image`, `andts_catalog`.`virtour` AS `virtour`, `andts_catalog`.`hot_status` AS `hot_status`, `andts_catalog`.`hypothec_status` AS `hypothec_status`, `andts_catalog`.`meta_title` AS `meta_title`, `andts_catalog`.`meta_keywords` AS `meta_keywords`, `andts_catalog`.`meta_description` AS `meta_description`, `andts_catalog`.`ord` AS `ord`, `andts_catalog`.`status` AS `status`, `andts_catalog`.`lft` AS `lft`, `andts_catalog`.`rgt` AS `rgt`, `andts_catalog`.`lvl` AS `lvl`, `andts_catalog`.`scope` AS `scope` FROM `andts_catalog` WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 2 AND `rgt` < 11 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT `MIN(pri...', false, Array)
#1 Z:\home\andts\www\modules\sprig\classes\sprig\core.php(1229): Kohana_Database_Query->execute('default')
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(81): Sprig_Core->load(Object(Database_Query_Builder_Select))
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-25 13:09:35 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 2 AND `rgt` < 11 OR' at line 1 [ SELECT * WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 2 AND `rgt` < 11 ORDER BY `ord` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-25 13:09:35 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 2 AND `rgt` < 11 OR' at line 1 [ SELECT * WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 2 AND `rgt` < 11 ORDER BY `ord` ASC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT * WHERE ...', false, Array)
#1 Z:\home\andts\www\application\classes\view\catalog\index.php(318): Kohana_Database_Query->execute()
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(290): View_Catalog_Index->get_products_count(Object(Database_Query_Builder_Select))
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}
2013-04-25 13:36:26 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'floors' in 'where clause' [ SELECT * FROM `andts_catalog` WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 1 AND `rgt` < 16 AND `floors` >= '1' AND `floors` = '34' AND `price`  ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2013-04-25 13:36:26 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'floors' in 'where clause' [ SELECT * FROM `andts_catalog` WHERE `scope` = 1 AND `status` = 1 AND `lvl` = 2 AND `lft` > 1 AND `rgt` < 16 AND `floors` >= '1' AND `floors` = '34' AND `price`  ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 Z:\home\andts\www\modules\database\classes\kohana\database\query.php(246): Kohana_Database_MySQL->query(1, 'SELECT * FROM `...', false, Array)
#1 Z:\home\andts\www\application\classes\view\catalog\index.php(324): Kohana_Database_Query->execute()
#2 Z:\home\andts\www\application\classes\view\catalog\index.php(296): View_Catalog_Index->get_products_count(Object(Database_Query_Builder_Select))
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#4 [internal function]: Controller_Auto->before()
#5 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#9 {main}