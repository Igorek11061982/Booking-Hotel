<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>KALUGA PLAZA OTEL - CONTACT</title>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">




</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">  Контакты </h2>

<?php
$contact_q='SELECT * FROM contact_details WHERE id=?';
$values=[1];
$contact_r= mysqli_fetch_assoc(select($contact_q, $values,'i'));
// print_r($contact_r);
?>


<div class="container">
<div class="row">

<div class="col-lg-6 col-md-6 mb-5 px-4">
  <div class="bg-white rounded shadow p-4 ">
  <iframe class= "w-100 rounded mb-4" height="300px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2316.1081422883944!2d36.29841347670207!3d54.51395417265091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4134b95fc220539b%3A0x357b70d42eea1e4!2zMi3QuSDQotGD0LvRjNGB0LrQuNC5INC_0LXRgC4sIDEsINCa0LDQu9GD0LPQsCwg0JrQsNC70YPQttGB0LrQsNGPINC-0LHQuy4sIDI0ODAwMw!5e0!3m2!1sru!2sru!4v1728840679240!5m2!1sru!2sru"   loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <h5>Наш адрес </h5>
      <a href="<?php echo $contact_r['gmap']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
      <i class="bi bi-geo-alt"></i> <?php echo $contact_r['adress']?>
    </a>

      <h5 class= "mt-3"> Позвоните нам  </h5>
       <a href="tel:+<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1']?>
        </a>
       <br>
       <a href="tel:+<?php echo $contact_r['pn2']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
       <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn2']?>
      </a>
      
      <h5 class= "mt-3"> Напишите нам  </h5>
     <a href="mailto:<?php echo $contact_r['email']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
     <i class="bi bi-envelope"></i> <?php echo $contact_r['email']?>
    </a>

     
    </span>
</div>
</div>
<div class="col-lg-6 col-md-6 mb-5 px-4">
  <div class="bg-white rounded shadow p-4">
    <form method="POST">    
     <h5> Отправить сообщение </h5>
         <div class="mt-3">
            <label class="form-label" style = "font-weight: 500;">Имя</label>
            <input name="name" required type="text" class="form-control shadow-none">
         </div> 
         <div class="mt-3">
          <label class="form-label" style = "font-weight: 500;">Адрес электронной почты</label>
          <input name="email" required type="email" class="form-control shadow-none">
         </div> 
         <div class="mt-3">
          <label class="form-label" style = "font-weight: 500;">Тема сообщения</label>
          <input name="subject" required type="text" class="form-control shadow-none">
         </div> 
         <div class="mt-3">
          <label class="form-label" style = "font-weight: 500;">Сообщение</label>
          <textarea name="message" required class="form-control shadow-none" rows ="5" style="resize: none;">  </textarea>
        </div> 
          <button type="submit" name="send" class="btn text-white custom-bg mt-3"> Отправить </button>
    </form> 
  </div>
</div>
</div>
</div>

<?php

if(isset($_POST['send']))
{

$frm_data=filteration($_POST);

$q="INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";

$values=[$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

$res = insert($q, $values, 'ssss');

if($res==1)
{

alert('success', 'Сообщение отправлено!');

}
else 
{

alert('error', 'Try again later!');

}

}

?>




<?php require('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>
</html>