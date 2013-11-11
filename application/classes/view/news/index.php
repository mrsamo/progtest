<?php

/*
  Отображение для страницы каталога
 */
class View_News_Index extends View_Layout
{
    public $is_content = TRUE;
    public $news=array();


    public function __construct($template = NULL, array $partials = NULL, $alien_call = FALSE)
    {
        $query_filter = DB::select('*')->order_by('date_pub', 'DESC');
        $news_query = Sprig::factory('news')->load($query_filter, NULL);

        for ($i = 0; $i < count($news_query); $i++)
        {
            $this->news[$i] = $news_query[$i]->as_array();

        }

        parent::__construct();
    }

}