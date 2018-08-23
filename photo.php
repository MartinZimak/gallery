<?php include("includes/header.php"); ?>
<?php
require ("admin/includes/init.php");


if (!$session->is_signed_in()) {redirect("admin/login.php");}
if (empty($_GET['id'])) {redirect("index.php");}
$message = "";
$author = User::find_by_id($session->user_id);
$photo = Photo::find_by_id($_GET['id']);

$input = $author->username;


if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    $comment = Comment::create_comment($photo->id, $author, $body);
    if ($comment) {
        $comment->save_comment();
        redirect("photo.php?id=$photo->id");
    }   else {
        $message = "there was some problems saving";
    }
}   else {
    $author = "";
    $body = "";
}

$comments = Comment::find_the_comments($photo->id);

?>
<div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo ($photo->title !== "") ? $photo->title : "Photo " . $photo->id; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Author</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo ($photo->caption !== "") ? $photo->caption : "No Caption"; ?></p>
                <p><?php echo ($photo->description !== "") ? $photo->description : "No Description"; ?></p>

                <hr>

                <!-- Blog Comments -->






                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo $input; ?>">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>







                <hr>

                <!-- Posted Comments -->





                <!-- Comment -->


                <?php foreach ($comments as $comment):?>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="user_image" src="" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author ?>
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        <?php echo $comment->body ?>
                    </div>
                </div>

                <?php endforeach; ?>






            </div>

<!-- Blog Sidebar Widgets Column -->
<!--<div class="col-md-4"> -->


    <?php //include("includes/sidebar.php"); ?>



<!--</div> -->
<!-- /.row -->
</div>
<?php include("includes/footer.php"); ?>

