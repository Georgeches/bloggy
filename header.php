<?php include './config/database.php'; ?>
<?php include './controller.php' ?>
<?php include './methods.php' ?>
<?php 
    session_start();
    $active_user = '';
    $user_blogs = '';
    $error = '';
    if(isset($_SESSION['active_user'])){
        $active_user = findUserById($_SESSION['active_user']);
        $user_blogs = array_filter($blogs, function($blog){
            return $blog['user_id'] === $_SESSION['active_user'];
        });
    }
    if(isset($_POST['like_submit'])){
        try{
            blog_like($_POST['blog_id_like']);
        }
        catch(Exception $e){
            $error = $e;
        }
    }
    if(isset($_POST['unlike_submit'])){
        try{
            blog_unlike($_POST['blog_id_unlike']);
        }
        catch(Exception $e){
            $error = $e;
        }
    }
    if(isset($_POST['delete_submit'])){
        try{
            blog_delete($_POST['blog_id_delete']);
        }
        catch(Exception $e){
            $error = $e;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <div class="header container-fluid bg-light">
        <nav class="navbar navbar-light bg-light justify-content-between container">
        <a class="navbar-brand text-warning" href="index.php"> <p class="display-6 mt-2 fw-bolder">Bloggy</p></a>
        <div class="right">
            <?php if($active_user === ''): ?>
                <a href="newuser.php" class="btn btn-outline-success">Sign up</a>
                <a href="login.php" class="btn btn-success">Login</a>
            <?php else: ?>
                <a href="logout.php" class="btn btn-outline-danger">Log out</a>
            <?php endif ?>
        </div>
        </nav>
    </div>