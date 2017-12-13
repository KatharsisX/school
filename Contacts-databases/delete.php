<?php

include('connect.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id=$_GET['id'];
    if($stmt=$mysqli->prepare("DELETE FROM contacts WHERE id = ? LIMIT 1")){
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
}
$mysqli->close();
$news= "pomyslnie usunieto kontakt";
header("location:index.php?news=$news");