<?php
require_once ("db_object.php");


class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $image_placeholder = "http://placehold.it/400x400&text=image";




    public function image_path_and_placeholder() {

        return empty($this->user_image) ? $this->image_placeholder : $this->picture_path();

    }



    public function picture_path() {
        return $this->upload_directory . DS . $this->user_image;
    }




    public static function verify_user($username, $password) {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);


        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql.= "username = '$username' AND ";
        $sql.= "password = '$password' ";
        $sql .="LIMIT 1";

        $the_result_array = User::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : /**false*/ $sql;

    }




    public function delete_user()
    {
        if ($this->delete()) {

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
            return unlink($target_path) ? true : false;

        }    else {
            return false;
        }
    }



    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here!";
            return false;
        } elseif ($file['error'] !== 0) {
            $this->errors = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = ($file['tmp_name']);
        }
    }
    

    /**public function save_image($file) {
        $this->set_file($file);
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
        move_uploaded_file($this->tmp_path, $target_path);
        unset($this->tmp_path);
    }*/
    

    public function save_user_and_image($file)  {
        if ($this->id) {
            $this->update($file);
        } else {

            if (!empty($this->errors)) {
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            move_uploaded_file($this->tmp_path, $target_path);
            if ($this->create()) {
                unset($this->tmp_path);
                return true;
            }
        }
    }



    public function ajax_save_user_image($user_image, $user_id) {

        $this->user_image = $user_image;
        $this->id = $user_id;
        $this->save(null);

        echo $this->image_path_and_placeholder();

    }


}   //End of class User











?>