<?php

include_once 'define.php';
include_once 'autoload.php';

$db = new Database();

if (!empty($_POST)) {
    $queryAction = '';
    $Ids = $_POST['cid'] ?? null;
    $where = $db->createWhereDeleteSQL($Ids);
    switch ($_POST['action']) {
        case 'active':
            $queryAction = "UPDATE ".DB_TABLE. " SET `status` = 'active' WHERE `id` IN($where)";
            $exc = $db->execute($queryAction);
            Session::set('alert', 'There ' .$exc->rowCount() . ' items that have changed status');
            break;
        case 'inactive':
            $queryAction = "UPDATE ".DB_TABLE. " SET `status` = 'inactive' WHERE `id` IN($where)";
            $exc = $db->execute($queryAction);
            Session::set('alert', 'There ' .$exc->rowCount(). ' items that have changed status');
            break;
        case 'ordering':
            $count = 0;
            foreach($_POST['ordering'] as $key => $val){
                $queryAction = "UPDATE ".DB_TABLE. " SET `ordering` = '$val' WHERE `id` = $key";
                $exc = $db->execute($queryAction);
                $count += $exc->rowCount();
            }
            Session::set('alert', 'There ' .$count. ' items that have changed ordering');
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // die();
            break;
        case 'delete':
            $queryAction = "DELETE FROM ".DB_TABLE. " WHERE `id` IN($where)";
            $exc = $db->execute($queryAction);
            Session::set('alert', 'There ' .$exc->rowCount(). ' items that have changed status');
            break;
        default: break;
    }

}

header('Location: index.php');
?>