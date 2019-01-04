<?php
    include_once '../define.php';

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
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
        }
    }

    // 3.Insert
    $query = "INSERT INTO ".DB_TABLE." (`name`, `status`, `ordering`) VALUES(:name, :st, :or)";
    $stmt = $db->prepare($query);

    // Cách 1   Placeholder - Single Variable
    // $stmt->bindParam(':name', $name);
    // $stmt->bindParam(':st', $status);
    // $stmt->bindParam(':or', $ordering);
    
    // $name = 'React';
    // $status = 1;
    // $ordering = 10;

    // $stmt->execute();


    // Cách 2   Unamed Placeholder - Array
    // $data = array(':name' => 'PHP', ':st' => 1, ':or' => 12);
    // $stmt->execute($data);

    
    // Cách 3   Unamed Placeholder - Single Variable
    // $query = "INSERT INTO ".DB_TABLE." (`name`, `status`, `ordering`) VALUES(?, ?, ?)";
    // $stmt = $db->prepare($query);

    // $stmt->bindParam(1, $name);
    // $stmt->bindParam(2, $status);
    // $stmt->bindParam(3, $ordering);

    // $name = 'React Native';
    // $status = 1;
    // $ordering = 13;

    // $stmt->execute();


    // Cách 4
    $query = "INSERT INTO ".DB_TABLE." (`name`, `status`, `ordering`) VALUES(?, ?, ?)";
    $stmt = $db->prepare($query);
    $data = ['Laravel', 0, 17];
    $stmt->execute($data);

    echo $db->lastInsertId();

?>