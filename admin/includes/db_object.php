<?php


class Db_object
{

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');


    public $id;
    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK           => "There is no error.",
        UPLOAD_ERR_INI_SIZE     => "The uploaded file exceeds the upload_max_size directive.",
        UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive.",
        UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE      => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR   => "Missing temporary folder.",
        UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disc.",
        UPLOAD_ERR_EXTENSION    => "A PHP extension stopped file upload.",
    );


    public static function find_all() {
        $result_set = static::find_by_query("SELECT * FROM " . static::$db_table);
        return $result_set;
    }


    public static function find_by_id($id)  {
        global $database;
        $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    public static function find_by_query($sql)
    {
        global $database;
        $the_object_array = array();
        $result_set = $database->query($sql);

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }

        return $the_object_array;
    }


    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }


    public static function instantiation($found_user)
    {

        $calling_class = get_called_class();

        $the_object = new $calling_class();

        foreach ($found_user as $the_attribute => $user_data) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $user_data;
            }
        }

        return $the_object;
    }


    protected function properties()
    {
        //return get_object_vars($this);
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;   //$prop -> asoc. pole, klic -> nazev property objektu, hodnota -> jeji hodnota
            }
        }
        return $properties;
    }


    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }


    /**public function save()
    {
        return (isset($this->id)) ? $this->update() : $this->create();
    }*/


    public function save()  {
        if ($this->id) {
            $this->update();
        } else {

            if (!empty($this->errors)) {
                return false;
            }

            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "File was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

            if (file_exists($target_path)) {
                $this->errors[] = "This file {$this->filename} already exist";
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            }    else {
                $this->errors[] = "The file directory propably does not have permission";
                return false;
            }

        }
    }


    public function create()
    {
        global $database;

        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table;
        $sql .= " (" . implode(', ', array_keys($properties)) . ")";
        $sql .= "VALUES ('" . implode("', '", array_values($properties)) . "')";

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }

    }


    public function update()
    {
        global $database;

        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $property => $value) {
            $properties_pairs[] .= $property . " = '" . $value . "'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", array_values($properties_pairs));
        $sql .= " WHERE id= " . $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;


    }


    public function set_file($file) {

        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here!";
            return false;
        } elseif ($file['error'] !== 0) {
            $this->errors = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = ($file['tmp_name']);
            $this->size = ($file['size']);
            $this->type = ($file['type']);
        }
    }


    // ONLY MY OWN TEST AND IT WORKS
    public static function update_with_params($id, $un, $pass, $fn, $ln)
    {
        global $database;


        $updated_user = new User();
        $updated_user->username = $un;
        $updated_user->password = $pass;
        $updated_user->first_name = $fn;
        $updated_user->last_name = $ln;

        $user = User::find_by_id($id);

        foreach ($updated_user as $item => $value) {
            if ($value) {
                $user->$item = $value;
            }
        }

        $properties = $user->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $property => $value) {
            $properties_pairs[] .= $property . " = '" . $value . "'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", array_values($properties_pairs));
        $sql .= " WHERE id= " . $database->escape_string($id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }


    public function delete()
    {
        global $database;

        $sql = "DELETE FROM " . static::$db_table;
        $sql .= " WHERE id =" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);


        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }


}
?>