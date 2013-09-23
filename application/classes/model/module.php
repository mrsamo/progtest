<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Module extends Sprig {	
	protected $_table = 'modules';
	
	protected function _init()
	{
		$this->_fields += array(
			'mid' => new Sprig_Field_Auto,
			'name' => new Sprig_Field_Char,
		);
	}
}