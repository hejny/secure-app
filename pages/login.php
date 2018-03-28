<?php
if($_REQUEST['username']){

    $password_hash = md5($_REQUEST['password']);

    $query = $db->prepare("SELECT password,id FROM users WHERE username='{$_REQUEST['username']}'");
    $query->execute();
    $result = $query->fetchAll();

    if(count($result)===0){
        echo('<div class="error">User do not exists.</div>');
    }else{
        if($result[0]['password']!==$password_hash){
            echo('<div class="error">Wrong password.</div>');
        }else{
            $_SESSION['id'] = $result[0]['id'];
            echo('<div class="success">Logged in! <a href="?page=wall">Go to your wall.</a></div>');
        }
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

    <button type="submit">Login</button>

  </div>

</form> 