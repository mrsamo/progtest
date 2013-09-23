<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Reqbuy extends Sprig
{

    protected $_table = 'reqbuy';

    protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'fio' => new Sprig_Field_Char,
            'phone' => new Sprig_Field_Char,
            'comment' => new Sprig_Field_Char,
            'object_data' => new Sprig_Field_Char,
            'catalog_id' => new Sprig_Field_Integer,
            'time' => new Sprig_Field_Timestamp(array(
                'auto_now_create' => true,
            )),
        );
    }

}