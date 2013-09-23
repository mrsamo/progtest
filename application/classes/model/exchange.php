<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Exchange extends Sprig
{

    protected $_table = 'exchange';

    protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'fio' => new Sprig_Field_Char,
            'phone' => new Sprig_Field_Char,
            'object_data_1' => new Sprig_Field_Char,
            'object_data_2' => new Sprig_Field_Char,
            'catalog_id' => new Sprig_Field_Integer,
            'time' => new Sprig_Field_Timestamp(array(
                'auto_now_create' => true,
            )),
        );
    }

}