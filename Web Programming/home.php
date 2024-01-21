<?php
require_once 'utilities/blogposts.php';
require_once 'utilities/user.php';

	if (!is_user_loggedin()) {
		header("Location: index.php");
		return;
	}

	$blogposts = get_all_posts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>

    <?php include "header.php"; ?>

    <div style="text-align: center">
        <h1>This is home page</h1>
        <?php
        if ($blogposts != null):
            foreach ($blogposts as $blogpost):
                $author = $blogpost["user_full_name"];
                $post_id = $blogpost["post_id"];
                $post_title = $blogpost["post_title"];
                $post_body = $blogpost["post_body"];
                $likes = $blogpost["likes"];
                $reads = $blogpost["_reads"];
                $post_date = $blogpost["post_date"]; // String object
                $post_date = date_create($post_date); // DateTime object
                $post_date = date_format($post_date, "jS, F, Y.");
                $post_share = $blogpost["share_count"]; // Added the post_share variable
        ?>
                <section class="blogpost">
                    <div class="blogtitle"><?= $post_title ?></div>
                    <div class="blogauthor">By <?= $author ?></div>
                    <div><?= $post_body ?>. <a href="post.php?id=<?= $post_id ?>">Read more...</a></div>
                    <div class="blogpostfooter">
                        <!-- Like button -->
                        <?php if ($likes > 0) : ?>
                            <a href="postlikes.php?id=<?= $post_id ?>">
                            <?php endif; ?>
                            <span class="blogdate"><small><i class="count"><?= $likes ?></i> people like the blog.</small></span>
                            <?php if ($likes > 0) : ?>
                            </a>
                        <?php endif; ?>

                        <!-- Read button -->
                        <?php if ($reads > 0) : ?>
                            <a href="postreads.php?id=<?= $post_id ?>">
                            <?php endif; ?>
                            <span class="blogdate"><small><i class="count"><?= $reads ?></i> people have read the blog.</small></span>
                            <?php if ($reads > 0) : ?>
                            </a>
                        <?php endif; ?>

                        <!-- Share button (Replace # with actual share functionality) -->
                        <a href="#" class="share-button" onclick="sharePost(<?= $post_id ?>)">Share</a>

                        <!-- Display share count -->
                        <span id="shareCount<?= $post_id ?>" class="blogdate"><small><i class="count"><?= $post_share ?></i> people have shared the blog.</small></span>

                        <div class="blogdate"><small>Posted on: <?= $post_date ?></small></div>
                    </div>
                </section>
        <?php
            endforeach;
        endif;
        ?>
    </div>

    <script>
        // Example function for sharing post
        function sharePost(postId) {
            // Replace this with your actual share functionality, for example, an AJAX call to update the share count
            alert('Post shared!');
            updateShareCount(postId);
        }

        // Example function for updating the share count (replace with your actual logic)
        function updateShareCount(postId) {
            // Replace this with your actual logic to get the updated share count from the server
            // For demonstration, let's assume a variable `newShareCount` contains the updated count
            var newShareCount = getShareCountFromServer(postId);
            
            // Update the UI with the new share count
            document.getElementById('shareCount' + postId).innerHTML = '<small><i class="count">' + newShareCount + '</i> people have shared the blog.</small>';
        }

        // Example function to simulate getting the share count from the server (replace with actual AJAX call)
        function getShareCountFromServer(postId) {
            // Replace this with your actual AJAX call to get the share count from the server
            // For demonstration, let's return a random number as the new share count
            return Math.floor(Math.random() * 100);
        }
    </script>
</body>

</html>
