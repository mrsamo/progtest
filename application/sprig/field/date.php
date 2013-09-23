<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Sprig date field.
 *
 * @package    Sprig
 * @author     Alex
 * @copyright  (c) 2012 Alex
 * @license    MIT
 */
//correct implementation working properly with mysql date
class Sprig_Field_Date extends Sprig_Field_Char {
 
    public $auto_now_create = FALSE;
    public $auto_now_update = FALSE;
    public $default = NULL;
    public $format = 'Y-m-d G:i:s';
    public $_format = 'Y-m-d G:i:s';
    public $mysql_time = TRUE; //Use mysql timestamp or timestamp of PHP
 
    public function value($value) {
        if (TRUE === $this->mysql_time) {
            if (is_integer($value)) {
                return date($this->_format, $value);
            } else {
                return date($this->_format, strtotime($value));
            }
        }
         
        if ($value AND is_string($value) AND !ctype_digit($value)) {
            $value = strtotime($value);
        }
 
        return parent::value($value);
    }
 
    public function verbose($value) {
        if (is_integer($value)) {
            return date($this->format, $value);
        } else {
            return $value;
        }
    }
 
}
