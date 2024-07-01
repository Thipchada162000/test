<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../connectdb.php';
try{
    
$users = array();
foreach($dbh->query('SELECT * FROM comment') as $row ){
    array_push($users,array(
        'comment_id' => $row['comment_id'],
        'task_id' => $row['task_id'],
        'user_id' => $row['user_id'],
        'comment' => $row['comment'],
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