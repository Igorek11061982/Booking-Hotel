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


if(isset ($_GET['del']))
{

  $frm_data=filteration($_GET);
if ($frm_data['del']=='all')
{
  $q='DELETE FROM user_queries';
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

  $q='DELETE FROM user_queries WHERE id=?';
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel-Отзывы клиетнов
    </title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">
</head>
<body class= "bg-light">

<?php require('inc/header.php'); ?>
<div class="container-fluid" id="main-content">
<div class="row">
<div class="col-lg-10 ms-auto p-4 overflow-hidden ">

<h3 class=mb-4>Отзывы клиентов</h3>




<div class="card border-0 shadow-sm mb-4" >
  <div class="card-body">

<div class="text-end mb-4">
<a href="?seen=all" class="btn btn-dark"> <i class="bi bi-check-all"></i> Все сообщения прочитаны! </a>
<a href="?del=all" class="btn btn-danger"> <i class="bi bi-trash"></i> Удалить все!   </a>
</div>

   <div class="table-responsive-md" style="height:250px; overflow-y:scroll;"> 
    
   <table class="table table-hover border">
      <thead class="sticky-top">
        <tr class="bg-dark text-light">
          <th scope="col">#</th>
          <th scope="col">Имя</th>
          <th scope="col">Email</th>
          <th scope="col">Тема сообщения</th>
          <th scope="col">Сообщение</th>
          <th scope="col">Дата</th>
          <th scope="col">Действие</th>
        </tr>
      </thead>
      <tbody>
        <?php
         $q='SELECT*FROM user_queries ORDER BY id DESC';
         $data = mysqli_query($con, $q);
         $i=1;
         while($row = $data->fetch_assoc())
         {
         $seen='';
        if ($row['seen']!=1)
        {

         $seen="<a href='?seen=$row[id] ' class= 'btn btn-sm  btn-primary'> Прочитано </a>";

        }
        $seen.="<a href='?del=$row[id] ' class= 'btn btn-sm  btn-danger'>  Удалить </a>";
         
         echo <<<query
          <tr>
          <td> $i</td>
          <td> $row[name]</td>
          <td> $row[email]</td>
          <td> $row[subject]</td>
          <td> $row[message]</td>
          <td> $row[date]</td>
          <td> $seen</td>
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



</div> 
</div>
</div>


<link rel="stylesheet" href="css/common.css">


<?php 
    require('inc/script.php'); 
?>


</body>
</html>