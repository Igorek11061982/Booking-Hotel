<?php  
$hname='localhost';
$uname='root';
$pass='';
$db='kurs';
// соединение с базой данных
$con = mysqli_connect($hname, $uname, $pass, $db); 

if(!$con)

 {
   die ("Can't connect to database". mysqli_connect_error());
 }

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


require('inc/essentials.php');
adminLogin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel-Карусель
    </title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">
</head>
<body class= "bg-light">
<?php require('inc/header.php'); ?>
<div class="container-fluid" id="main-content">
 <div class="row">
  <div class="col-lg-10 ms-auto p-4 overflow-hidden ">
      <h3 class=mb-4>Бронирование</h3>
      <div class="table-responsive-md" style="height:150px; overflow-y:scroll;"> 
          <table class="table table-hover border">
            <thead class="sticky-top">
              <tr class="bg-dark text-light">
              <th scope="col">№ Брони</th>
              <th scope="col">Имя</th>
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

              $q='SELECT*FROM booking_date ORDER BY id DESC';
              $data = mysqli_query($con, $q);
              $i=1;
              while($row = $data->fetch_assoc())
              {
                $seen='';
            
                $seen.="<a href='?del=$row[id] ' class= 'btn btn-sm  btn-danger'>  Удалить бронирование </a>";

              echo <<<query
                <tr>
                <td> $row[id]</td>
                <td> $row[vis_name]</td>
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
          </table>
        </div>     
  </div> 
 </div>
</div>

<link rel="stylesheet" href="css/common.css">
<?php 
    require('inc/script.php'); 
?>
<script src="script/carousel.js"> </script>
</body>
</html>