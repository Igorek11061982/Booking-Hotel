<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="css/common.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php
session_start();

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

$contact_q = "SELECT * FROM `contact_details` WHERE `id`=?";
$settings_q="SELECT * FROM `settings` WHERE `id`=?";
$values = [1];
$contact_r= mysqli_fetch_assoc(select($contact_q, $values, 'i'));
$settings_r= mysqli_fetch_assoc(select($settings_q, $values, 'i'));

if ($settings_r['shutdown'])
{

echo<<<alertbar


<div class='bg-danger text-center p2 fw-bold'>
 Бронирование временно невозможно
</div>

alertbar;

}



?>