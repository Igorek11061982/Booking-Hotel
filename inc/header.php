

<nav id="nav-bar"class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
      <a class="navbar-brand me 5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title'] ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
      <a class="nav-link  me-2"  href="index.php">Домашняя страница</a>
      </li>
      <li class="nav-item">
      <a class="nav-link me-2" href="rooms.php">Номера</a>
      </li>
      <li class="nav-item">
      <a class="nav-link me-2" href="facilities.php"> Гостиничные услуги</a>
      </li>
      <li class="nav-item">
      <a class="nav-link me-2" href="contact.php"> Контакты</a>
      </li>
      </ul>
  <div class="d-flex">
    <?php
if (isset($_SESSION['login'])&&$_SESSION['login']==true)

{

  echo <<<data
   <div class="btn-group">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    $_SESSION[uName]
    </button>
    <ul class="dropdown-menu dropdown-menu-lg-end">
    <li><a class="dropdown-item" href="profile.php">Профиль</a></li>
    <li><a class="dropdown-item" href="bookings.php">Бронирование</a></li>
    <li><a class="dropdown-item" href="logout.php">Выход</a></li>
   </ul>
  </div>

  data;


}
else  {

  echo <<<data
     <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
      Ввойти
      </button>
      <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
      Зарегистрироваться
      </button>
  data;


}
    ?>

    
      </div>
    </div>
  </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="login-form">
          <div class="modal-header">
           <h5 class="modal-title d-flex align-items-center">
           <i class="bi bi-person-circle fs-3 me-2"></i> Войти в аккаунт
           </h5>
           <button type="reset" class="btn-close shadom-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
     
  <div class="modal-body">
   <div class="mb-3">
      <label class="form-label">Email/Номер телефона</label>
       <input type="text" name="email_mob" required class="form-control shadow-none">
    </div> 

   <div class="mb-4">
      <label class="form-label">Пароль</label>
       <input type="password" name="pass" required class="form-control shadow-none">
    </div> 

   <div class="d-flex align-items-center justify-content-between mb-2">
     <button type="submit" class="btn btn-dark shadow-none"> Войти </button>
     <a href="javascript: void(0)" class= "text-secondary text-decoration-none">Забыли пароль? </a>
   </div>
  </div>

      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form id="register-form">
          <div class="modal-header">
           <h5 class="modal-title d-flex align-items-center">
           <i class="bi bi-person-lines-fill fs-3 me-2"></i>  Регистрация пользователя
             </h5>
        <button type="reset" class="btn-close shadom-none" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
     
      <div class="modal-body"> 
  

  <div class="container-fluid" >
   <div class="row" >
   <div class="col-md-6 ps-0 mb-3" >
   <label class="form-label">Имя</label>
   <input name= "name" type="text" class="form-control shadow-none" required>
   </div>
   <div class="col-md-6 p-0" >
   <label class="form-label">Фамилия</label>
   <input name= "surname" type="text" class="form-control shadow-none" required>
   </div>
   <div class="col-md-6 ps-0 mb-3" >
   <label class="form-label">Адресс электронной почты</label>
   <input name= "email" type="email" class="form-control shadow-none" required>
   </div>
   <div class="col-md-6 p-0 " >
   <label class="form-label">Номер телефона</label>
   <input name= "phonenum" type="number" class="form-control shadow-none" required> 
   </div>

   <div class="col-md-12 ps-0 mb-3" >
   <label class="form-label">Дата рождения</label>
   <input name= "dob" type="date" class="form-control shadow-none" required>
   </div>


   <div class="col-md-6 ps-0 mb-3" >
   <label class="form-label">Пароль</label>
   <input name= "pass" type="password" class="form-control shadow-none" required>
   </div>

   <div class="col-md-6 p-0 mb-3" >
   <label class="form-label">Подтвердите пароль</label>
   <input name= "cpass" type="password" class="form-control shadow-none" required>
   </div>

   </div>
   </div>

  <div class = "text-center my-1">
  <button type="submit" class="btn btn-dark shadow-none"> Зарегистрироваться </button>
</div>

       <!-- <div class="mb-3">
         <label class="form-label">Email address</label>
         <input type="email" class="form-control shadow-none">
       </div> 

       <div class="mb-4">
         <label class="form-label">Password</label>
         <input type="password" class="form-control shadow-none">
       </div> 

    <div class="d-flex align-items-center justify-content-between mb-2">
    <button type="submit" class="btn btn-dark shadow-none"> Login </button>
    <a href="javascript: void(0)" class= "text-secondary text-decoration-none"> Forgot Password? </a>
         </div> -->
       </div>
      </form>
    </div>
  </div>
</div>