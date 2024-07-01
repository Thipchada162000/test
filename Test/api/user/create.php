<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php';

$data = json_decode(file_get_contents("php://input")); // การดึงค่าออกมาจาก json
if($_SERVER['REQUEST_METHOD'] !== 'POST'){ // เช็คว่า Method ที่ใช้เป็น post ไหม ถ้าไม่เป็นจะขึ้นว่าerror method
    echo json_encode(array("status" => "error method"));
    die(); //ปิดphp ไป
}

try{
    $stmt = $dbh->prepare("INSERT INTO `user`( `username`, `email`, `password`, `created_at`, `updated_at`) VALUES (?,?,?,now(),now())"); // การ เพิ่ม ข้อมูลลงฐานข้อมูล
    $stmt->bindParam(1, $data -> username); //parameter ตัวแรกรับเป็น username
    $stmt->bindParam(2, $data -> email); //parameter ตัวแรกรับเป็น email
    $stmt->bindParam(3, $data -> password);//parameter ตัวแรกรับเป็น password 



    if($stmt -> execute()){ // เช็คว่าตอน เพิ่ม ข้อมูลลงผิดรึเปล่า
        echo json_encode(array("status" => "success"));
    }else {
        echo json_encode(array("status" => "unsuccess"));
    }

$dbh = null;
}catch(PDOException $e){ 
    echo "error!: " .$e->getMessage(). "</br>"; //ถ้ามีไม่เข้าเงื่อนไข foreach จะขึ้นข้อความว่า 'เกิดข้อผิดพลาด'
    die();
}

?>