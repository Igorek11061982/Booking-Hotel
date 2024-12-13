<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>KALUGA PLAZA OTEL - FACILITIES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  



</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>
<div class="my-5 px-4">
<h1 class="fw-bold h-font text-center fst-italic">  Гостиничные услуги </h1>
<div class="h-line bg-dark"> </div>
</div>

<div class="col-lg-12  col-md-12 px-5">
 <div class="card mb-4 bg-dark border-0 shadow">
  <div class="row g-0 p-3 align-items-center">
    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
      <img src="images/facilities/2.jpg" class="img-fluid rounded">
    </div>    
    <div class="col-md-4 px-lg-4 px-md-4 px-0">
      <h1 class="mb-2  text-light text-decoration-underline">Ресторан</h1>
      <div class="features mb-3">
       <h5 class="mb-1  text-danger">Гармоничное соединение различных форм от классического ресторана до пиццерии, позволят нашим гостям получить полное представление о многогранности кулинарного искусства.</h5>
      </div>
    </div>
  </div>
</div>

<div class="card mb-4 bg-dark border-0 shadow">
  <div class="row g-0 p-3 align-items-center">
  <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
      <img src="images/facilities/5.jpg" class="img-fluid rounded">
    </div>    
    <div class="col-md-4 px-lg-4 px-md-4 px-0">
      <h1 class="mb-2  text-light text-decoration-underline">Банный комплекс</h1>
      <div class="features mb-3">
      <h5 class="mb-1  text-danger">Бассейн, гидромассажная ванна, несколько типов бань с разными температурными режимами, разные виды массажа – это минимальный набор для нашего банного комплекса.</h5>
  </div>
</div>
</div>
</div>
<div class="card mb-4 bg-dark border-0 shadow">
  <div class="row g-0 p-3 align-items-center">
  <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
      <img src="images/facilities/6.jpg" class="img-fluid rounded">
    </div>    
    <div class="col-md-4 px-lg-4 px-md-4 px-0">
      <h1 class="mb-2  text-light text-decoration-underline">Конференц-зал</h1>
      <div class="features mb-3">
      <h5 class="mb-1  text-danger">Подойдет для различного вида мероприятий. Беспроводной высокоскоростной интернет, современное оборудование позволят с комфортом провести любое мероприятие  до 45 человек.</h5>
  </div>
</div>
</div>
</div>

<?php 
  $res= selectAll('facilities');
  $path=FACILITIES_IMG_PATH;
  while($row=mysqli_fetch_assoc($res)) // До тех пор пока в результате содержатся ряды, помещаем их в ассоциативный массив  
  {
  echo<<<data
    <div class="card mb-4 bg-dark border-0 shadow">
     <div class="row g-0 p-3 align-items-center">
       <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
      <img src="$path$row[picture]" class="img-fluid rounded">
      </div>  
      <div class="col-md-4 px-lg-4 px-md-4 px-0">
      <h1 class="mb-2  text-light text-decoration-underline"> $row[name] </h1>
      <div class="features mb-3">
      <h5 class="mb-1  text-danger">$row[description]</h5>
         </div>
      </div>
     </div>
    </div>
  data;
  }

?>

</div>
</div>

<?php require('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>
</html>