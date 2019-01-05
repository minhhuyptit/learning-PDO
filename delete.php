<?php
    include_once 'define.php';
    include_once 'autoload.php';

    $db = new Database();
    if(!empty($_GET['id'])){
        $exc = $db->delete(array($_GET['id']));
        Session::set('alert', 'There are ' .$exc->rowCount() . ' items that have deleted');
    }
    header('Location: index.php');
?>