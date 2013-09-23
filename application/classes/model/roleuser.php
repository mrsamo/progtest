<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_RoleUser extends Sprig {	
	protected $_table = 'roles_users';
	
	protected function _init()
	{
		$this->_fields += array(
			'user_id' => new Sprig_Field_Integer,
			'role_id' => new Sprig_Field_Integer,
		);
	}
}