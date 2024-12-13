<?php  

require('inc/essentials.php');
require('inc/db_config.php');
require('inc/script.php');
adminLogin();
if(isset ($_GET['seen']))
  {
  $frm_data=filteration($_GET);
  if ($frm_data['seen']=='all')
   {
    $q='UPDATE user_queries SET seen=?';
    $values=[1];
  if (delete($q, $values, 'i'))
    {
   alert('success', 'Все сообщение прочитано');

    }
  else
    {
       alert('error', 'Операция не выполнена'); 
    }
   }
  else 
   {
    $q='UPDATE user_queries SET seen=?  WHERE id=?';
    $values=[1,$frm_data['seen']];
  if (delete($q, $values, 'ii'))
    {
   alert('success', 'Сообщение прочитано');

    }
  else
    {
       alert('error', 'Операция не выполнена'); 
    }
   }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel-Номера
    </title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">
</head>
<body class= "bg-light">

<?php require('inc/header.php'); ?>
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden ">

<h3 class=mb-4>Номера</h3>


<div class="card border-0 shadow-sm mb-4" >
  <div class="card-body">
   <div class="text-end mb-4">
    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">   
      <i class="bi bi-plus-square"></i> Добавить
    </button>
  </div>

  <div class="table-responsive-lg" style="height:450px; overflow-y:scroll;"> 
   <table class="table table-hover border text-center">
      <thead>
        <tr class="bg-dark text-light">
          <th scope="col">№</th>
          <th scope="col">Название</th>
          <th scope="col">Площадь</th>
          <th scope="col">Вместимость</th>
          <th scope="col">Цена</th>
          <th scope="col">Оснащение</th>
          <th scope="col">Описание</th>
          <th scope="col">Статус</th>
          <th scope="col">Действие</th>
        </tr>
      </thead>
      <tbody id="room-data">
      </tbody>
   </table>
  </div> 
  </div>
</div>

</div> 
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Название номера</h5>
        <button type="button" class="btn-close shadow-n0ne" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="image-alert"></div>
        <div class="border-bottom border-3 pb-3 mb-3">
        <form id="add_image_form">
         <label class="form-label fw-bold">Добавить фото</label>
         <input type="file" name= "image"  accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
         <button  class="btn custom-bg text-white shadow-none">Добавить</button>
         <input type="hidden" name="room_id">
        </form>
        </div>
        <div class="table-responsive-lg" style="height:350px; overflow-y:scroll;"> 
         <table class="table table-hover border text-center">
      <thead>
        <tr class="bg-dark text-light sticky-top">
          <th scope="col" width=60%> Фото</th>
          <th scope="col">Выбор</th>
          <th scope="col">Удаление</th>
        </tr>
      </thead>
      <tbody id="room-image-data">
      </tbody>
   </table>
  </div> 
      </div>
    </div>
  </div>
</div>



<!-- <link rel="stylesheet" href="css/common.css"> -->


<div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <form id="add_room_form"  autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Добавить номер</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <div class="col-md-6 mb-3" >
        <label class="form-label fw-bold">Название</label>
        <input type="text" name= "name" class="form-control shadow-none" required>
      </div>
      <div class="col-md-6 mb-3" >
        <label class="form-label fw-bold">Площадь</label>
        <input type="number" min="1" name= "area" class="form-control shadow-none" required>
      </div>
      <div class="col-md-6 mb-3" >
        <label class="form-label fw-bold">Цена</label>
        <input type="number" min="1" name= "price" class="form-control shadow-none" required>
      </div>
      <div class="col-md-6 mb-3" >
        <label class="form-label fw-bold">Количество комнат</label>
        <input type="number" min="1" name= "quantaty" class="form-control shadow-none" required>
      </div>
      <div class="col-md-6 mb-3" >
        <label class="form-label fw-bold">Взрослых</label>
        <input type="number" min="1" name= "adult" class="form-control shadow-none" required>
      </div>
      <div class="col-md-6 mb-3" >
        <label class="form-label fw-bold">Детей </label>
        <input type="number" min="1" name= "children" class="form-control shadow-none" required>
      </div>
      <div class="col-9 mb-3">
      <label class="form-label fw-bold">Оснащение </label>
      <input type="text" name= "features" class="form-control shadow-none" required>
      </div>
      <div class="col-9 mb-3">
      <label class="form-label fw-bold">Описание </label>
      <textarea name="description"  rows= "4" class="form-control shadow-none" required></textarea>
      </div>
      <!-- <div class="mb-3" >
       <label class="form-label fw-bold">Картинка</label>
       <input type="file" name= "facility_picture"  accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
      </div>
      <div class="mb-3" >
       <label class="form-label">Описание</label>
       <textarea name= "facility_description" class="form-control shadow-none" rows="3"> </textarea>
      </div> -->
      <div class="modal-footer">
        <button type="reset"   class="btn text-secondary shadow-none" data-bs-dismiss="modal">Отменить</button>
        <button type="submit"  class="btn custom-bg text-white shadow-none">Применить</button>
      </div>
    </div>
  </form>
  </div>
</div>


<?php 
    require('inc/script.php'); 
?>

<script src="script/rooms.js"> </script>

</body>
</html>