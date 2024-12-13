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

function filteration($data){
 foreach($data as $key=>$value){
 $value=trim($value);  //удаляет из строки начальные и конечные пробелы, а также управляющие символы \n, \r, \t. 
 $value=stripcslashes($value);
 $value=htmlspecialchars($value);
 $value=strip_tags($value);
 $data[$key]=$value;
 }
 return $data;
}
// Функция для выбора все данных из таблицы
function selectAll($table)
{
$con= $GLOBALS['con']; // переменная глобальной области видимости
$res=mysqli_query($con,  "SELECT * FROM $table");
return $res;
}


function select($sql, $values, $datatypes){

  $con= $GLOBALS['con'];
 //  подготавливаем запроса
  if ($stmt = mysqli_prepare($con, $sql))
 {
  // связывание параметров с метками(привязываем переменные к этому запросу)
   mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
 if (mysqli_stmt_execute($stmt))
 {
  //  получает результаты
   $res=mysqli_stmt_get_result($stmt);
   mysqli_stmt_close($stmt);
   return $res;
 }
   else
 {
  mysqli_stmt_close($stmt);
  die ("Query can't be executed-Select");
 }
 }
   else
 {
   die ("Query can't be prepared-Select");
 }
}



function update($sql, $values, $datatypes){



    $con= $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql))
    {
   
    mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
    if (mysqli_stmt_execute($stmt))
    {
    $res=mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $res;
    }
    else
    {
     mysqli_stmt_close($stmt);
     die ("Query can't be executed-Update");
    }
    }
    else
    {
    die ("Query can't be prepared-Update");
    }
   }

   



   
function insert($sql, $values, $datatypes)
 {

    $con= $GLOBALS['con'];
   //  подготавливаем запроса
    if ($stmt = mysqli_prepare($con, $sql))
    {
   // связывание параметров с метками(привязываем переменные к этому запросу)
     mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
    if (mysqli_stmt_execute($stmt))
    {
   //  получает результаты
     $res= mysqli_stmt_affected_rows($stmt);
     mysqli_stmt_close($stmt);
    return $res;
    }
    else
    {
     mysqli_stmt_close($stmt);
     die ("Query can't be executed-Insert");
    }
    }
    else
    {
    die ("Query can't be prepared-Insert");
    }
}

function delete($sql, $values, $datatypes){



    $con= $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql))
    {
   
    mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
    if (mysqli_stmt_execute($stmt))
    {
    $res=mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $res;
    }
    else
    {
     mysqli_stmt_close($stmt);
     die ("Query can't be executed-Delete");
    }
    }
    else
    {
    die ("Query can't be prepared-Delete");
    }
   }







   
?>


