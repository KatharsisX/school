<?php
include("db_connection.php");
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id=$_GET['id'];
    if($stmt=$mysqli->prepare("DELETE FROM contacts WHERE id = ? LIMIT 1")){
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
}
$mysqli->close();
header('location:index.php');