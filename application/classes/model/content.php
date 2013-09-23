<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Content extends Sprig_MPTT
{

    protected $_table = 'content';

    protected function _init()
    {
        // Notice how the MPTT fields are added automatically
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'name' => new Sprig_Field_Char,
            'brief' => new Sprig_Field_Char,
            'content' => new Sprig_Field_Char,
            'module_id' => new Sprig_Field_Integer,
            'url' => new Sprig_Field_Char,
            'meta_title' => new Sprig_Field_Char,
            'meta_keywords' => new Sprig_Field_Char,
            'meta_description' => new Sprig_Field_Char,
            'ord' => new Sprig_Field_Integer(array(
                'default' => 10,
            )),
            'status' => new Sprig_Field_Integer(array(
                'default' => 0,
            )),
        );
    }

}