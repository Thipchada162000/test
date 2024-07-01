<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php';

$data = json_decode(file_get_contents("php://input"));
if($_SERVER['REQUEST_METHOD'] !== 'PATCH'){
    echo json_encode(array("status" => "error method"));
    die();
}

try{
   // $stmt = $dbh->prepare("UPDATE `task` SET `user_id`='1',`title`=?,`description`='ทดสอบ',`status`='pending',`priority`='low' WHERE `task_id`=?");
    $stmt = $dbh->prepare("UPDATE `task` SET `user_id`=?,`title`=? , `description`=?,`status`=? ,`priority`=? ,`due_date`=? ,`updated_at`=now()  WHERE `task_id`=?");
    $stmt->bindParam(1, $data -> user_id); 
    $stmt->bindParam(2, $data -> title);
    $stmt->bindParam(3, $data -> description);
    $stmt->bindParam(4, $data -> status);
    $stmt->bindParam(5, $data -> priority);
    $stmt->bindParam(6, $data -> due_date);
    $stmt->bindParam(7, $data -> task_id);

    if($stmt -> execute()){
        echo json_encode(array("status" => "ok"));
    }else {
        echo json_encode(array("status" => "error"));
    }
    

$dbh = null;
}catch(PDOException $e){
    print "error!: " .$e->getMessage(). "</br>";
    die();
}

?>