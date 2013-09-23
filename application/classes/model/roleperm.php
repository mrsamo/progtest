<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Roleperm extends Sprig {	
	protected $_table = 'roles_perms';
	
	protected function _init()
	{
		$this->_fields += array(
			'module_id' => new Sprig_Field_Integer,
			'role_id' => new Sprig_Field_Integer,
			'permission' => new Sprig_Field_Integer,
		);
	}
}