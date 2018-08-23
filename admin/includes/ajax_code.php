<?php
require("init.php");



if (isset($_POST['image_name'])) {
    $user = User::find_by_id($_POST['user_id']);
    $user->ajax_save_user_image($_POST['image_name'], $_POST['user_id']);
}

if (isset($_POST['photo_id'])) {
    Photo::display_sidebar_data($_POST['photo_id']);

}

?>