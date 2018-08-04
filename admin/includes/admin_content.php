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

                /**$users = User::find_all_users();
                foreach ($users as $user) {
                    echo $user->username . "<br>";
                }*/

                $found_user = User::find_user_by_id(2);
                echo $found_user->username;


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