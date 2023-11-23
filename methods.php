<?php
    function blog_like($blog_id){
        global $conn;
        $user_id = $_SESSION['active_user'];
        $like_blog = "INSERT INTO bloglikes (user_id, blog_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $like_blog);
        mysqli_stmt_bind_param($stmt, "ii", $user_id,$blog_id);
        $liked = mysqli_stmt_execute($stmt);
        if($liked){
            return 'liked';
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }

    function blog_unlike($blog_id){
        global $conn;
        $user_id = $_SESSION['active_user'];
        $unlike_blog = "DELETE FROM bloglikes WHERE blog_id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $unlike_blog);
        mysqli_stmt_bind_param($stmt, "ii", $blog_id, $user_id);
        $unliked = mysqli_stmt_execute($stmt);
        if($unliked){
            return('unliked');
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }

    function blog_delete($blog_id){
        global $conn;
        $delete_blog = "DELETE FROM blog WHERE blog_id = ?";
        $delete_bloglikes = "DELETE FROM bloglikes WHERE blog_id = ?";
        //stmt for blog
        $stmt = mysqli_prepare($conn, $delete_blog);
        mysqli_stmt_bind_param($stmt, 'i', $blog_id);
        $deleted = mysqli_stmt_execute($stmt);
        //stmt for bloglikes
        $stmt2 = mysqli_prepare($conn, $delete_bloglikes);
        mysqli_stmt_bind_param($stmt2, 'i', $blog_id);
        $deleted2 = mysqli_stmt_execute($stmt2);
        if($deleted && $deleted2){
            return('deleted');
        }
        else{
            throw new Exception(mysqli_error($conn));
        }
    }
    
?>