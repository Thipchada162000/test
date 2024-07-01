<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php'; //ไปเรียกฐานช้อมูลที่พาสนี้

try{ 
$users = array();
foreach($dbh->query('SELECT * FROM user') as $row ){ // การวนลูปดึงข้อมูลมาจากฐานข้อมูลมาใส่ในตัวแปลแล้วแสดงผล
    array_push($users,array(
        'user_id' => $row['user_id'], // user_id แสดงเป็นของ user_id
        'username' => $row['username'], //username แสดงเป็นของ username
        'email' => $row['email'], //email แสดงเป็นของ email
        'password' => $row['password'], //password แสดงเป็นของ password
        'created_at' => $row['created_at'], //created_at แสดงเป็นของ created_at
        'updated_at' => $row['updated_at'], //updated_at แสดงเป็นของ updated_at
    ));

}
echo json_encode($users); //แสดงข้อมูลที่มีในฐานข้อมูลที่อยู่ในตัวแปล$user
$dbh = null;
}catch(PDOException $e){
    echo "error!: " .$e->getMessage(). "</br>"; //ถ้ามีไม่เข้าเงื่อนไข foreach จะขึ้นข้อความว่า 'เกิดข้อผิดพลาด'
    die();
}

?>