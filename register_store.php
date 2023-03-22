<?php
  require_once("pdo.php");
  session_start();
  extract($_POST);
  $sql_check = "SELECT * FROM users WHERE user = ?";
  $stmt_check = $pdo->prepare($sql_check);
  $stmt_check->execute([$user]);
  if($stmt_check->rowCount()>0){
    echo "帳號已存在，請重新申請";
    header("Refresh: 1; url=member_list.php");
    return;
  }
  $sql = "INSERT INTO users(user,user_name,pw) VALUES (?,?,?)";
  $stmt = $pdo->prepare($sql);
  if($stmt->execute([$user,$user_name,$pw])){
    $last_id = $pdo->lastInsertId();
    $user_id = sprintf("%04d",$last_id - 1);
    $update_sql = "UPDATE users SET user_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($update_sql);
    $stmt->execute([$user_id,$last_id]);
  }
  header("Location: member_list.php");
?>