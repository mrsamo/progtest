<?php



class Controller_News extends Controller_Auto
{



    public function action_index()
    {

    }

    public function action_list(){

    }
    // Без валидаторов - что плохо, надо разбираться с валидаторами
    public function action_create(){
        $post = $this->request->post();
        echo $_SERVER['DOCUMENT_ROOT'];
        if(count( $post )>0){
            $model = Sprig::factory('news');

            $file_type = $this->getFileType($_FILES['img']['type']);
            $file_name = uniqid('img_').$file_type;

            Upload::save($_FILES['img'], $file_name, $this->getUploadDir());
            $model->title = $post['title'];
            $model->short_article = $post['short_article'];
            $model->article = $post['article'];
            $model->img = 'img_5280c0d9705d8.jpg';
            $model->status = $post['status'];
            $model->create();

        }
    }

    public function getUploadDir(){
        return $_SERVER['DOCUMENT_ROOT'] . '/images/news/news/';
    }

    public function getFileType($mimeType){
        switch ($mimeType) {
            case "image/jpeg":
                return ".jpg";
                break;
        }

    }
}