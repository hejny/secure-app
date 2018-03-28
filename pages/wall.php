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
    $db->query("INSERT INTO users_posts_like (user_id,post_id) VALUES ({$_SESSION['id']},{$_REQUEST['like']})");
}else{
    echo('You can like posts only after log in.');
}
}



$query = $db->prepare("SELECT id, user_id, content, (SELECT count(1) FROM users_posts_like WHERE users_posts_like.post_id = posts.id) as likes FROM posts");
$query->execute();

$result = $query->fetchAll();
foreach($result as $row){
?>
<div class="post">
    <?=$row['content']?>

    <a href="?page=wall&amp;like=<?=$row['id']?>">Like (<?=$row['likes']?>)</a>

</div>
<?php
}
?>