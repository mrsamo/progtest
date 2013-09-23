<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Benefits extends Sprig
{

    protected $_table = 'benefits';

    protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'title' => new Sprig_Field_Char,
            'content' => new Sprig_Field_Char,
            'image' => new Sprig_Field_Char,
            'status' => new Sprig_Field_Integer(array(
                'default' => 0,
            )),
        );
    }

}