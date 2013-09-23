<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Catalog extends Sprig_MPTT
{

    protected $_table = 'catalog';

    protected function _init()
    {
        // Notice how the MPTT fields are added automatically
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'name' => new Sprig_Field_Char,
            'content' => new Sprig_Field_Char,
            'map' => new Sprig_Field_Char,
            'data' => new Sprig_Field_Char,
            'price' => new Sprig_Field_Float,
            'city' => new Sprig_Field_Char,
            'street' => new Sprig_Field_Char,
            'tract' => new Sprig_Field_Char,
            'house' => new Sprig_Field_Char,
            'corps' => new Sprig_Field_Char,
            'floor' => new Sprig_Field_Integer,
            'floors' => new Sprig_Field_Integer,
            'square' => new Sprig_Field_Float,
            'square_2' => new Sprig_Field_Float,
            'rooms' => new Sprig_Field_Integer,
            'image' => new Sprig_Field_Char,
            'virtour' => new Sprig_Field_Char,
            'hot_status' => new Sprig_Field_Integer(array(
                'default' => 0,
            )),
            'hypothec_status' => new Sprig_Field_Integer(array(
                'default' => 0,
            )),
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