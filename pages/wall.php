<?php
if($_SESSION['id']){

    if($_REQUEST['post']){
        $db->query("INSERT INTO posts (content,user_id) VALUES ('{$_REQUEST['post']}',{$_SESSION['id']})");
    }

?>
<form action="" method="POST">
    <textarea name="post"></textarea>
    <button type="submit">Share!</button>
</form> 
<?php
}



if($_REQUEST['like']){
if($_SESSION['id']){
    try {
        $db->query("INSERT INTO users_posts_like (user_id,post_id) VALUES ({$_SESSION['id']},{$_REQUEST['like']})");
     } catch (PDOException $error) {
        if ($error->errorInfo[1] == 1062) {
            echo('<div class="error">You have already voted.</div>');
        } else {
           throw $error;
        }
     }

    
}else{
    echo('<div class="error">You can like posts only logged in.</div>');
}
}


if($_REQUEST['delete']){
    $db->query("UPDATE posts SET deleted=NOW() WHERE user_id={$_SESSION['id']} AND id={$_REQUEST['delete']}");
}



$query = $db->prepare("SELECT id, user_id, content, created, (SELECT count(1) FROM users_posts_like WHERE users_posts_like.post_id = posts.id) as likes, (SELECT username FROM users WHERE users.id = posts.user_id) as author FROM posts WHERE deleted IS NULL ORDER BY created desc");
$query->execute();

$result = $query->fetchAll();
foreach($result as $row){
?>
<div class="post">
    <div class="content">
        <?=$row['content']?>
    </div>
    <div class="actions">
        <span class="author">
            <?=$row['author']?>
        </span>
        <span class="time">
            <?=$row['created']?>
        </span>

        <?php if($row['likes']){ ?>
        <span class="likes">
            <?=$row['likes']?>👍
        </span>
        <?php } ?>

        <?php if($_SESSION['id']==$row['user_id']){ ?>
            <a href="?page=wall&amp;like=<?=$row['id']?>">Like</a>
            <a href="?page=wall&amp;delete=<?=$row['id']?>" onclick="return confirm('Are you sure?')">Delete</a>
        <?php } ?>
    </div>
</div>
<?php
}
?>