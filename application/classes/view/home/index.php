<?php

/*
  Вид для контроллера home, действия index
 */
class View_Home_Index extends View_Layout
{

    public $index_page;
    public $is_front = TRUE;

    // Метки для блока преимущества
    public $banners_front = array();
    public $banners_front_count = 2;
    // Горячие предложения Бизнес
    public $hot_business = FALSE;
    // Горящие предложения Недвижимость
    public $hot_country = array();
    public $hot_country_exists = FALSE;
    public $hot_country_over3 = FALSE;
    
    public $hot_city = array();
    public $hot_city_exists = FALSE;
    public $hot_city_over3 = FALSE;
    
    public $hot_commercial = array(); 
    public $hot_commercial_exists = FALSE;
    public $hot_commercial_over3 = FALSE;

    /*
     * Обновляем конструктор
     */
    public function __construct()
    {
        parent::__construct();

        // Выбираем горячие предложения из всех 4 каталогов
        // country
        $hot_countryO = Sprig::factory('catalog')->load(DB::select('*')->where('scope', '=', 1)->where('status', '=', 1)->where('hot_status', '=', 1)->order_by(NULL, 'RAND()'), NULL);
        for ($i = 0; $i < count($hot_countryO); $i++)
        {
            $this->hot_country[$i] = $hot_countryO[$i]->as_array();
            $this->hot_country_exists = TRUE;
            if ($i > 2)
                $this->hot_country_over3 = TRUE;
        }

        // city
        $hot_cityO = Sprig::factory('catalog')->load(DB::select('*')->where('scope', '=', 2)->where('status', '=', 1)->where('hot_status', '=', 1)->order_by(NULL, 'RAND()'), NULL);
        for ($i = 0; $i < count($hot_cityO); $i++)
        {
            $this->hot_city[$i] = $hot_cityO[$i]->as_array();
            $this->hot_city_exists = TRUE;
            if ($i > 2)
                $this->hot_city_over3 = TRUE;
        }
        
        // commercial
        $hot_commercialO = Sprig::factory('catalog')->load(DB::select('*')->where('scope', '=', 3)->where('status', '=', 1)->where('hot_status', '=', 1)->order_by(NULL, 'RAND()'), NULL);
        for ($i = 0; $i < count($hot_commercialO); $i++)
        {
            $this->hot_commercial[$i] = $hot_commercialO[$i]->as_array();
            $this->hot_commercial_exists = TRUE;
            if ($i > 2)
                $this->hot_commercial_over3 = TRUE;
        }
        
        // bisuness
        $hot_businessO = Sprig::factory('catalog')->load(DB::select('*')->where('scope', '=', 4)->where('status', '=', 1)->where('hot_status', '=', 1)->order_by(NULL, 'RAND()'), 1);
        $hot_business = $hot_businessO->as_array();
        if (!empty($hot_business['id']))
            $this->hot_business = $hot_business;

        // Вытаскиваем мета-тэги и контент из страницы с вербальным путем index (пока как-то так)
        $this->index_page = Sprig::factory('content', Array('url' => 'index'))->load();
        $this->index_text = $this->index_page->content;

        // Регистрируем мета-тэги
        $this->title = $this->index_page->meta_title;
        $this->description = $this->index_page->meta_description;
        $this->keywords = $this->index_page->meta_keywords;
    }

}