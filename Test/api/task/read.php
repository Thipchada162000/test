<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8'); //ให้ข้อมูลที่ออกมาเป็น Json
include '../connectdb.php';
try{
    
$users = array();
foreach($dbh->query('SELECT * FROM task') as $row ){
    array_push($users,array(
        'task_id' => $row['task_id'],
        'user_id' => $row['user_id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'status' => $row['status'],
        'priority' => $row['priority'],
        'due_date' => $row['due_date'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
    ));

}
echo json_encode($users);
$dbh = null;
}catch(PDOException $e){
    print "error!: " .$e->getMessage(). "</br>";
    die();
}

?>