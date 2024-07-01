<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php';

$data = json_decode(file_get_contents("php://input"));
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo json_encode(array("status" => "error method"));
    die();
}

try{
    $stmt = $dbh->prepare("INSERT INTO `comment`( `task_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES (?,?,?,now(),now())");
    $stmt->bindParam(1, $data -> task_id);
    $stmt->bindParam(2, $data -> user_id);
    $stmt->bindParam(3, $data -> comment);

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