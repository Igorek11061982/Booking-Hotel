<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>KALUGA PLAZA OTEL - ROOMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    



</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="my-5 px-4">

<h1 class="fw-bold h-font text-center fst-italic"> Номера и цены </h1>
<div class="h-line bg-dark"> </div>
</div>


<div class="col-lg-12  col-md-10 px-5">


 <div class="card mb-4 bg-dark border-0 shadow">
  <div class="row g-0 p-3 align-items-center">
  <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
      <img src="images/Rooms/2.jpg" class="img-fluid rounded">
    </div>    
    <div class="col-md-4 px-lg-4 px-md-4 px-0">
      <h1 class="mb-2  text-light text-decoration-underline">Номер "Эконом"</h1>
      <div class="features mb-3">
      <h3 class="mb-1  text-danger">Описание номера</h3>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
       Одна  комната 
      </span>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
       Одна ванная комната
      </span>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
      Одна односпальная кровать
      </span>
      </div>
      <div class="Facilities mb-3">
      <h3 class="mb-1  text-danger">Оснащение</h3>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
        Wi-Fi
       </span>
       <span class="badge rounded-pill fs-6 text-light  text-wrap">
        Телевизор (экран 20 дюймов)
       </span>
      
     
     </div>
     <div class="guests mb-4">
      <h3 class="mb-1  text-danger">Вместимость</h3>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
      Один взрослый
     </span>
    </div>
    <h3 class="mb-1  text-danger">Площадь</h3>
    <span class="badge rounded-pill fs-6 text-light  text-wrap">
        25 кв.м.
     </span>
    </div>
    <div class="col-md-5 text-center">
    <h4 class="badge rounded-pill fs-4 text-light  text-wrap" >₽ 3000/сутки</h4>
    <a href="#" class="btn btn-sm w-100 text-black custom-bg shadom-none mb-2">Забронировать</a>
    <!-- <a href="#" class="btn btn-sm w-100 btn-outline-dark  shadom-none">Дополнительная информация</a> -->
    </div>
  </div>
</div>

<?php

$room_res=select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1,0], 'ii');

while($room_data=mysqli_fetch_assoc($room_res)) // До тех пор пока в результате содержатся ряды, помещаем их в ассоциативный массив  
  {

$room_thumb= ROOMS_IMG_PATH."thumbnail.jpg";
$thumb_q= mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
if (mysqli_num_rows($thumb_q)>0)
{
$thum_res= mysqli_fetch_assoc($thumb_q);
$room_thumb=ROOMS_IMG_PATH.$thum_res['image'];

}

$book_btn = "";
if (!$settings_r['shutdown'])
{
$login =0;
if (isset($_SESSION['login']) && $_SESSION['login']==true)
{

  $login=1;

}


$book_btn= "<button onclick= 'checkLoginToBook ($login, $room_data[id])' class='btn btn-sm w-100 text-black custom-bg shadom-none mb-2'>Забронировать</a>";

}



    echo<<<data

    <div class="card mb-4 bg-dark border-0 shadow">
      <div class="row g-0 p-3 align-items-center">
      <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
      <img src="$room_thumb" class="img-fluid rounded">
      </div>    
      <div class="col-md-6 px-lg-4 px-md-4 px-0">
      <h1 class="mb-2 text-light text-decoration-underline"> Номер "$room_data[name]"</h1>
      <div class="features mb-3">
      <h3 class="mb-1  text-danger">Описание номера</h3>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
       $room_data[description]
      </span>
      </div>
      <div class="Facilities mb-3">
      <h3 class="mb-1  text-danger">Оснащение</h3>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
        $room_data[features]
       </span>
      </div>

     <div class="guests mb-4">
      <h3 class="mb-1  text-danger">Вместимость</h3>
      <span class="badge rounded-pill fs-6 text-light  text-wrap">
      $room_data[adult] взрослый(ых)
     </span>
       <span class="badge rounded-pill fs-6 text-light  text-wrap">
      $room_data[children] детей
     </span>
    </div>
    <h3 class="mb-1  text-danger">Площадь</h3>
    <span class="badge rounded-pill fs-6 text-light  text-wrap">
       $room_data[area] кв.м.
     </span>
    </div>
      <div class="col-md-5 text-center">
      <h4 class="badge rounded-pill fs-4 text-light  text-wrap" >₽ $room_data[price]/сутки</h4>
    $book_btn
    </div>
    </div>
  </div>





  data;
  }
  
?>


</div>
</div>
</div>

<?php require('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>
</html>

