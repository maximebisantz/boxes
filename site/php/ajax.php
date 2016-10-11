<?php 

include 'mysqlConnect.php';

$connection = new MysqlConnect();

if(isset($_GET['id'])){
    echo $connection->getBoxContent($_GET['id']);
}

if(isset($_GET['getallboxes'])){
    echo $connection->getAllBoxes();
}

if(isset($_GET['save'])){
    $boxid = $_POST['boxid'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    
    if($boxid == null || !$text || !$title){
        die('{"'. $boxid . '" : "You must fill all fields"}');
    }else{
        echo $connection->setBoxContent($boxid, $title, $text);
    };
}

if(isset($_GET['getboxid'])){
    echo $connection->getBoxContent($_GET['getboxid']);
}

if(isset($_GET['delete'])){
    echo $connection->deleteBox($_POST["boxid"]);
}

?>