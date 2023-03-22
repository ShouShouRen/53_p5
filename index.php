<?php
  session_start();
  require_once("pdo.php");
  extract($_POST);
  if(!isset($_SESSION["AUTH"])){
    header("Location: login.php");
  }
  $sql = "SELECT * FROM products ORDER BY products.time DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a href="index.php" class="navbar-brand">
        <img src="./images/logo.png" class="mx-3 logo" alt="">
        <span>咖啡商品展示系統</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ml-auto my-2" style="max-height: 100px">
          <li class="nav-item">
            <?php echo $_SESSION["AUTH"]["role"] == 0 ? '<a class="nav-link" href="create_product.php">商品上架</a>':''; ?>
          </li>
          <li class="nav-item">
            <?php echo $_SESSION["AUTH"]["role"] == 0 ? '<a class="nav-link" href="member_list.php">會員管理</a>':''; ?>
          </li>
          <li class="nav-item">
            <?php echo isset($_SESSION["AUTH"]) ? '<a class="nav-link btn btn-outline-warning" href="logout.php">登出</a>' : ''; ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container" style="margin-top: 86px;">
    <div class="row py-3 justify-content-between">
      <h5 class="font-weight-bolder text-white border-start">商品展示</h5>
      <form id="search-product" class="d-flex justify-content-end align-items-center">
        <input type="search" name="search" id="search-input" class="form-control w-25 mx-1" placeholder="請輸入商品名稱">
        <input type="number" name="min_price" id="min-price-input" class="form-control w-25 mx-1" placeholder="最低價格">
        <input type="number" name="max_price" id="max-price-input" class="form-control w-25 mx-1" placeholder="最高價格">
        <button type="submit" class="btn btn-secondary">查詢</button>
      </form>
    </div>
    <div class="row justify-content-start mt-4 flex-wrap" id="search-results">
      <?php foreach($result as $row) {?>
      <?php if($row["template"] == 1) {?>
      <div class="col-6 h-380">
        <div class="d-flex text-center bg-back px-2 py-3 flex-wrap">
          <div class="col-6">
            <img src="./images/<?= $row["images"]; ?>" class="w-100" style="height: 225px" alt="">
            <div class="bg-2 w-100 h-20 mt-1 py-3 text-center text-light">相關連結:<a
                href="<?= $row["links"]; ?>"><?= $row["links"]; ?></a></div>
          </div>
          <div class="col-6">
            <div class="bg-1 w-100 h-20 mt-1 py-3 text-center text-light">
              商品名稱:<?= $row["product_name"]; ?></div>
            <div class="bg-2 w-100 h-30 mt-1 py-4 text-center text-light">
              商品簡介:<?= $row["product_des"]; ?></div>
            <div class="bg-3 w-100 h-20 mt-1 py-3 text-center text-light">
              發布日期:<?= $row["time"]; ?></div>
            <div class="bg-1 w-100 h-20 mt-1 py-3 text-center text-light">
              費用:<?= $row["price"]; ?> 元</div>
          </div>
          <div class="col-12 mt-2">
            <?php
                  if ($_SESSION["AUTH"]["role"] == 0) {
                      echo "<button class='btn btn-secondary btn-sm getproduct' data-toggle='modal' data-id='" . $row['id'] . "' data-target='#edit-product'>編輯</button>";
                  }
                ?>
          </div>
        </div>
      </div>
      <?php } else if($row["template"] == 2) {?>
      <div class="col-6 h-380">
        <div class="d-flex text-center bg-back px-2 py-3 flex-wrap">
          <div class="col-6">
            <div class="bg-1 w-100 h-20 mb-1 py-3 text-center text-light">
              商品名稱:<?= $row["product_name"]; ?></div>
            <img src="./images/<?= $row["images"]; ?>" class="w-100" style="height: 225px" alt="">
          </div>
          <div class="col-6">
            <div class="bg-1 w-100 h-20 mt-1 py-3 text-center text-light">
              費用:<?= $row["price"]; ?> 元</div>
            <div class="bg-2 w-100 h-30 mt-1 py-4 text-center text-light">
              商品簡介:<?= $row["product_des"]; ?></div>
            <div class="bg-3 w-100 h-20 mt-1 py-3 text-center text-light">
              發布日期:<?= $row["time"]; ?></div>
            <div class="bg-2 w-100 h-20 mt-1 py-3 text-center text-light">相關連結:<a
                href="<?= $row["links"]; ?>"><?= $row["links"]; ?></a></div>
          </div>
          <div class="col-12 mt-2">
            <?php
                  if ($_SESSION["AUTH"]["role"] == 0) {
                      echo "<button class='btn btn-secondary btn-sm getproduct' data-toggle='modal' data-id='" . $row['id'] . "' data-target='#edit-product'>編輯</button>";
                  }
                ?>
          </div>
        </div>
      </div>
      <?php } else if($row["template"] == 3) {?>
      <div class="col-6 h-380">
        <div class="d-flex text-center bg-back px-2 py-3 flex-wrap">
          <div class="col-6">
            <div class="bg-1 w-100 h-20 mt-1 py-3 text-center text-light">
              商品名稱:<?= $row["product_name"]; ?></div>
            <div class="bg-2 w-100 h-30 mt-1 py-4 text-center text-light">
              商品簡介:<?= $row["product_des"]; ?></div>
            <div class="bg-3 w-100 h-20 mt-1 py-3 text-center text-light">
              發布日期:<?= $row["time"]; ?></div>
            <div class="bg-1 w-100 h-20 mt-1 py-3 text-center text-light">
              費用:<?= $row["price"]; ?> 元</div>
          </div>
          <div class="col-6">
            <img src="./images/<?= $row["images"]; ?>" class="w-100" style="height: 225px" alt="">
            <div class="bg-2 w-100 h-20 mt-1 py-3 text-center text-light">相關連結:<a
                href="<?= $row["links"]; ?>"><?= $row["links"]; ?></a></div>
          </div>
          <div class="col-12 mt-2">
            <?php
                  if ($_SESSION["AUTH"]["role"] == 0) {
                      echo "<button class='btn btn-secondary btn-sm getproduct' data-toggle='modal' data-id='" . $row['id'] . "' data-target='#edit-product'>編輯</button>";
                  }
                ?>
          </div>
        </div>
      </div>
      <?php } else if($row["template"] == 4) {?>
      <div class="col-6 h-380">
        <div class="d-flex text-center bg-back px-2 py-3 flex-wrap">
          <div class="col-6">
            <div class="bg-1 w-100 h-20 mb-1 py-3 text-center text-light">
              商品名稱:<?= $row["product_name"]; ?></div>
            <img src="./images/<?= $row["images"]; ?>" class="w-100" style="height: 225px" alt="">
          </div>
          <div class="col-6">
            <div class="bg-1 w-100 h-20 mt-1 py-3 text-center text-light">
              費用:<?= $row["price"]; ?> 元</div>
            <div class="bg-2 w-100 h-30 mt-1 py-4 text-center text-light">
              商品簡介:<?= $row["product_des"]; ?></div>
            <div class="bg-3 w-100 h-20 mt-1 py-3 text-center text-light">
              發布日期:<?= $row["time"]; ?></div>
            <div class="bg-2 w-100 h-20 mt-1 py-3 text-center text-light">相關連結:<a
                href="<?= $row["links"]; ?>"><?= $row["links"]; ?></a></div>
          </div>
          <div class="col-12 mt-2">
            <?php
                  if ($_SESSION["AUTH"]["role"] == 0) {
                      echo "<button class='btn btn-secondary btn-sm getproduct' data-toggle='modal' data-id='" . $row['id'] . "' data-target='#edit-product'>編輯</button>";
                  }
                ?>
          </div>
        </div>
      </div>
      <?php }?>
      <?php }?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit-product">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">修改產品</h5>
            <button class="close" data-dismiss="modal">
              <span>&times</span>
            </button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data">
              <div class="d-flex justify-content-between my-3">
                <label for="">商品標題:</label>
                <input type="text" class="form-control w-75" name="product_name" id="product_name">
              </div>
              <div class="d-flex justify-content-between my-3">
                <label for="">商品介紹:</label>
                <input type="text" class="form-control w-75" name="product_des" id="product_des">
              </div>
              <div class="d-flex justify-content-between my-3">
                <label for="">發布日期:</label>
                <input type="datetime-local" name="time" class="form-control w-75" id="time" value="<?=$now?>">
              </div>
              <div class="d-flex justify-content-between my-3">
                <label for="">當前圖片:</label>
                <img id="current-image" class="w-25" src="" alt="">
              </div>
              <div class="d-flex justify-content-between my-3">
                <label for="">上傳圖片:</label>
                <input type="file" name="images" id="images">
              </div>
              <div class="d-flex justify-content-between my-3">
                <label for="">費用:</label>
                <input type="text" class="form-control w-75" id="price" name="price">
              </div>
              <div class="d-flex justify-content-between my-3">
                <label for="">相關連結:</label>
                <input type="text" class="form-control w-75" id="links" name="links">
              </div>
              <div class="text-right my-3">
                <input type="submit" class="btn btn-success saveproduct" value="儲存">
              </div>
          </div>
          <input type="hidden" name="id" id="id">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/script.js"></script>

</html>