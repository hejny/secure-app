<?php
require_once __DIR__.'/common.php';


$todos = array(
    array(
        'title'=> 'aaaaa' 
    )
);

echo(json_encode($todos,JSON_PRETTY_PRINT));
?>