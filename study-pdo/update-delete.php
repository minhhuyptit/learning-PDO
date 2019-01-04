<?php
    include_once '../define.php';

    // 1.Khởi tạo kết nối PDO với mysql
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //Hỗ trợ CSDL có tiếng việt
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Hiển thị các lỗi, cảnh báo
    );

    try {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
        echo 'Kết nối thành công';
    } catch (PDOExteption $e) {
        echo $e->getMessage();
        exit();
    }

    // 2.Update
    // $query = "UPDATE ".DB_TABLE." SET `status` = :st, `ordering` = :or WHERE `id` = :id";
    // $stmt = $db->prepare($query);

    // Cách 1
    // $stmt->bindParam(':st', $status);
    // $stmt->bindParam(':or', $ordering);
    // $stmt->bindParam(':id', $id);

    // $status = 1;
    // $ordering = 5;
    // $id = 1;
    // $stmt->execute();

    // Cách 2
    // $data = [':st' => 1, ':or'=> 4, ':id' => 1];
    // $stmt->execute($data);


    // 3.Delete
    // $query = "DELETE FROM ".DB_TABLE." WHERE `id` = :id";
    // $stmt = $db->prepare($query);
    // $data = [':id' => 1];
    // $stmt->execute($data);
?>
