<?php include './header.php' ?>

<?php
    $passwordErr = '';
    $usernameErr = '';
    $confirmErr = '';
    $message = '';
    if(isset($_POST['signup_submit'])){
        try{
            $response = new_user();
            if($response === 'usernameErr') {
                $usernameErr = 'username is required';
            } elseif($response === 'passwordErr'){
                $passwordErr = 'password is required';
            } else if($response === 'confirmErr'){
                $confirmErr = 'Passwords do not match';
            } else{
                $message = 'Account created you can now log in';
                header('Location: login.php');
            }
        }
        catch(Exception $e){
            echo "hello";
            echo "$e";
        }
    }
?>

<div class="new-user container d-flex justify-content-center">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="w-50 h-100 mt-5 border p-5 rounded" method="post">
        <label for="username" class="form-label">Username:</label>
        <input type="text" class="form-control" name="username" id="input-username">
        <?php if($usernameErr !== ''): ?>
            <p class="text-danger"><?php echo $usernameErr ?></p>
        <?php endif ?>
        <label for="password" class="form-label mt-3">Password:</label>
        <input type="password" class="form-control" name="password" id="input-password">
        <?php if($passwordErr !== ''): ?>
            <p class="text-danger"><?php echo $passwordErr ?></p>
        <?php endif ?>
        <label for="passwordConfirm" class="form-label mt-3">Confirm password:</label>
        <input type="password" class="form-control" name="confirm" id="input-confirm">
        <?php if($confirmErr !== ''): ?>
            <p class="text-danger"><?php echo $confirmErr ?></p>
        <?php endif ?>
        <input type="submit" class="btn btn-success mt-3" name="signup_submit" value="Sign up">
    </form>
</div>