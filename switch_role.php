<?php
  require_once("pdo.php");
  extract($_GET);
  $sql = "UPDATE users SET role = ? WHERE id = ?";
  if($role == 0){
    $role = 1;
  }else{
    $role = 0;
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$role,$id]);
  header("Location:member_list.php");
?>