<?php
if($_REQUEST['username']){
    if($_REQUEST['password']!==$_REQUEST['password_again']){
        echo('<div class="error">Passwords must be same.</div>');
    }else{
        $password_hash = md5($_REQUEST['password']);


        try {
            
            $db->query("INSERT INTO users (username,password) VALUES ('{$_REQUEST['username']}','$password_hash')");
            $_SESSION['id'] = $db->lastInsertId();
            echo('<div class="success">Registered! <a href="?page=wall">Go to your wall.</a></div>');


            } catch (PDOException $error) {
            if ($error->errorInfo[1] == 1062) {
                echo('<div class="error">Username is taken.</div>');
            } else {
               throw $error;
            }
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

    <label>
        Password again:
        <input type="text" name="password_again" required>
    </label>

    <button type="submit">Register</button>

  </div>

</form> 