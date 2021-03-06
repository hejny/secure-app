
<?php
error_reporting(E_ALL ^ E_NOTICE); 
require_once __DIR__.'/config.php'; 
require_once __DIR__.'/common/db.php';
session_start();

if($_REQUEST['action']=='logout'){
    unset($_SESSION['id']);
}
?>
<!DOCTYPE html>
<html lang="cs" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Super secure social network</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>   
    <nav>
        <a href="?page=wall"><h1>👍 "Super secure" social network</h1></a>
        <ul>
            <?php if(!$_SESSION['id']){ ?>
            <a href="?page=login"><li>Login</li></a>
            <a href="?page=register"><li>Register</li></a>
            <?php }else{ ?>
            <a href="?action=logout"><li>Logout</li></a>
            <?php } ?>
        </ul>
    </nav>
    <main>
    <?php
        $pagefile = __DIR__."/pages/{$_GET['page']}.php";

        if(!file_exists($pagefile)){
            $pagefile = __DIR__."/pages/wall.php";
        }
    
        require $pagefile;
    
    ?>
    </main>
</body>
</html>

