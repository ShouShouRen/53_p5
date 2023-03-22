<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <style>
    td{
      width: 180px;
      height: 180px;
      border: 2px solid #fff;
      cursor: pointer;
    }
  </style>
  <title>Document</title>
</head>
<body>
  <div class="d-center">
    <table>
      <tr>
        <td data-id="1"></td>
        <td data-id="2"></td>
      </tr>
      <tr>
        <td data-id="3"></td>
        <td data-id="4"></td>
      </tr>
    </table>
    <div class="text-center">
    <p class="py-3 m-0 text-white">請選擇兩格相鄰的格子，連成水平或垂直線。</p>
      <button class="btn btn-outline-light" id="checkit">驗證</button>
    </div>
  </div>
</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/script.js"></script>
</html>