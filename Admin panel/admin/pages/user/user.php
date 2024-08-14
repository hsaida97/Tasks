<?php
$modelFile =  '../../model/Models/User.php';
require_once $modelFile;
$user = new User();
$action = @$_GET['action'] ?? null;



if(is_null($action)){
    require_once __DIR__.'./users.php';
}elseif($action=='edit'){
    require_once __DIR__.'./user-edit.php';
}elseif($action=='delete'){
    require_once __DIR__.'./user-delete.php';
}


?>



