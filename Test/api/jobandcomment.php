<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '/xampp/htdocs/Test/api/connectdb.php'; //ไปเรียกฐานช้อมูลที่พาสนี้

try{ 
$users = array();
foreach($dbh->query('SELECT u.username  , t.title , t.description , t.status ,t.priority ,t.due_date ,m.comment 
                        FROM user u 
                        JOIN task t ON u.user_id = t.user_id
                        JOIN comment m ON m.task_id = t.task_id AND m.user_id = m.user_id') as $row ){ // การวนลูปดึงข้อมูลมาจากฐานข้อมูลมาใส่ในตัวแปลแล้วแสดงผล
    array_push($users,array(
        'username' => $row['username'], // username แสดงเป็นของ username
        'title' => $row['title'], //title แสดงเป็นของ title
        'description' => $row['description'], //email แสดงเป็นของ description
        'status' => $row['status'], //status แสดงเป็นของ status
        'priority' => $row['priority'], //priority แสดงเป็นของ priority
        'due_date' => $row['due_date'], //due_date แสดงเป็นของ due_date
        'comment' => $row['comment'], //due_date แสดงเป็นของ comment
    ));

}
echo json_encode($users); //แสดงข้อมูลที่มีในฐานข้อมูลที่อยู่ในตัวแปล$user
$dbh = null;
}catch(PDOException $e){
    echo "error!: " .$e->getMessage(). "</br>"; //ถ้ามีไม่เข้าเงื่อนไข foreach จะขึ้นข้อความว่า 'เกิดข้อผิดพลาด'
    die();
}

?>
