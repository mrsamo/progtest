<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Reqbuysell extends Sprig
{

    protected $_table = 'reqbuysell';

    protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'fio' => new Sprig_Field_Char,
            'phone' => new Sprig_Field_Char,
            'offer_type' => new Sprig_Field_Char,
            'object_type' => new Sprig_Field_Char,
            'object_data' => new Sprig_Field_Char,
            'time' => new Sprig_Field_Timestamp(array(
                'auto_now_create' => true,
            )),
        );
    }

}