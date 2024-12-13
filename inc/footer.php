<h6 class="text text-center bg-dark text-white p-3 m-0"> Разработан и создан Власовым И.Н.</h6>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>





<script>



function alert(type,msg, position='body')
{
   let bs_class = (type == 'success')  ? 'alert-success' : 'alert-danger';
   let element = document.createElement('div');
   element.innerHTML = `
   <div class="alert  ${bs_class} alert-dismissible fade show " role="alert">
   <strong class="me-3">${msg}</strong>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   `;
    if (position=='body'){
    document.body.append(element);
    element.classList.add('custom-alert');
     }

   else{

    document.getElementById(position).appendChild(element);

    }


}










let register_form=document.getElementById('register-form')

register_form.addEventListener('submit', (e)=>
{

 e.preventDefault();
 let data = new FormData();
 data.append('name', register_form.elements['name'].value);
 data.append('surname', register_form.elements['surname'].value);
 data.append('email', register_form.elements['email'].value);
 data.append('phonenum', register_form.elements['phonenum'].value);
 data.append('dob', register_form.elements['dob'].value);
 data.append('pass', register_form.elements['pass'].value);
 data.append('cpass', register_form.elements['cpass'].value);
 data.append('register', '');

 var myModal = document.getElementById('registerModal'); //открытие и закрытие модельного окна по id
 var modal = bootstrap.Modal.getInstance(myModal);
 modal.hide();

 let xhr= new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload=function()
   {
   
 if (this.responseText=='pass_mismatch')
  {
 alert('ошибка', 'Пароли не совпадают');
  }

    // else if(this.responseText='email_already')
    // {

    //     alert('ошибка', 'Email уже существует');

    // }


    // else if(this.responseText='phone_already')
    // {

    //     alert('ошибка', 'Номер телефона уже существует');

    // }


    // else if(this.responseText='ins_failed')
    // {

    //     alert('ошибка', 'Регистрация невозможна');

    // }

  else 
  {

    alert('успешно', 'Регистрация выполнена успешно');
    register_form.reset();

  }



   }
    xhr.send(data);



 }

);

let login_form=document.getElementById('login-form')


login_form.addEventListener('submit', (e)=>
{

 e.preventDefault();
 let data = new FormData();
 data.append('email_mob', login_form.elements['email_mob'].value);
 data.append('pass', login_form.elements['pass'].value);
 data.append('login', '');

 var myModal = document.getElementById('loginModal'); //открытие и закрытие модельного окна по id
 var modal = bootstrap.Modal.getInstance(myModal);
 modal.hide();

 let xhr= new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload=function()
   {
   
     if (this.responseText=='inv_email_mob')
      {
     alert('ошибка', 'Ваш Email  или Номер  неверные');
      }

    else if(this.responseText=='inactive')
    {

        alert('ошибка', 'Действие учетной записи приостановлено');

    }


    else if(this.responseText=='invalid_pass')
    {

        alert('ошибка', 'Неверный пароль');

    }


    else 
    {

      window.location=Window.location.pathname;

    }



   }
    xhr.send(data);

  }
);

function checkLoginToBook(status, room_id)
{
if (status)
{

    window.location.href='confirm_booking.php?id='+room_id;
}
    else{

     alert  ('ошибка', 'Пожалуйста зарегистрируйтесь для бронирования')

    }

}




 setActive();
</script>



<style>
.custom-alert
{
position: fixed;
top: 80px;
right: 25px;
z-index: 1111;
}


</style>