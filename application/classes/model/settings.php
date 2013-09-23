<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Settings extends Sprig {	
	protected $_table = 'settings';
	
	protected function _init()
	{
		$this->_fields += array(
			'id' => new Sprig_Field_Auto,
			'name' => new Sprig_Field_Char,
			'param' => new Sprig_Field_Char,
			'value' => new Sprig_Field_Char,
			'show' => new Sprig_Field_Char,
		);
	}
}