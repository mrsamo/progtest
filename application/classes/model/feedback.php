<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Feedback extends Sprig
{

    protected $_table = 'feedback';

    protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'fio' => new Sprig_Field_Char,
            'phone' => new Sprig_Field_Char,
            'email' => new Sprig_Field_Char,
            'message' => new Sprig_Field_Char,
            'time' => new Sprig_Field_Timestamp(array(
                'auto_now_create' => true,
            )),
        );
    }

}