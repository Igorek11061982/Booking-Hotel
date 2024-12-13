<?php  
 require('inc/script.php'); 
require('inc/essentials.php');
adminLogin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel-Параметры</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">
</head>
<body class= "bg-light">

<?php require('inc/header.php'); ?>
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden ">

<h3 class=mb-4>Параметры</h3>

<div class="card border-0 shadow-sm mb-4" >
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5 class="card-title m-0" > Основные параметры сайта</h5>
        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
          <i class="bi bi-pencil-square"></i> Редактировать
        </button>

    </div>
  
     <h6 class="card-subtitle mb-1 fw-bold ">Заголовок сайта</h6>
    <p class="card-text" id= "site_title"></p>
    <h6 class="card-subtitle mb-1 fw-bold ">О нас</h6>
    <p class="card-text" id= "site_about"></p>
  </div>
</div>

<div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
 <form id="general_s_form" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Основные параметры сайта</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
    <div class="mb-3" >
      <label class="form-label fw-bold">Заголовок сайта</label>
      <input type="text" name= "site_title" id= "site_title_inp" class="form-control shadow-none" required>
   </div>
   <div class="mb-3" >
   <label class="form-label fw-bold">О нас</label>
   <textarea name= "site_about" id= "site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
   </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="site_title.value=general_data.site_title, site_about.value=general_data.site_about"   class="btn text-secondary shadow-none" data-bs-dismiss="modal">Отменить</button>
        <button type="submit"   class="btn custom-bg text-white shadow-none">Применить</button>
      </div>
    </div>
    </form>
  </div>
</div>


<div class="card border-0 shadow-sm mb-4" >
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5 class="card-title m-0" > Отключение бронирования</h5>
      <div class="form-check form-switch">
        <form>
          <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox"  id="shutdown-toggle">
        </form>
      </div>

    </div>
      <!-- <p class="card-text" ></p>
       Бронирование временно недоступно -->
  </div>
</div>









<div class="card border-0 shadow-sm mb-4" >
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5 class="card-title m-0" > Контакты </h5>
        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
          <i class="bi bi-pencil-square"></i> Редактировать
        </button>
    </div>

      <div class="row">
       <div class="col-lg-6">
        <div class="mb-4">
        <h6 class="card-subtitle mb-1 fw-bold ">Адрес</h6>
        <p class="card-text" id= "adress"></p>
        </div>
 
        <div class="mb-4">
        <h6 class="card-subtitle mb-1 fw-bold ">Google карта</h6>
        <p class="card-text" id= "gmap"></p>
        </div>

        <div class="mb-4">
        <h6 class="card-subtitle mb-1 fw-bold ">Номера телефонов</h6>
        <p class="card-text mb-1" >
        <i class="bi bi-telephone-fill"></i>
        <span id= pn1></span>
        </p>
        <p class="card-text" >
        <i class="bi bi-telephone-fill"></i>
        <span id= pn2></span>
        </p>
        </div> 

        <div class="mb-4">
        <h6 class="card-subtitle mb-1 fw-bold ">Адрес электронной почты</h6>
        <p class="card-text" id= "email"></p>
        </div>
     
   
        <div class="mb-4">
        <h6 class="card-subtitle mb-1 fw-bold ">Социальные сети</h6>
        <p class="card-text mb-1" >
        <i class="bi bi-instagram me-1"></i>
        <span id= insta></span>
        </p>
        </div>
       </div>
    </div>
  </div>
</div>

<div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="contacts_s_form" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Контакты</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
       <div class="container-fluid p-0">
        <div class="row">
          <div class="col-md-6">
           <div class="mb-3" >
            <label class="form-label fw-bold">Адрес</label>
            <input type="text" name= "adress" id= "adress_inp" class="form-control shadow-none" required>
           </div>
          <div class="mb-3" >
            <label class="form-label fw-bold">Google карта</label>
            <input type="text" name= "gmap" id= "gmap_inp" class="form-control shadow-none" required>
           </div>
           <div class="mb-3" >
            <label class="form-label fw-bold">Номера телефонов</label>
             <div class="input-group mb-3">
             <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
             <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
             </div>
             <div class="input-group mb-3">
             <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
             <input type="number" name="pn2" id="pn2_inp" class="form-control shadow-none" >
             </div>
            <div class="mb-3" >
             <label class="form-label fw-bold">Адрес электронной почты</label>
             <input type="text" name= "email" id= "email_inp" class="form-control shadow-none" required>
           </div>
           </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3" >
             <label class="form-label fw-bold">Социальные сети</label>
             <div class="input-group mb-3">
             <span class="input-group-text"><i class="bi bi-instagram"></i></span>
             <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" required>
            </div>
          </div>
        </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="contacts_inp(contacts_data)"   class="btn text-secondary shadow-none" data-bs-dismiss="modal">Отменить</button>
        <button type="submit"   class="btn custom-bg text-white shadow-none">Применить</button>
      </div>
    </div>
    </form>
  </div>
</div>
 

</div> 
</div>
</div>


<link rel="stylesheet" href="css/common.css">


<?php 
    require('inc/script.php'); 
?>

<script src="script/setting.js"> </script>



   
</body>
</html>