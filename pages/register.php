<?php
if($_REQUEST['username']){
    if($_REQUEST['password']!==$_REQUEST['password_again']){
        echo('Passwords must be same.');
    }else{
        $password_hash = md5($_REQUEST['password']);
        $db->query("INSERT INTO users (username,password) VALUES ('{$_REQUEST['username']}','$password_hash')");
        $_SESSION['id'] = $db->lastInsertId();
        die('Registered! <a href="?page=wall">Go to your wall.</a>');
    }
}
?>
<form action="" method="POST">

    <label>
        Username:
        <input type="text" name="username" required>
    </label>

    <label>
        Password:
        <input type="text" name="password" required>
    </label>

    <label>
        Password again:
        <input type="text" name="password_again" required>
    </label>

    <button type="submit">Register</button>

  </div>

</form> 