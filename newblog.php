<?php include './header.php' ?>

<?php
    if(isset($_POST['submit'])){
        try{
            new_blog();
        }
        catch(Exception $e){
            echo $e;
        }
    }
?>

<div class="new-blog container">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="w-50 mt-5" method="post">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" name="title" id="input-title">
        <label for="body" class="form-label mt-3">Content:</label>
        <textarea name="body" class="form-control" id="input-body" cols="30" rows="10"></textarea>
        <input type="submit" class="btn btn-success mt-2" name="submit" value="Submit">
    </form>
</div>