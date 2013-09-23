<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Model_Banner extends Sprig {

    protected $_table = 'banners';

    protected function _init()
    {
	$this->_fields += array(
	    'id' => new Sprig_Field_Auto,
	    'type' => new Sprig_Field_Char,
	    'link' => new Sprig_Field_Char,
	    'source' => new Sprig_Field_Char,
	    'width' => new Sprig_Field_Integer,
	    'height' => new Sprig_Field_Integer,
	);
    }

}