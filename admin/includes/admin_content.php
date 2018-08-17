<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

            <?php
                /**$result_set = User::find_all_users();
                while ($row = mysqli_fetch_array($result_set)) {
                    echo $row['username'] . "<br>";
                }*/

               /** $found_user = User::find_user_by_id(1);
                $the_object = User::instantiation($found_user);
                foreach ($the_object as $key => $user_data) {
                    if ($key !== 'password') {
                        echo $user_data . "<br>";
                    }
                }*/
                //============================================================================
                /**$users = User::find_all_users();
                foreach ($users as $user) {
                    echo $user->username . "<br>";
                }*/
                //============================================================================
                //$found_user = User::find_user_by_id(2);
                //echo $_SESSION['user_id'];

                //NEW USER====================================================================
                /**$user = new User();
                $user->username = "test of abstract";
                $user->password = "Example_password";
                $user->first_name = "John";
                $user->last_name = "Doe";

                $user->create();*/

                /**if ($user->create()) {
                    foreach ($user as $value) {
                        echo $value . "<br>";
                    }
                }   else {
                    echo "Something's wrong!";
                }*/

                //USER UPDATING===============================================================
                /**$updated_user = User::find_by_id(3);
                $updated_user->username = "Next New Karel";
                $updated_user->password = "New Karel";
                $updated_user->save();*/



                //User::update_with_params(7, "", "somepass", "", "");

                //DELETE USER=================================================================
                //$photo = new Photo();
                //$photo = Photo::find_by_id(4);
                //$photo->delete();


                //FIND PHOTOS=================================================================
            /**$photos = Photo::find_all();
            foreach ($photos as $photo) {
                echo $photo->title . "<br>";
            }*/




                //METHOD "save()"=============================================================
            //$user = User::find_user_by_id(7);
            //$user->password = "heslo";
            //$user->save();

            /**$next_photo = new Photo();
            $next_photo->title = "next";
            $next_photo->description = "justpass";
            $next_photo->filename = "next.jpg";
            $next_photo->type = "iamge";
            $next_photo->size = 15;
            $next_photo->save();*/

            $photo = Photo::find_by_id(9);
            print_r($photo);






             ?>

            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->