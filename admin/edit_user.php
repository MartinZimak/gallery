<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>
<?php

if (empty($_GET['id'])) {
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if (isset($_POST['update'])) {

    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    if (!empty($_POST['password'])) {
        $user->password = $_POST['password'];
    }

    /**if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] !== 4) {
        $user->save_image($_FILES['user_image']);
    }*/
    $user->save_user_and_image($_FILES['user_image']);
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
                        Edit User
                        <small></small>
                    </h1>

                    <div class="col-md-6" class="user_image_box">
                        <a href="#" data-toggle="modal" data-target="#photo-library">
                            <img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt="">
                        </a>
                    </div>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">

                            <div class="formgroup">
                                <label for="user_image">User Image</label><br>
                                <input type="file" name="user_image">
                            </div>

                            <div class="formgroup">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                            </div>

                            <div class="formgroup">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="formgroup">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>

                            <div class="formgroup">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div><br>

                            <div class="formgroup">
                                <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger pull-left">Delete</a>
                                <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
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