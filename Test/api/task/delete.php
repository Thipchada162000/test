<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php';

$data = json_decode(file_get_contents("php://input"));
if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
    echo json_encode(array("status" => "error1"));
    die();
}
try{
    $stmt = $dbh->prepare("DELETE FROM task  WHERE task_id = ?");
    $stmt->bindParam(1, $data -> task_id);
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