<?php
  session_start();
  require_once("pdo.php");
  extract($_POST);
  if(!isset($_SESSION["AUTH"])){
    header("Location: login.php");
  }
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
            <a href="index.php" class="btn btn-outline-warning">離開</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container" style="margin-top: 86px">
    <div class="py-4">
      <div class="row align-items-center">
        <h5 class="text-center text-white border-start font-weight-bolder">商品上架</h5>
      </div>
    </div>
    <div class="col-12 p-4 rounded-lg shadow-lg bg-white" style="min-height: 80dvh;">
      <ul class="nav nav-tabs" id="tab">
        <li class="nav-item">
          <a href="#chose" class="nav-link active" id="chose-tab" data-toggle="tab">選擇版型</a>
        </li>
        <li class="nav-item">
          <a href="#input" class="nav-link" id="input-tab" data-toggle="tab">填寫資料</a>
        </li>
        <li class="nav-item">
          <a href="#preview" class="nav-link" id="preview-tab" data-toggle="tab">商品預覽</a>
        </li>
        <li class="nav-item">
          <a href="#submit" class="nav-link" id="submit-tab" data-toggle="tab">確認送出</a>
        </li>
      </ul>
      <form action="store_product.php" method="post" enctype="multipart/form-data">
        <div class="tab-content" id="tabcontent">
          <div class="tab-pane fade show active" id="chose">
            <div class="row py-3">
              <div class="col-6 d-flex h-380">
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center">
                    <p>圖片</p>
                  </div>
                  <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
                </div>
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-20 mt-1 py-3">商品名稱</div>
                  <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
                  <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
                  <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
                </div>
              </div>
              <div class="col-6 d-flex h-380">
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-20 mb-1 py-3">商品名稱</div>
                  <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center">
                    <p>圖片</p>
                  </div>
                </div>
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
                  <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
                  <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
                  <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
                </div>
              </div>
            </div>
            <div class="row text-center align-items-center">
              <div class="col-6">
                <label for="">商品版型1:</label>
                <input type="radio" name="template" id="template1" value="1">
              </div>
              <div class="col-6">
                <label for="">商品版型2:</label>
                <input type="radio" name="template" id="template2" value="2">
              </div>
            </div>
            <div class="row py-3">
              <div class="col-6 d-flex h-380">
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-20 mt-1 py-3">商品名稱</div>
                  <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
                  <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
                  <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
                </div>
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center">
                    <p>圖片</p>
                  </div>
                  <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
                </div>
              </div>
              <div class="col-6 d-flex h-380">
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
                  <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
                  <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
                  <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
                </div>
                <div class="col-6 h-100 bg-back p-3 text-center text-light">
                  <div class="bg-1 w-100 h-20 mb-1 py-3">商品名稱</div>
                  <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center">
                    <p>圖片</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row text-center align-items-center">
              <div class="col-6">
                <label for="">商品版型3:</label>
                <input type="radio" name="template" id="template3" value="3">
              </div>
              <div class="col-6">
                <label for="">商品版型4:</label>
                <input type="radio" name="template" id="template4" value="4">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="input">
            <div class="d-flex justify-content-center">
              <div class="col-8">
                <div class="bg-white p-4 rounded-lg">
                  <h4 class="text-center my-5">填寫資料</h4>
                  <div class="d-flex justify-content-between align-items-center my-3">
                    <label for="">商品名稱:</label>
                    <input type="text" class="w-75 form-control" name="product_name" require>
                  </div>
                  <div class="d-flex justify-content-between align-items-center my-3">
                    <label for="">商品描述:</label>
                    <textarea name="product_des" class="w-75 form-control"></textarea>
                  </div>
                  <div class="d-flex justify-content-between align-items-center my-3">
                    <label for="">發布日期:</label>
                    <input type="datetime-local" name="time" class="w-75 form-control" value="<?=$now?>" require>
                  </div>
                  <div class="d-flex justify-content-between align-items-center my-3">
                    <label for="">商品圖片:</label>
                    <input type="file" class="w-75" name="images">
                  </div>
                  <div class="d-flex justify-content-between align-items-center my-3">
                    <label for="">商品價格:</label>
                    <input type="text" class="w-75 form-control" name="price" require>
                  </div>
                  <div class="d-flex justify-content-between align-items-center my-3">
                    <label for="">商品連結:</label>
                    <input type="text" class="w-75 form-control" name="links" require>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="preview">

          </div>
          <div class="tab-pane fade" id="submit">
            <div class="position-relative">
              <div class="d-center">
                <button type="submit" class="btn btn-success">確認送出</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/script.js"></script>
<script src="./js/template.js"></script>

</html>