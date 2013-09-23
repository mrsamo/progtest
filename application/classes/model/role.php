<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Role extends Sprig {	
	protected $_table = 'roles';
	
	protected function _init()
	{
		$this->_fields += array(
			'id' => new Sprig_Field_Auto,
			'name' => new Sprig_Field_Char,
			'description' => new Sprig_Field_Char,
		);
	}
}