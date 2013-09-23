<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Reqviewer extends Sprig
{

    protected $_table = 'reqviewer';

    protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'fio' => new Sprig_Field_Char,
            'phone' => new Sprig_Field_Char,
            'view_date' => new Sprig_Field_Char,
            'view_time' => new Sprig_Field_Char,
            'object_data' => new Sprig_Field_Char,
            'catalog_id' => new Sprig_Field_Integer,
            'comment' => new Sprig_Field_Char,
            'time' => new Sprig_Field_Timestamp(array(
                'auto_now_create' => true,
            )),
        );
    }

}