<?php include('./header.php') ?>
<div class="body container mt-5">
    <div class="body-header">
            <?php if($active_user === ''): ?>
                <h1>Welcome to Bloggy</h1>
            <?php else: ?>
                <?php echo '<h1>Hello '.$active_user['username'].'</h1>'?>
            <?php endif ?>
    </div>
    <hr/>
    <?php if($active_user !== ''): ?>
        <a href='newblog.php' style='cursor: pointer;' class='btn btn-success'>+ New blog</a>
    <?php endif ?>
    <div class="blogs mt-3 d-flex flex-wrap">
        <?php if(!empty($blogs)): ?>
            <?php foreach($blogs as $blog): ?>
                <div class="card blog-card ms-0 m-3 border-1" style="width: 360px; height: auto;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $blog['title'] ?></h5>
                        <hr/>
                        <p class="card-text"><?php echo $blog['body'] ?></p>
                    </div>
                    <div class="card-footer mt-3 ms-3 d-flex justify-content-between">
                        <div class="card-footer-left">
                            <p class="lead">By <?php echo get_user($blog['user_id'])?></p>
                            <p><?php echo $blog['date'] ?></p>
                        </div>
                        <div class="card-footer-right">
                            <?php if(isset($_SESSION['active_user'])): ?>
                                <?php if($blog['user_id'] != $_SESSION['active_user']): ?>
                                    <?php if(empty(array_filter($bloglikes, function($bloglike) use($blog){
                                        return $bloglike['blog_id'] == $blog['id'] && $bloglike['user_id'] == $_SESSION['active_user'];
                                    }))): ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                            <input type="hidden" name="blog_id_like" value="<?php echo $blog['id'] ?>">
                                            <button type="submit" name="like-submit" class="btn btn-link">
                                                <i class="bi bi-heart text-danger"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                            <input type="hidden" name="blog_id_unlike" value="<?php echo $blog['id'] ?>">
                                            <button type="submit" name="unlike-submit" class="btn btn-link">
                                                <i class="bi bi-heart-fill text-danger"></i>
                                            </button>
                                        </form>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if($blog['user_id'] == $_SESSION['active_user']): ?>
                                    <input type="hidden" name="blog_id_delete" value="<?php echo $blog['id'] ?>">
                                    <button type="submit" name="delete-submit" class="btn btn-link">
                                        <i class="bi bi-trash3-fill text-danger"></i>
                                    </button>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <p class="lead">There are no blogs.</p>
        <?php endif; ?>
    </div>
</div>
<?php include('./footer.php') ?>