<?php
    include_once 'define.php';
    function __autoload($className){
        $fileName = "libs/" . $className . ".php";
        if(file_exists($fileName)){
            include_once($fileName);
        }else{
            echo "The file $fileName does not exist";
        }
    }
?>