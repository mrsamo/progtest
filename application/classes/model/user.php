<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_User extends Sprig {	
	protected $_table = 'users';
	
	protected function _init()
	{
		$this->_fields += array(
			'id' => new Sprig_Field_Auto,
			'login' => new Sprig_Field_Char,
			'password' => new Sprig_Field_Char,
			'name' => new Sprig_Field_Char,
			'email' => new Sprig_Field_Char,
			'phone' => new Sprig_Field_Char,
			'post' => new Sprig_Field_Char,
			'photo' => new Sprig_Field_Char,
			'delivery_addres' => new Sprig_Field_Char,
			'distributor' => new Sprig_Field_Integer(array(
					'default' => 0,
				)),
			'inn' => new Sprig_Field_Char,
			'company' => new Sprig_Field_Char,
			'city' => new Sprig_Field_Char,
			'legal_address' => new Sprig_Field_Char,
			'contract' => new Sprig_Field_Char,
			'discount' => new Sprig_Field_Integer,
			'confirm_status' => new Sprig_Field_Integer(array(
					'default' => 0,
				)),
			'attache_status' => new Sprig_Field_Integer(array(
					'default' => 0,
				)),
			'last_login' => new Sprig_Field_Timestamp,
			'reg_date' => new Sprig_Field_Timestamp(array(
				'auto_now_create' => true,
			)),
		);
	}

	/* * *
		Функция проверки наличия нужной роли у пользователя
	* * */
	public function has_role($role_name)
	{
		$role = Sprig::factory('role', Array('name' => $role_name))->load();
		if ($role->loaded())
		{
			$role_user = Sprig::factory('roleuser', Array('user_id' => $this->id, 'role_id' => $role->id))->load();
			if ($role_user->loaded())
				return true;
		}
		return false;
	}

	/* * *
		Обновление служебных полей после успешной авторизации
	* * */
	public function complete_login()
	{
		$this->last_login = time();
		$this->update();
	}

	/* * *
		Обновляем функцию создания пользователя
		Добавляем создание записи для присвоения пользователю роли
	* * */
	public function create($role_name = false)
	{
		parent::create();
		
		if (!empty($role_name))
		{
			$role = Sprig::factory('role', Array('name' => $role_name))->load();
			if ($role->loaded())
			{
				$role_user = Sprig::factory('roleuser', Array('user_id' => $this->id, 'role_id' => $role->id));
				$role_user->create();
				if (empty($role_user->user_id))
					$this->delete();
			}
		}
	}
}