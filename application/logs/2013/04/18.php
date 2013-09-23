<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-18 10:10:48 --- ERROR: Kohana_Exception [ 0 ]: Template file does not exist: templates/admin/banner/add ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
2013-04-18 10:10:48 --- STRACE: Kohana_Exception [ 0 ]: Template file does not exist: templates/admin/banner/add ~ MODPATH\KOstache\classes\kohana\kostache.php [ 244 ]
--
#0 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(127): Kohana_Kostache->_load('admin/banner/ad...')
#1 Z:\home\andts\www\modules\KOstache\classes\kohana\kostache.php(76): Kohana_Kostache->template('admin/banner/ad...')
#2 Z:\home\andts\www\application\classes\view\admin\layout.php(63): Kohana_Kostache->__construct('admin/banner/ad...', NULL)
#3 Z:\home\andts\www\application\classes\view\admin\banner\index.php(23): View_Admin_Layout->__construct('admin/banner/ad...', NULL)
#4 Z:\home\andts\www\application\classes\view\admin\banner\edit.php(23): View_Admin_Banner_Index->__construct('admin/banner/ad...', NULL, true)
#5 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Admin_Banner_Edit->__construct('admin/banner/ed...')
#6 Z:\home\andts\www\application\classes\controller\admin\auto.php(21): Controller_Auto->before()
#7 [internal function]: Controller_Admin_Auto->before()
#8 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Admin_Banner))
#9 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#12 {main}
2013-04-18 11:09:57 --- ERROR: WideImage_UnknownErrorWhileMappingException [ 0 ]: WideImage_Mapper_JPEG returned an invalid result while saving to /images/banners/1.jpg ~ DOCROOT\packages\wideimage\Image.php [ 164 ]
2013-04-18 11:09:57 --- STRACE: WideImage_UnknownErrorWhileMappingException [ 0 ]: WideImage_Mapper_JPEG returned an invalid result while saving to /images/banners/1.jpg ~ DOCROOT\packages\wideimage\Image.php [ 164 ]
--
#0 Z:\home\andts\www\application\classes\view\admin\banner\index.php(298): WideImage_Image->saveToFile('/images/banners...')
#1 Z:\home\andts\www\application\classes\view\admin\banner\index.php(195): View_Admin_Banner_Index->upload_image('retaly.jpg', 'Z:\tmp\php1CE3....', '1')
#2 Z:\home\andts\www\application\classes\view\admin\banner\index.php(50): View_Admin_Banner_Index->update_banner(Array, Array)
#3 Z:\home\andts\www\application\classes\view\admin\banner\edit.php(23): View_Admin_Banner_Index->__construct('admin/banner/ad...', NULL, true)
#4 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Admin_Banner_Edit->__construct('admin/banner/in...')
#5 Z:\home\andts\www\application\classes\controller\admin\auto.php(21): Controller_Auto->before()
#6 [internal function]: Controller_Admin_Auto->before()
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Admin_Banner))
#8 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#11 {main}
2013-04-18 11:13:34 --- ERROR: WideImage_UnknownErrorWhileMappingException [ 0 ]: WideImage_Mapper_JPEG returned an invalid result while saving to /images/banners/3.jpg ~ DOCROOT\packages\wideimage\Image.php [ 164 ]
2013-04-18 11:13:34 --- STRACE: WideImage_UnknownErrorWhileMappingException [ 0 ]: WideImage_Mapper_JPEG returned an invalid result while saving to /images/banners/3.jpg ~ DOCROOT\packages\wideimage\Image.php [ 164 ]
--
#0 Z:\home\andts\www\application\classes\view\admin\banner\index.php(298): WideImage_Image->saveToFile('/images/banners...')
#1 Z:\home\andts\www\application\classes\view\admin\banner\index.php(125): View_Admin_Banner_Index->upload_image('retaly.jpg', 'Z:\tmp\php6E35....', 3)
#2 Z:\home\andts\www\application\classes\view\admin\banner\index.php(48): View_Admin_Banner_Index->create_banner(Array, Array)
#3 Z:\home\andts\www\application\classes\controller\auto.php(56): View_Admin_Banner_Index->__construct('admin/banner/in...')
#4 Z:\home\andts\www\application\classes\controller\admin\auto.php(21): Controller_Auto->before()
#5 [internal function]: Controller_Admin_Auto->before()
#6 Z:\home\andts\www\modules\core\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Admin_Banner))
#7 Z:\home\andts\www\modules\core\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 Z:\home\andts\www\modules\core\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 Z:\home\andts\www\index.php(109): Kohana_Request->execute()
#10 {main}