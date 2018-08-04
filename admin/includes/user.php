<?php

class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users() {
        $result_set = self::find_this_query("SELECT * FROM users");
        return $result_set;
    }

    public static function find_user_by_id($user_id) {
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

        //$found_user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //return $found_user;
    }

    public static function find_this_query($sql) {
        global $database;
        $the_object_array = array();
        $result_set = $database->query($sql);

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantiation($row);
        }

        return $the_object_array;
    }



    public static function verify_user($username, $password) {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);


        $sql = "SELECT * FROM `users` WHERE `username` = $username AND `password` = $password";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }



    public static function instantiation($found_user) {

        $the_object = new self();

        /**$the_object->id = $found_user['id'];
        $the_object->username = $found_user['username'];
        $the_object->password = $found_user['password'];
        $the_object->first_name = $found_user['first_name'];
        $the_object->last_name = $found_user['last_name'];*/

        foreach ($found_user as $the_attribute => $user_data) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $user_data;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }
}











?>