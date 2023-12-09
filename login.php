<?php include './header.php' ?>

<?php
    $passErr = '';
    $nameErr = '';
    if(isset($_POST['login_submit'])){
        $login_username = filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $login_password = filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(empty($login_password)){
            $passErr = 'Password is required';
        }
        if(empty($login_username)){
            $nameErr = 'Username is required';
        }

        if($passErr === '' && $nameErr === ''){
            $user_query = "SELECT * FROM user WHERE username = ?";
            $stmt = mysqli_prepare($conn, $user_query);
            mysqli_stmt_bind_param($stmt, 's', $login_username);
            mysqli_stmt_execute($stmt);
            $user_result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($user_result) > 0){
                $user_found = mysqli_fetch_assoc($user_result);
                if(password_verify($login_password, $user_found['userpassword'])){
                    $_SESSION['active_user'] = $user_found['id'];
                    if(isset($_SESSION['active_user'])){
                        header('Location: index.php');
                        exit();
                    }
                }
                else{
                    $passErr = 'Incorrect password';
                }
            }
            else{
                $nameErr = 'Username does not exist';
            }
        }
    }
?>

<div class="login-user container d-flex justify-content-center">
    <?php if($message !== ''): ?>
        <div class="success-message">
            <p class="lead text-white"><?php echo $message ?></p>
        </div>
    <?php endif ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="w-50 h-100 mt-5 border p-5 rounded" method="post">
        <label for="username" class="form-label">Username:</label>
        <input type="text" class="form-control" name="login_username" id="input-username">
        <?php if($nameErr !== ''): ?>
            <p class="text-danger"><?php echo $nameErr ?></p>
        <?php endif ?>
        <label for="password" class="form-label mt-3">Password:</label>
        <input type="password" class="form-control" name="login_password" id="input-password">
        <?php if($passErr !== ''): ?>
            <p class="text-danger"><?php echo $passErr ?></p>
        <?php endif ?>
        <input type="submit" class="btn btn-success mt-3" name="login_submit" value="Sign up">
    </form>
</div>