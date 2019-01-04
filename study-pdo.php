<?php
    include_once 'define.php';

    // 1.Khởi tạo kết nối PDO với mysql
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //Hỗ trợ CSDL có tiếng việt
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Hiển thị các lỗi, cảnh báo
    );

    try {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
        echo 'Thành công';
    } catch (PDOExteption $e) {
        echo $e->getMessage();
        exit();
    }

    // 2.Select fetchAll
    $query = "SELECT *FROM " . DB_TABLE;
    $stmt = $db->prepare($query);
    if($stmt->execute()){
        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){    //FETCH_OBJ: Lấy về dạng Object
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
        }
    }

    // 3.Select fetch
    $query = "SELECT *FROM " . DB_TABLE . " WHERE `id` > ? AND `status` = ?";
    $id = 2;
    $status = 1;
    $stmt = $db->prepare($query);
    if($stmt->execute(array($id, $status))){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){    //FETCH_OBJ: Lấy về dạng Object
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    }


?>