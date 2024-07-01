<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php';

$data = json_decode(file_get_contents("php://input")); // การดึงค่าออกมาจาก json
if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){  // เช็คว่า Method ที่ใช้เป็น DELETE ไหม ถ้าไม่เป็นจะขึ้นว่าerror method
    echo json_encode(array("status" => "error1"));
    die();
}
try{
    $stmt = $dbh->prepare("DELETE FROM user  WHERE user_id = ?"); // การ ลบ ข้อมูลลงฐานข้อมูล
    $stmt->bindParam(1, $data -> user_id); //parameter ตัวแรกรับเป็น user_id

    if($stmt -> execute()){ // เช็คว่าตอน ลบ ข้อมูลลงผิดรึเปล่า
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