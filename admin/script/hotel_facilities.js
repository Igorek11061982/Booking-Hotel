

  let facility_s_form=document.getElementById('facility_s_form'); // получаем форму по id

  facility_s_form.addEventListener('submit', function(e) // назначаем на submit обработчик события(вызываем метод submit, который отправляет форму)

  {
  e.preventDefault(); // отменяем стандартное поведение формы 
    add_facility();  
  }
  );

 function add_facility()
 {
 let data= new FormData(); // создаем объект 
 data.append('name', facility_s_form.elements['facility_name'].value); // отправка формы на сервер
 data.append('picture', facility_s_form.elements['facility_picture'].files[0]);
 data.append('description', facility_s_form.elements['facility_description'].value);
 data.append('add_facility','');

 let xhr= new XMLHttpRequest(); // у конструктора нет аргументов
 xhr.open("POST", "ajax/hotel_facilities.php", true); //конфигурируеv запрос, но непосредственно отсылается запрос только лишь после вызова send

 xhr.onload=function()
     {
      var myModal = document.getElementById('facility-s'); //открытие и закрытие модельного окна
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide()

      if(this.responseText=='inv_img')
          {
          alert('error', 'Only JPG and PNG images are allowed!');
          }
      else if (this.responseText=='inv_size')
          {
          alert('error', 'Image should be less than 2MB!');
          }
      else if (this.responseText=='upd_failed')
          {
          alert('error', 'Image upload failed!');
          }
      else  
          {
          alert('success', 'Добавлена новая услуга!');
          facility_s_form.reset();
          get_facilities();
          }
     }
     xhr.send(data);
 }

 function get_facilities()
  {
    let xhr= new XMLHttpRequest();
    xhr.open("POST", "ajax/hotel_facilities.php", true);

    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Устанавливаем заголовок для передачи данных в URL
    xhr.onload=function()
   {
    document.getElementById('facilities-data').innerHTML=this.responseText;
   }
    xhr.send('get_facilities');
  };


 function rem_facility(val)
 {
  let xhr= new XMLHttpRequest();
  xhr.open("POST", "ajax/hotel_facilities.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload=function()
 {
  if(this.responseText==1)
  {
    alert('success', 'Услуга удалена');
    get_facilities();
  }

  else if (this.responseText=='room added')
  
  {
    alert('error', 'Facility is added in room');

  }
  else
  {

    alert('error', 'Server down');

  }

  }
    xhr.send('rem_facility='+val);

  }



    window.onload=function()
    {
    
      get_carousel();
    }
  window.onload=function()
    {
      get_facilities();
    
    }


