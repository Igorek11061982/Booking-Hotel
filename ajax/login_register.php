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
















//  подтвержение пароля
if(isset($_POST['register']))
{

    $data=filteration($_POST);
    if ($data['pass']!=$data['cpass'])
    {
     echo 'pass_mismatch';
     exit;
    }


 $enc_pass= password_hash($data['pass'], PASSWORD_BCRYPT);
 $query="INSERT INTO `user_cred`(`name`, `email`, `surname`, `phonenum`, `dob`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
 $values=[$data['name'], $data['email'], $data['surname'], $data['phonenum'], $data['dob'], $enc_pass ];

 if (insert($query, $values, 'ssssss'))
  {
 echo 1;
  }
  else
  {
  echo'ins_failed';
  }
}


if(isset($_POST['login']))
{

$data=filteration($_POST);
  

$u_exist=select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email_mob'], $data['email_mob']], "ss" );


if (mysqli_num_rows($u_exist)==0)
{
echo 'inv_email_mob';
}



else{
    $u_fetch= mysqli_fetch_assoc($u_exist);
    if  ($u_fetch['status']==0)
    {
      echo 'inactive';
    }
    else{

    if (!password_verify($data['pass'], $u_fetch['password']))
     {

        echo'invalid_pass';
     }
     else {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['uId']=$u_fetch['id'];
        $_SESSION['uName']=$u_fetch['name'];
        $_SESSION['uSurname']=$u_fetch['surname'];
        $_SESSION['uPhone']=$u_fetch['phonenum'];
        echo 1;
        
     }
   }
  }
}


?>