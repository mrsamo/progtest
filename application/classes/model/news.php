<?php defined('SYSPATH') or die('No direct script access.');

class Model_News extends Sprig
{
    protected $_tableArticles = 'news';

    // Правила валидации полей формы
    public function rules()
    {
        return array(

        );
    }

    protected function _init()
    {
        // Notice how the MPTT fields are added automatically
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'title' => new Sprig_Field_Char,
            'date_pub' => new Sprig_Field_Timestamp,
            'short_article' => new Sprig_Field_Text,
            'article' => new Sprig_Field_Char,
            'img' => new Sprig_Field_Char,
            'status' => new Sprig_Field_Integer,
        );
    }
}