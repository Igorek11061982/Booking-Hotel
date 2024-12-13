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


   define('SITE_URL', 'http://127.0.0.1/Kurs');
   define('CAROUSEL_IMG_PATH', 'http://127.0.0.1/Kurs/images/carousel/');
   // define('CAROUSEL_IMG_PATH', SITE_URL.'images/carousel/');
   define ('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT']. '/Kurs/images/');
   define('CAROUSEL_FOLDER', 'carousel/');
   define('FACILITIES_IMG_PATH', 'http://127.0.0.1/Kurs/images/facilities/');
   define('FACILITIES_FOLDER', 'facilities/');
   define('ROOMS_IMG_PATH', 'http://127.0.0.1/Kurs/images/rooms/');
   define('ROOMS_FOLDER', 'rooms/');
   function adminLogin()
   {
    session_start();
    if( !(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true))
    {
   
       echo "
       <script>
       
       window.location.href='index.php';
       
       </script>";
       exit;
    }
   
   }
   
   function redirect($url)
   {
   
    echo "
    <script>
   
    window.location.href='$url';
   
     </script>";
    exit;
   }
   
   function alert($type, $msg){
      $bs_class=($type=="success")   ? "alert-succes":"alert-danger";
     echo <<<alert
     <div class="alert $bs_class  alert-dismissible fade show custom-alert" role="alert">
     <strong class="me-3">$msg</strong>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     alert;
   }
   
    function uploadImage($image, $folder)
    {
   
     $valid_mime = ['image/jpeg', 'image/png', 'image/webp' ];
     $img_mime = $image['type'];
     if (!in_array($img_mime, $valid_mime))
     {
       return 'inv_img'; //неправильный формат
     }
   
     else if (($image['size']/(1024*1024))>2)
     {
       return 'inv_size';// размер больше 2MB
     }
   
     else
     {
       $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
       $rname = 'IMG'.random_int(11111, 99999).".$ext";
       $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
       if(move_uploaded_file($image['tmp_name'], $img_path))
       {
         return $rname; 
       }
       else
       {
         return 'upd_failed';
       }
     }
    }
   
   
   function deleteImage($image, $folder )
   
    {
    if (unlink(UPLOAD_IMAGE_PATH.$folder.$image))
   
    {
   
    return true;
   
    }
   
    else
    {
      return false;
   
    }
   
    }
   
   


















   
date_default_timezone_set("Europe/Moscow");

  if(isset($_POST['check_availability']))
{

    $frm_data=filteration($_POST);

    $status = "";
    $result = "";

// вариации дата выезда и заезда
// $today_date = new DateTime();
// $today_date = $now->format('Y-m-d');

    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date= new DateTime($frm_data['check_in']);
    $checkout_date= new DateTime($frm_data['check_out']);
    if ($checkin_date==$checkout_date)
    {

        $status='check_in_out_equal';
        $result = json_encode(["status"=>$status]);

    }
    else if ($checkout_date < $checkin_date)
    {
       $status='check_out_earlier';
       $result = json_encode(["status"=>$status]);
    }
    else if ($checkin_date<$today_date)
    {
       $status='check_in_earlier';
       $result = json_encode(["status"=>$status]);
    }


// проверка возможности бронирования в зависимости от статуса

if ($status!='')
    {
       echo $result;
    }
else{
session_start();
$_SESSION['room'];

// проверка номера на доступность

$count_days = date_diff($checkin_date, $checkout_date )->days;
$payment = $_SESSION['room']['price']*$count_days;

$_SESSION['room']['payment']= $payment;
$_SESSION['room']['available']= true;
$result = json_encode(["status"=>'available', "days"=>$count_days, "payment"=> $payment]);
echo $result;
}
}
?>