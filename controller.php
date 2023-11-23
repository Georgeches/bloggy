<?php
    //users
    $users_query = 'SELECT * FROM user';
    $result = mysqli_query($conn, $users_query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //blogs
    $blogs_query = 'SELECT * FROM blog';
    $blog_result = mysqli_query($conn, $blogs_query);
    $blogs = mysqli_fetch_all($blog_result, MYSQLI_ASSOC);
    //bloglikes
    $bloglikes_query = 'SELECT * FROM bloglikes';
    $bloglikes_result = mysqli_query($conn, $bloglikes_query);
    $bloglikes = mysqli_fetch_all($bloglikes_result, MYSQLI_ASSOC);
    //find blog user
    function get_user($id=0){
        global $conn;
        $user_query = "SELECT * FROM user WHERE id = $id;";
        $result = mysqli_query($conn, $user_query);
        $this_user = mysqli_fetch_assoc($result);
        
        if($this_user){
            return $this_user['username'];
        }
        else{
            return "Anonymous";
        }
    }

    function findUserById($id) {
        global $users;
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }

    function new_blog(){
        global $conn, $active_user;
        $title = $_POST['title'];
        $body = $_POST['body'];
        $active_user_id = $active_user['id'];
        $insert_query = "INSERT INTO blog (title, body, user_id) VALUES ('$title', '$body', $active_user_id)";

        if(mysqli_query($conn, $insert_query)){
            header('Location: index.php');
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }

    function new_user(){
        global $conn;

        if(empty($_POST['username'])){
            return 'usernameErr';
        }
        
        if(empty($_POST['password'])){
            return'passwordErr';
        }

        if($_POST['password'] !== $_POST['confirm']){
            return 'confirmErr';
        }

        $username = $_POST['username'];
        $password_input = $_POST['password'];
        //hash password
        $options = [
            'cost' => 12
        ];
        $hashed_password = password_hash($password_input, PASSWORD_BCRYPT, $options);
        //Add user
        $insert_user = "INSERT INTO user (username, userpassword) VALUES ('$username', '$hashed_password')";
        $new_user = mysqli_query($conn, $insert_user);
        if($new_user){
            return 'success';
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }
?>