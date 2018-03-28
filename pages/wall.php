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



$query = $db->prepare("SELECT user_id, content FROM posts");
$query->execute();

$result = $query->fetchAll();
foreach($result as $row){
?>
<div class="post">
    <?=$row['content']?>

</div>
<?php
}
?>