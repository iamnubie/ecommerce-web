<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website using PHP and MySQL.</title>
    <!-- boostrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
     <!-- font awesome link -->
     <link rel="stylesheet" 
     href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
     integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
     crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- css file -->
      <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navbar -->
     <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="./images/logo.jpg" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Đăng ký</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Liên hệ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa-solid fa-cart-plus"></i><sup>1</sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tổng tiền:100/-</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
<li class="nav-item">
          <a class="nav-link" href="#">Chào Mừng Bạn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Đăng Nhập</a>
        </li>
</ul>
</nav>

<!-- third chile -->
<div class="bg-light">
    <h3 class="text-center">Thái Công Store</h3>
    <p class="text-center">Kiến Thức - Kinh Nghiệm - Trải Nghiệm</p>
</div>

<!-- fourth child -->
 <div class="row">
    <div class="col-md-10">
        <!-- products -->
         <div class="row">
            <div class="col-md-4 mb-2">
            <div class="card" >
  <img src="./images/ban1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Thêm vào giỏ</a>
    <a href="#" class="btn btn-secondary">Chi tiết</a>
  </div>
</div>
            </div>
            <div class="col-md-4 mb-2">
            <div class="card" >
  <img src="./images/ban2.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Thêm vào giỏ</a>
    <a href="#" class="btn btn-secondary">Chi tiết</a>
  </div>
</div>
            </div>
            <div class="col-md-4 mb-2">
            <div class="card" >
  <img src="./images/den1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Thêm vào giỏ</a>
    <a href="#" class="btn btn-secondary">Chi tiết</a>
  </div>
</div>
            </div>
             <div class="col-md-4 mb-2">
            <div class="card" >
  <img src="./images/den2.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Thêm vào giỏ</a>
    <a href="#" class="btn btn-secondary">Chi tiết</a>
  </div>
</div>
            </div>
            <div class="col-md-4 mb-2">
            <div class="card" >
  <img src="./images/ban3.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Thêm vào giỏ</a>
    <a href="#" class="btn btn-secondary">Chi tiết</a>
  </div>
</div>
         </div>
         <div class="col-md-4 mb-2">
            <div class="card" >
  <img src="./images/den3.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Thêm vào giỏ</a>
    <a href="#" class="btn btn-secondary">Chi tiết</a>
  </div>
</div>
    </div>
</div>
</div>
    <div class="col-md-2 bg-secondary p-0">
      <!-- brands to be displayed -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Nhà Vận Chuyển</h4></a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">FedEx</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Amazon Prime</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Grab</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Kerry Express</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">J&T Express</a>
          </li>
        </ul>

        <!-- categories to be displayed -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Mục Hàng</h4></a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Bàn ăn</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Giường</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Tủ áo</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Tủ chén</a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link text-light">Đèn chùm</a>
          </li>
        </ul>
    </div>
 </div>


<!-- last child -->
 <div class="bg-info p-3 text-center">
    <p>All rights reserved © Designed by Group-2 2024</p>
 </div>
     </div>

<!-- boostrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>