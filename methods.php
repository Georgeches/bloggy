<?php
    function blog_like($blog_id){
        global $conn;
        $user_id = $_SESSION['active_user'];
        $like_blog = "INSERT INTO bloglikes (user_id, blog_id) VALUES (?, ?)";
        $liked = mysqli_query($conn, $like_blog);
        if($liked){
            return('liked');
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }

    function blog_unlike($blog_id){
        global $conn;
        $user_id = $_SESSION['active_user'];
        $like_blog = "DELETE FROM bloglikes WHERE blog_id = $blog_id AND user_id = $user_id";
        $deleted = mysqli_query($conn, $like_blog);
        if($deleted){
            return('deleted');
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }

    function blog_delete($blog_id){
        global $conn;
        $like_blog = "DELETE FROM blog WHERE blog_id = $blog_id";
        $deleted = mysqli_query($conn, $like_blog);
        if($deleted){
            return('deleted');
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }
    
?>