<?php
require_once 'utilities/blogposts.php';
require_once 'utilities/user.php';

if (!is_user_loggedin()) {
    header("Location: index.php");
    return;
}

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
}

// Call the function to share the post
if (isset($_POST['share'])) {
    share_post($post_id);
    // Increment the share count or perform other actions as needed
}

// Retrieve users who have liked the post
$users = get_users_who_like($post_id);

// Retrieve and display the share count
$share_count = get_share_count($post_id);
?>



//I have already defined the functions like share_post for sharing post() to any one and 
//get_share_count() for counting how much time any particular post is being shared


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css">
    <title>Share Post</title>
</head>

<body>

    <?php include "header.php"; ?>

    <div style="text-align: center">
        <h1>Users who liked the post</h1>
        <?php
        if ($users != null):
            foreach ($users as $user):
                $user_name = $user["user_full_name"];
        ?>
                    <div class="username"><?= $user_name ?></div>
        <?php
            endforeach;
        endif;
        ?>

        <!-- Share count -->
        <div>Share Count: <?= $share_count ?></div>

        <!-- Share button -->
        <form method="post">
            <button type="submit" name="share">Share Post</button>
        </form>
    </div>

</body>

</html>
