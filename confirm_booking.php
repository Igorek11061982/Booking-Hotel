<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>KALUGA PLAZA OTEL - Бронирование</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    



</head>

<body class="bg-light">
<?php require('inc/header.php'); ?>

<?php





if(isset ($_GET['del']))
{

  $frm_data=filteration($_GET);
if ($frm_data['del']=='all')
{
  $q='DELETE FROM booking_date';
if (mysqli_query($con, $q))
{
alert('success', 'Сообщения удалены');

}
else
{
  alert('error', 'Операция не выполнена'); 
}
}
else 
{

  $q='DELETE FROM booking_date WHERE id=?';
  $values=[$frm_data['del']];
if (delete($q, $values, 'i'))
{
alert('success', 'Сообщение удалено');

}
else
{
  alert('error', 'Операция не выполнена'); 
}
}
}



if (!isset($_GET['id'])|| $settings_r['shutdown']==true)
{
redirect('rooms.php');

}
else if  (!(isset($_SESSION['login'])&&$_SESSION['login']==true))

{
  redirect('rooms.php');

}
$frm_data=filteration($_GET);
$room_res=select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$frm_data['id'], 1, 0], 'iii');

if (mysqli_num_rows($room_res)==0)
{
  redirect('rooms.php');

}

$room_data= mysqli_fetch_assoc($room_res);

$_SESSION ['room']= [

"id"=>$room_data['id'],
"name"=>$room_data['name'],
"price"=>$room_data['price'],
"payment"=>null,
"available"=>false,

];

$user_res=$u_exist=select("SELECT * FROM `user_cred` WHERE `id`=?  LIMIT 1", [$_SESSION['uId']], "i" );
$user_data= mysqli_fetch_assoc($user_res);
?>




<div class="container">
<div class="row">
<div class="col-12  my-5 mb-4 px-4">
<h2 class="fw-bold ">Подтверждение бронирования </h2>
<div style= "font-size: 14px;">
<a href="index.php" class="text-secondary text-decoration-none"> Домашняя страница </a>
<span class= "text-secondary">></span>
<a href="rooms.php" class="text-secondary text-decoration-none"> Номера </a>
<span class= "text-secondary">></span>
<a href="#" class="text-secondary text-decoration-none"> Подтверждение </a>
</div>
</div>

<div class="col-lg-7  col-md-12 px-4">


  <?php

  $room_thumb= ROOMS_IMG_PATH."thumbnail.jpg";
  $thumb_q= mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
  if (mysqli_num_rows($thumb_q)>0)
  {
  $thum_res= mysqli_fetch_assoc($thumb_q);
  $room_thumb=ROOMS_IMG_PATH.$thum_res['image'];

  }
 

  echo<<<data

 <div class = "card p-3 shadow-sm rouded">

  <img src="$room_thumb" class="img-fluid rounded mb-3">
  <h5> $room_data[name]</h5>
  <h6> ₽ $room_data[price]/сутки</h6>
 </div>

 data;

 ?>

</div>









<div class="col-lg-5  col-md-12 px-4">
 <div class="card border-0 shadow-sm mb-4 rounded-3" > 
  <div class="card-body" >

    <form action = "#" id="booking_form">
    <h5 class= "mb-3 text-center"> Личные данные </h5>
    </form>
    <div class="row">
    <div class="col-md-6 " >
     <label class="form-label">Имя</label>
    <input name= "name" type="text" value ="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
    </div>
    <div class="col-md-6 mb-3" >
     <label class="form-label">Фамилия</label>
    <input name= "surname" type="text" value ="<?php echo $user_data['surname'] ?>" class="form-control shadow-none" required>
    </div>
    <div class="col-md-6 mb-3" >
     <label class="form-label">Номер телефона</label>
    <input name= "phonenum" type="number" value ="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
    </div>
    <div class="col-md-6 mb-3" >
     <label class="form-label">Email</label>
    <input name= "email" type="email" value ="<?php echo $user_data['email'] ?>" class="form-control shadow-none" required>
    </div>
    <
    

   
    </div>
    </form>
  </div>
 </div>
</div>



<div class="card-body" >
    <form method="POST">
    <div class="row">   
     <h5 class="text-center"> Выбирите даты бронирования номера </h5>
     <div class="col-12 " >
     <label class="form-label">Дата заезда</label>
    <input name= "checkin"  type="date"  class="form-control shadow-none" required>
    </div>
    <div class="col-12" >
     <label class="form-label">Дата выезда</label>
    <input name= "checkout"  type="date"  class="form-control shadow-none" required>
    <button type="submit" name="send" class="btn w-100 text-white custom-bg shadow-none mb-3"> Забронировать </button>
    </div>
    </div>
    </form> 
    </div>
    <h5 class="text-center"> Данные по вашему бронированию </h5>

   <div class="table-responsive-md" style="height:150px; overflow-y:scroll;"> 
    
    <table class="table table-hover border">
      <thead class="sticky-top">
        <tr class="bg-primary text-light">
        <th scope="col">№ Брони</th>
        <th scope="col">Дата заезда</th>
        <th scope="col">Дата выезда</th>
        <th scope="col">Общее количество дней</th>
        <th scope="col"> Общая стоимость</th>
        <th scope="col">Название номера</th>
        <th scope="col"> Действие</th>
        </tr>
      </thead>
      <tbody>
        <?php








// $user_res=$u_exist=select("SELECT * FROM `user_cred` WHERE `id`=?  LIMIT 1", [$_SESSION['uId']], "i" );
// $user_data= mysqli_fetch_assoc($user_res);




         $q="SELECT*FROM `booking_date`WHERE `vis_name`= '$user_data[name]' ORDER BY `id` DESC";
         $data = mysqli_query($con, $q);
         $i=1;
         while($row = $data->fetch_assoc())
         {
          
          $seen='';
      

          $seen.="<a href='?del=$row[id] ' class= 'btn btn-sm  btn-danger'>  Отменить бронирование </a>";


         echo <<<query
          <tr>
          <td> $row[id]</td>
          <td> $row[checkin]</td>
          <td> $row[checkout]</td>
          <td> $row[dif]</td>
          <td> $row[payment]</td>
          <td> $row[room_name]</td>
            <td>
              $seen
          </td>
          </tr>
         query;
         $i++;
         }

         



        ?>

      </tbody>
</table>
   </div>

  











</div>
</div>



<?php









if(isset($_POST['send']))
{

$frm_data=filteration($_POST);
$checkin_date= new DateTime($frm_data['checkin']);
$checkout_date= new DateTime($frm_data['checkout']);
$count_days = date_diff($checkin_date, $checkout_date )->days;
$payment = $_SESSION['room']['price']*$count_days;
$roomName=$_SESSION ['room']['name'];


 if ($frm_data['checkin']>$frm_data['checkout'])
{
  alert('error', 'Выбирите корректную дату!');
 exit;
}
 else

  $q="INSERT INTO `booking_date`(`checkin`, `checkout`, `dif`, `payment`,`room_name`,  `vis_name`) VALUES (?,?,?,?,?,?)";

  $values=[$frm_data['checkin'], $frm_data['checkout'], $count_days, $payment, $roomName, $user_data['name']];

  $res = insert($q, $values, 'ssssss');

  if($res==1)
 {

 alert('success', 'Забронировано!');

 }
 else 
 {

 alert('error', 'Попробуйте позже!');

 }
 redirect('confirm_booking.php');

}



?>



<?php require('inc/footer.php'); ?>



</body>
</html>

