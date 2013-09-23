<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-23 11:20:37 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/form-sellbuy ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-23 11:20:37 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/form-sellbuy ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/form-s...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('form-sellbuy', 'partials/form-s...')
#2 Z:\home\andts\www\application\classes\view\layout.php(99): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\catalog\index.php(161): View_Layout->__construct()
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-23 11:27:23 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/form-reqsellbuy ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-23 11:27:23 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/form-reqsellbuy ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/form-r...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('form-reqsellbuy', 'partials/form-r...')
#2 Z:\home\andts\www\application\classes\view\layout.php(99): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\catalog\index.php(161): View_Layout->__construct()
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-23 11:27:26 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/form-reqsellbuy ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-23 11:27:26 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/partials/form-reqsellbuy ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(148): Kohana_Kostache->_load('partials/form-r...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(83): Kohana_Kostache->partial('form-reqsellbuy', 'partials/form-r...')
#2 Z:\home\andts\www\application\classes\view\layout.php(99): Kohana_Kostache->__construct(NULL, NULL)
#3 Z:\home\andts\www\application\classes\view\catalog\index.php(161): View_Layout->__construct()
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Catalog_Index->__construct('catalog/index')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-23 12:08:24 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/mail/reqbuyselladminmail ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-23 12:08:24 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/mail/reqbuyselladminmail ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(127): Kohana_Kostache->_load('mail/reqbuysell...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(76): Kohana_Kostache->template('mail/reqbuysell...')
#2 Z:\home\andts\www\application\classes\view\layout.php(99): Kohana_Kostache->__construct('mail/reqbuysell...', NULL)
#3 Z:\home\andts\www\application\classes\view\mail\index.php(15): View_Layout->__construct('mail/reqbuysell...')
#4 Z:\home\andts\www\application\classes\view\layout.php(295): View_Mail_Noticemail->__construct('mail/reqbuysell...', Array)
#5 Z:\home\andts\www\application\classes\view\feedback\ajax\reqbuysell.php(58): View_Layout->email_tpl_render('reqbuyselladmin...', Array)
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(718): View_Feedback_Ajax_Reqbuysell->ajax_response()
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(700): Mustache->_findVariableInContext('ajax_response', Array)
#8 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(606): Mustache->_getVariable('ajax_response')
#9 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(558): Mustache->_renderUnescaped('ajax_response')
#10 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('{', 'ajax_response', NULL)
#11 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{{ajax_respons...')
#12 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{{ajax_respons...', Array)
#13 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#14 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#15 [internal function]: Controller_Auto->after()
#16 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Feedback))
#17 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#18 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#19 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#20 {main}