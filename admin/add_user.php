<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>
<?php
//$photos = Photo::find_all();
$message = "";


    if (isset($_POST['submit'])) {

        $user = new User();
        //$user->set_file($_FILES['user_image']);
        //$user->user_image =
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] !== 4) {
            $file = $user->set_file($_FILES['user_image']);
        }
        print_r($_FILES['user_image']);
        $user->save_user_and_image();



    }



?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->

        <?php include("includes/top_nav.php"); ?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

        <?php include("includes/side_nav.php"); ?>

        <!-- /.navbar-collapse -->
    </nav>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add User
                        <small>Subheading</small>
                    </h1>


                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3">

                            <div class="formgroup">
                                <label for="user_image">User Image</label>
                                <input type="file" name="user_image">
                            </div>

                            <div class="formgroup">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>

                            <div class="formgroup">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="formgroup">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="formgroup">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="formgroup">
                                <input type="submit" name="submit" class="btn btn-primary pull-right">
                            </div>

                        </div>



                    </form>





                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->


    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>