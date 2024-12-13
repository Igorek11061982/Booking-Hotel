<?php  

require('inc/essentials.php');
require('inc/db_config.php');
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


// if(isset ($_GET['del']))
// {

//   $frm_data=filteration($_GET);
// if ($frm_data['del']=='all')
// {
//   $q='DELETE FROM user_queries';
// if (mysqli_query($con, $q))
// {
// alert('success', 'Сообщения удалены');

// }
// else
// {
//   alert('error', 'Операция не выполнена'); 
// }
// }
// else 
// {

//   $q='DELETE FROM user_queries WHERE id=?';
//   $values=[$frm_data['del']];
// if (delete($q, $values, 'i'))
// {
// alert('success', 'Сообщение удалено');

// }
// else
// {
//   alert('error', 'Операция не выполнена'); 
// }
// }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel-Гостиничные услуги
    </title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">
</head>
<body class= "bg-light">

<?php require('inc/header.php'); ?>
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden ">

<h3 class=mb-4>Гостиничные услуги</h3>

<div class="card border-0 shadow-sm mb-4" >
  <div class="card-body">

<div class="d-flex align-items-center justify-content-between mb-3">

<h5 class="card-title m-0"> Добавленные услуги </h5>
<button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">   
<i class="bi bi-plus-square"></i> Добавить
</button>
</div>

  <div class="table-responsive-md" style="height:250px; overflow-y:scroll;"> 
   <table class="table table-hover border">
      <thead>
        <tr class="bg-dark text-light">
          <th scope="col">№</th>
          <th scope="col">Картинка</th>
          <th scope="col">Название услуги</th>
          <th scope="col">Описание</th>
          <th scope="col">Действие</th>
        </tr>
      </thead>
      <tbody id="facilities-data">
        
      </tbody>
   </table>
</div> 


  </div>
</div>



</div> 
</div>
</div>


<!-- <link rel="stylesheet" href="css/common.css"> -->

<div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form id="facility_s_form" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Добавить гостиничную услугу</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <div class="mb-3" >
        <label class="form-label fw-bold">Название</label>
        <input type="text" name= "facility_name" class="form-control shadow-none" required>
      </div>
      <div class="mb-3" >
       <label class="form-label fw-bold">Картинка</label>
       <input type="file" name= "facility_picture"  accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
      </div>
      <div class="mb-3" >
       <label class="form-label">Описание</label>
       <textarea name= "facility_description" class="form-control shadow-none" rows="3"> </textarea>
      </div>
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
<script src="script/hotel_facilities.js"> </script>

</body>
</html>