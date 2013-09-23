<?php

defined('SYSPATH') OR die('No direct access allowed.');
class Model_Infoblock extends Sprig
{

    protected $_table = 'infoblock';

    protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'name' => new Sprig_Field_Char,
            'content' => new Sprig_Field_Char,
            'wysiwyg' => new Sprig_Field_Integer,
        );
    }

}