<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php';

$data = json_decode(file_get_contents("php://input")); // การดึงค่าออกมาจาก json
if($_SERVER['REQUEST_METHOD'] !== 'PATCH'){  // เช็คว่า Method ที่ใช้เป็น PATCH ไหม ถ้าไม่เป็นจะขึ้นว่าerror method
    echo json_encode(array("status" => "error method"));
    die();
}

try{
    $stmt = $dbh->prepare("UPDATE `user` SET `username`=?,`email`=?, `password`=? ,`updated_at`=now() WHERE `user_id`=?"); // การ อัพเดต ข้อมูลลงฐานข้อมูล
    $stmt->bindParam(1, $data -> user_id);  //parameter ตัวแรกรับเป็น user_id
    $stmt->bindParam(2, $data -> title); //parameter ตัวแรกรับเป็น title
    $stmt->bindParam(3, $data -> password); //parameter ตัวแรกรับเป็น password
    $stmt->bindParam(4, $data -> user_id); //parameter ตัวแรกรับเป็น user_id

    if($stmt -> execute()){ // อัพเดต เพิ่ม ข้อมูลลงผิดรึเปล่า
        echo json_encode(array("status" => "success"));
    }else {
        echo json_encode(array("status" => "unsuccess"));
    }
    

$dbh = null;
}catch(PDOException $e){
    print "error!: " .$e->getMessage(). "</br>"; //ถ้ามีไม่เข้าเงื่อนไข foreach จะขึ้นข้อความว่า 'เกิดข้อผิดพลาด'
    die();
}

?>