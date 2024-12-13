<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>KALUGA PLAZA OTEL - HOME</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
   

<style>
.availability-form
{

margin-top: -50px;
z-index: 2;
position: relative;

}
@media screen and (max-width: 575px) 
{
  .availability-form
  {

margin-top: 25px;
padding: 0 35px;

  }
} 
</style>

</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>
<!-- Карусель заставок -->

<div class= "container-fluid px-lg-5 mt-5">
  <div class="swiper swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="images/1.jpg" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="images/2.jpg" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="images/3.jpg" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="images/4.jpg" class="w-100 d-block" />
      </div>
    </div>
  </div>
</div>

<!-- <div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class ="mb-4">Проверьте возможность бронирования
            </h5>
             <form>
                <div class="row align-items-end">
                  <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight:500;">Дата заезда</label>
                   <input type="date" class="form-control shadow-none">
              </div>    
              <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight:500;">Дата выезда</label>
                   <input type="date" class="form-control shadow-none">
              </div>    
              <div class="col-lg-3 mb-3">   
              <label class="form-label" style="font-weight:500;">Взрослых</label>
              <select class="form-select shadow-none">
              <option value="1">Один</option>
              <option value="2">Два</option>
              <option value="3">Три</option>
              </select>
              </div>         
              <div class="col-lg-2 mb-3">   
              <label class="form-label" style="font-weight:500;">Детей</label>
              <select class="form-select shadow-none">
              <option value="1">Один</option>
              <option value="2">Два</option>
              <option value="3">Три</option>
              </select>
              </div>    
              <div class="col-lg-1 mb-lg-3 mt-2">
                <button type="submit" class="btn text-black shadow-none custom-bg"> Submit</button>
              </div>   
            </div>
          </form>
        </div>
    </div>
</div> -->

<!-- Наши  Комнаты -->

<h2 class=" mt-3 pt-3 mb-5 fw-bold h-font text-center fst-italic"> Номера и цены </h2>

<div class="container">
<div class="row">




<div class="col-lg-4  col-md-6  text-center my-3">
  <div class="card  border-0 shadow" style="max-width: 350px; max-height: 350px; ;margin: auto;">
    <img src="images/Rooms/2.jpg" class="card-img-top">
    <div class="card-body">
    <h3 class="mb-2 text-danger"> Номер "Эконом" </h3>
      <h4 class="mb-4" >₽ 1500/сутки</h4>
      
  
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



    echo<<<data

    <div class="col-lg-4 col-md-5 text-center  my-3">
     <div class="card border-0 shadow" style="max-width: 350px; max-height: 350px; margin: auto;">
      <img src="$room_thumb" class="card-img-top">
      <div class="card-body">
      <h3 class="mb-4 text-danger" > Номер"$room_data[name]" </h3>
      <h4 class="mb-4">₽ $room_data[price]/сутки</h4>
      
     </div>
    </div>
   </div>






  data;
  }
  
?>





>
</div>
</div>


<h2 class="mt-3 pt-1 mb-3  fw-bold h-font text-center fst-italic"> Гостиничные услуги </h2>

<div class="container">
<div class="row justify-content-evenly px-lg-0 px-md-0 px-5">


























<?php 

  $res= selectAll('facilities');
  $path=FACILITIES_IMG_PATH;
  while($row=mysqli_fetch_assoc($res))
  {
  echo<<<data
    <div class="col-lg-3 col-md-6 text-center bg-light rounded shadow py-4 my-5">
      <img src="$path$row[picture]" width="250px">
      <h4  class="mb-4 text-danger"> $row[name] </h4>
    </div>
  data;
  }

?>





<div class="col-lg-3 col-md-6 text-center bg-light rounded shadow py-4 my-5">
  <img src="images/facilities/2.jpg" width="250px">
  <h4  class="mb-4 text-danger"> Ресторан</h4>
</div>

<div class="col-lg-3 col-md-6 text-center bg-light rounded shadow py-4 my-5">
  <img src="images/facilities/5.jpg" width="250px">
  <h4  class="mb-4 text-danger"> Банный комплекс </h4>
</div>

<div class="col-lg-3 col-md-6 text-center bg-light rounded shadow py-4 my-5">
  <img src="images/facilities/6.jpg" width="250px">
  <h4  class="mb-4 text-danger"> Конференц-зал </h4>

</div>


<!-- Контакты -->
<?php
$contact_q='SELECT * FROM contact_details WHERE id=?';
$values=[1];
$contact_r= mysqli_fetch_assoc(select($contact_q, $values,'i'));
// print_r($contact_r);
?>

<h2 class="mt-1 pt-4 mb-4 fw-bold h-font text-center fst-italic"> Контакты </h2>
<div class="container">
  <div class="row">
     <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
      <iframe class= "w-100 rounded" height="560px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2316.1081422883944!2d36.29841347670207!3d54.51395417265091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4134b95fc220539b%3A0x357b70d42eea1e4!2zMi3QuSDQotGD0LvRjNGB0LrQuNC5INC_0LXRgC4sIDEsINCa0LDQu9GD0LPQsCwg0JrQsNC70YPQttGB0LrQsNGPINC-0LHQuy4sIDI0ODAwMw!5e0!3m2!1sru!2sru!4v1728840679240!5m2!1sru!2sru"   loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

     </div>
    <div class="col-lg-4  col-md-4">
    <div class="bg-white p-4 rounded mb-4">
      <h5>Наш адрес </h5>
      <a href="#" class="d-inline-block mb-2 text-decoration-none text-dark">
      <i class="bi bi-geo-alt"></i> 248003, Россия, Калужская область, г. Калуга, 2-ой Тульский переулок, 1</a>
     </div>
     <div class="bg-white p-4 rounded mb-4">
      <h5>Позвоните нам  </h5>
      <a href="tel:+<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
       <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1']?></a>
       <br>
       
       <a href="tel:+<?php echo $contact_r['pn2']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
       <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn2']?></a>
     </div>
     <div class="bg-white p-4 rounded mb-4">
     <h5>Напишите нам  </h5>
     <a href="mailto:<?php echo $contact_r['email']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
     <i class="bi bi-envelope"></i> <?php echo $contact_r['email']?></a>
     </div>
      </span>
      </div>
   </div>
   
  </div>
</div>

<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-13 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2"> <?php echo $settings_r['site_title']?></h3>
      <?php echo $settings_r['site_about']?>
    
     </div>
  </div>
</div>


</div>
</div>

<?php require('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
    loop : true,
    autoplay: {

        delay: 3500,
        disableOnInteraction:false,
    }
    });
  </script>
</body>
</html>