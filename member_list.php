<?php
  session_start();
  require_once("pdo.php");
  extract($_POST);
  if(!isset($_SESSION["AUTH"])){
    header("Location:logout.php");
  }
  $sql = "SELECT * FROM users";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  $sql_log = "SELECT * FROM login_log";
  $stmt_log = $pdo->prepare($sql_log);
  $stmt_log->execute();
  $result_log = $stmt_log->fetchAll(PDO::FETCH_ASSOC);

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
    <div class="pt-3 pb-5">
      <div class="row justify-content-between align-items-center">
        <h5 class="text-center text-white border-start font-weight-bolder">會員管理</h5>
        <div class="row justify-content-around align-items-center text-white py-3 w-25">
          <input type="number" value="60" id="timeInput" class="form-control w-25">
          <button id="setTimeBtn" class="btn btn-sm btn-outline-light">設定</button>
          <span id="countdown">60秒</span>
          <button id="resetTimeBtn" class="btn btn-sm btn-outline-light">重新計時</button>
        </div>
      </div>
      <div class="p-4 bg-white rounded-lg show-lg">
        <div class="row justify-content align-items-center mb-3">
          <div class="col-6">
            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#adduser">新增使用者</button>
            <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#log">使用者登出入紀錄</button>
            <!-- Modal -->
            <div class="modal fade" id="adduser">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">新增使用者</h5>
                    <button class="close" data-dismiss="modal">
                      <span>&times</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="p-4" action="register_store.php" method="post">
                      <div class="py-2">
                        <label for="">使用者帳號</label>
                        <input type="text" name="user" class="form-control my-2" require>
                      </div>
                      <div class="py-2">
                        <label for="">使用者姓名</label>
                        <input type="text" name="user_name" class="form-control my-2" require>
                      </div>
                      <div class="py-2">
                        <label for="">使用者密碼</label>
                        <input type="password" name="pw" class="form-control" require>
                      </div>
                      <div class="text-right"><input type="submit" value="新增" class="btn btn-success"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="log">
              <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">新增使用者</h5>
                    <button class="close" data-dismiss="modal">
                      <span>&times</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table p-4">
                      <tr>
                        <th>帳號</th>
                        <th>時間</th>
                        <th>狀態</th>
                      </tr>
                      <?php foreach($result_log as $row) { ?>
                      <tr>
                        <td><?=$row["user"]?></td>
                        <td><?=$row["login_time"]?></td>
                        <td><?=$row["status"]?></td>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <form id="search-member" class="d-flex justify-content-end align-items-center">
              <div class="d-flex px-2">
                <label for="up-order">升冪</label>
                <input type="radio" name="use" id="up-order" value="up">
              </div>
              <div class="d-flex px-2">
                <label for="down-order">降冪</label>
                <input type="radio" name="use" id="down-order" value="down">
              </div>
              <input type="search" name="search" id="search-input" placeholder="請輸入使用者資料"
                class="form-control w-50 mr-2">
              <button type="submit" class="btn btn-secondary">查詢</button>
            </form>
          </div>
        </div>
        <table class="table table-hover">
          <tr>
            <th>使用者編號</th>
            <th>使用者帳號</th>
            <th>使用者密碼</th>
            <th>使用者名稱</th>
            <th>使用者權限</th>
            <th>操作</th>
          </tr>
          <tbody id="search_result"></tbody>
          <?php foreach($result as $row){?>
          <tr class="show-all">
            <td><?=$row["user_id"]?></td>
            <td><?=$row["user"]?></td>
            <td><?=$row["pw"]?></td>
            <td><?=$row["user_name"]?></td>
            <td>
              <?php
                  switch($row["role"]){
                    case 0:
                      echo "管理員";
                      break;
                    case 1:
                      echo "一般使用者";
                      break;
                  }
                ?>
            </td>
            <td>
              <?php
                if($row["id"] == 1){
              ?>
              <?php }elseif($row["id"] == $_SESSION["AUTH"]["id"]){ ?>
              <span class="text-secondary">修改權限</span>
              <?php } else { ?>
              <a href="switch_role.php?role=<?=$row["role"];?>&id=<?=$row["id"];?>"
                class="btn btn-outline-secondary">修改權限</a>
              <?php }; ?>
              <?php
                if($row["id"] == 1){
              ?>
              <?php }else { ?>
              <button class="btn btn-outline-secondary getmember" data-id="<?=$row['id'];?>" data-toggle="modal"
                data-target="#edit">修改</button>
              <!-- Modal -->
              <div class="modal fade" id="edit">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <div class="modal-title">
                        <h5 class="modal-title">修改使用者</h5>
                      </div>
                      <button class="close" data-dismiss="modal">
                        <span>&times</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="p-4">
                        <div class="py-2">
                          <label for="">使用者帳號</label>
                          <input type="text" name="user" id="user" class="form-control my-2" require>
                        </div>
                        <div class="py-2">
                          <label for="">使用者名稱</label>
                          <input type="text" name="user_name" id="user_name" class="form-control my-2" require>
                        </div>
                        <div class="py-2">
                          <label for="">使用者密碼</label>
                          <input type="text" name="pw" id="pw" class="form-control my-2" require>
                          <input type="hidden" name="id" id="id">
                        </div>
                        <div class="text-right">
                          <button type="button" class="btn btn-success savemember">儲存修改</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <a href="delete_member.php?id=<?=$row["id"];?>" class="btn btn-outline-danger"
                onclick="return confirm('確定要刪除?')">刪除</a>
              <?php }; ?>
            </td>
          </tr>
          <?php } ?>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="confirmModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">系統提示</h5>
                <button class="close" data-dismiss="modal">
                  <span>&times</span>
                </button>
              </div>
              <div class="modal-body">
                <p>您的操作時間已到，系統將在<span id="countdownModal">5</span>秒後自動登出，請問您是否繼續操作?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelBtn">取消</button>
                <button type="button" class="btn btn-warning" id="continueBtn">繼續操做</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/script.js"></script>

</html>