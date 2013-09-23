<?php

defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Modified Preorder Tree Traversal Class.
 * 
 * Ported from Sprig_MPTT originally by Matthew Davies and Kiall Mac Innes
 *
 * @package Sprig_MPTT
 * @author Mathew Davies
 * @author Kiall Mac Innes
 * @author Paul Banks
 */
abstract class Sprig_MPTT_MOD extends Sprig_MPTT
{
    /**
     * Returns the children of the current node.
     *
     * @access public
     * @param bool $self include the current loaded node?
     * @param string $direction direction to order the left column by.
     * @param array $where additional where clause
     * @return Sprig_MPTT_MOD
     */
    public function children($self = FALSE, $direction = 'ASC', $limit = FALSE, $where = FALSE)
    {
        return $this->descendants($self, $direction, TRUE, FALSE, $limit, $where);
    }

    /**
     * Returns the descendants of the current node.
     *
     * @access public
     * @param bool $self include the current loaded node?
     * @param string $direction direction to order the left column by.
     * @param array $where additional where clause
     * @return Sprig_MPTT_MOD
     */
    public function descendants($self = FALSE, $direction = 'ASC', $direct_children_only = FALSE, $leaves_only = FALSE, $limit = FALSE, $where = FALSE)
    {var_dump($val[0], $val[1], $val_2);
        $left_operator = $self ? '>=' : '>';
        $right_operator = $self ? '<=' : '<';

        $query = DB::select()
                ->where($this->left_column, $left_operator, $this->{$this->left_column})
                ->where($this->right_column, $right_operator, $this->{$this->right_column})
                ->where($this->scope_column, '=', $this->{$this->scope_column})
                ->order_by('ord', $direction);

        if ($direct_children_only)
        {
            if ($self)
            {
                $query
                        ->and_where_open()
                        ->where($this->level_column, '=', $this->{$this->level_column})
                        ->or_where($this->level_column, '=', $this->{$this->level_column} + 1)
                        ->and_where_close();
            }
            else
            {
                $query->where($this->level_column, '=', $this->{$this->level_column} + 1);
            }
        }

        if ($leaves_only)
        {
            $query->where($this->right_column, '=', new Database_Expression('`' . $this->left_column . '` + 1'));
        }

        if ($where)
        {
            foreach ($where as $key => $val)
            {
                $val_2 = isset($val[3]) && $val[3] ? DB::expr($val[2]) : $val[2];
                var_dump($val[0], $val[1], $val_2);
                $query->where($val[0], $val[1], $val_2);
            }
        }

        return Sprig_MPTT_MOD::factory($this->_model)->load($query, $limit);
    }

}