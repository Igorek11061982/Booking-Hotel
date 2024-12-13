<?php

// require('../admin/inc/db_config.php');
// require('../admin/inc/essentials.php');


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

//  подтвержение пароля
if(isset($_POST['register']))
{
  $data=filteration($_POST);

 if ($data['pass']!=$data['cpass'])
    {
      echo 'pass_mismatch';
      exit;
    }

// проверка пользователя на существование

// $u_exist = select ("SELECT * FROM `user_cred` WHERE `phonenum` = ? AND `email` = ?  LIMIT 1", [ $data[`email`], $data[`phonenum`]], "ss");

// if (mysqli_num_rows($u_exist)!=0)
// {

//     $u_exist_fetch = mysqli_fetch_assoc($u_exist);
//     echo ($u_exist_fetch['email']==$data['email']) ? 'email_already':'phone_already';
//     exit;

// }

$enc_pass= password_hash($data['pass'], PASSWORD_BCRYPT);
$query="INSERT INTO `user_cred`(`name`, `email`, `surname`, `phonenum`, `dob`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
$values=[$data['name'], $data['email'], $data['surname'], $data['phonenum'], $data['dob'], $enc_pass ];

 if (insert($query, $values, 'ssssss'))
 {
   echo 1;
 }
 else
    echo'ins_failed';
}
?>