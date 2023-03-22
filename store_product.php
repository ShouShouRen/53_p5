<?php
  require_once("pdo.php");
  extract($_POST);
  $sql = "INSERT INTO products(product_name,product_des,price,links,time,images,template) VALUES (?,?,?,?,?,?,?)";
  $stmt = $pdo->prepare($sql);
  $ext = strtolower(pathinfo($_FILES["images"]["name"], PATHINFO_EXTENSION));
  if($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif"){
    return;
  }
  $image_name = md5(uniqid()). "." .$ext;
  $target = "images/".$image_name;
  if(move_uploaded_file($_FILES["images"]["tmp_name"],$target)){
    echo "上傳成功";
    $stmt->execute([$product_name,$product_des,$price,$links,$time,$image_name,$template]);
  }else{
    echo "上傳失敗";
  }
  header("Location: index.php");
?>