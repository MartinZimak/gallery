<?php

class Photo extends Db_object {


    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'caption', 'description', 'filename',
        'alternate_text', 'type', 'size');
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $caption;
    public $alternate_text;




    public function picture_path() {
        return $this->upload_directory . DS . $this->filename;
    }



    public function delete_photo()
    {
       if ($this->delete()) {

           $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
           return unlink($target_path) ? true : false;

       }    else {
           return false;
       }
    }


    public static function display_sidebar_data($photo_id) {
        $photo = Photo::find_by_id($photo_id);

        $output = "<a href='#' class='thumbnail'><img width='100' src='{$photo->picture_path()}' alt=''></a>";
        $output .= "<p>{$photo->filename}</p>";
        $output .= "<p>{$photo->type}</p>";
        $output .= "<p>{$photo->size}</p>";


        echo $output;
    }



}








?>