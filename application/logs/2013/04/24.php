<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-24 09:59:53 --- ERROR: MustacheException [ 2 ]: Unexpected close section: header                    
                
                
                    {{>top-menu ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
2013-04-24 09:59:53 --- STRACE: MustacheException [ 2 ]: Unexpected close section: header                    
                
                
                    {{>top-menu ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
--
#0 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(212): Mustache->_findSection('<!DOCTYPE html>...')
#1 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('<!DOCTYPE html>...')
#2 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('<!DOCTYPE html>...', Array)
#3 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('<!DOCTYPE html>...')
#4 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('header', NULL)
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'header', NULL)
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
2013-04-24 11:59:31 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/feedback/ajax/index ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-24 11:59:31 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/feedback/ajax/index ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(127): Kohana_Kostache->_load('feedback/ajax/i...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(76): Kohana_Kostache->template('feedback/ajax/i...')
#2 Z:\home\andts\www\application\classes\view\layout.php(100): Kohana_Kostache->__construct('feedback/ajax/i...', NULL)
#3 Z:\home\andts\www\application\classes\view\feedback\ajax\reqviewer.php(17): View_Layout->__construct('feedback/ajax/i...', NULL)
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Feedback_Ajax_Reqviewer->__construct('feedback/ajax/i...')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Feedback))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-24 12:05:50 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/feedback/ajax/index ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-24 12:05:50 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/feedback/ajax/index ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(127): Kohana_Kostache->_load('feedback/ajax/i...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(76): Kohana_Kostache->template('feedback/ajax/i...')
#2 Z:\home\andts\www\application\classes\view\layout.php(100): Kohana_Kostache->__construct('feedback/ajax/i...', NULL)
#3 Z:\home\andts\www\application\classes\view\feedback\ajax\reqviewer.php(17): View_Layout->__construct('feedback/ajax/i...', NULL)
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Feedback_Ajax_Reqviewer->__construct('feedback/ajax/i...')
#5 [internal function]: Controller_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Feedback))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}
2013-04-24 12:28:54 --- ERROR: MustacheException [ 2 ]: Unexpected close section: reqviewers ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
2013-04-24 12:28:54 --- STRACE: MustacheException [ 2 ]: Unexpected close section: reqviewers ~ MODPATH\KOstache\vendor\mustache\Mustache.php [ 326 ]
--
#0 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(212): Mustache->_findSection('<div class="spc...')
#1 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(200): Mustache->_renderSections('<div class="spc...')
#2 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('<div class="spc...', Array)
#3 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(619): Mustache->render('<div class="spc...')
#4 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(547): Mustache->_renderPartial('content', '??')
#5 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(516): Mustache->_renderTag('>', 'content', '??')
#6 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(201): Mustache->_renderTags('{{>header}}??<d...')
#7 Z:\home\andts\www\modules\KOstache\vendor\mustache\Mustache.php(172): Mustache->_renderTemplate('{{>header}}??<d...', Array)
#8 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache\layout.php(43): Mustache->render()
#9 Z:\home\andts\www\application\classes\controller\auto.php(71): Kohana_Kostache_Layout->render()
#10 [internal function]: Controller_Auto->after()
#11 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Admin_Reqviewer))
#12 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#13 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#14 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#15 {main}