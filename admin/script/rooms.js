let add_room_form=document.getElementById('add_room_form');
add_room_form.addEventListener('submit', function(e) // назначаем на submit обработчик события(вызываем метод submit, который отправляет форму)

  {
  e.preventDefault(); // отменяем стандартное поведение формы 
    add_rooms();  
  }
  );

  function add_rooms()
  {
    let data= new FormData(); // создаем объект 
    data.append('name', add_room_form.elements['name'].value); // отправка формы на сервер
    data.append('area', add_room_form.elements['area'].value);
    data.append('price', add_room_form.elements['price'].value);
    data.append('quantaty', add_room_form.elements['quantaty'].value);
    data.append('adult', add_room_form.elements['adult'].value);
    data.append('children', add_room_form.elements['children'].value);
    data.append('features', add_room_form.elements['features'].value);
    data.append('description', add_room_form.elements['description'].value);
    data.append('add_rooms','');
    // data.append('picture', facility_s_form.elements['facility_picture'].files[0]);
  
    let xhr= new XMLHttpRequest(); // у конструктора нет аргументов
     xhr.open("POST", "ajax/rooms.php", true); //конфигурируеv запрос, но непосредственно отсылается запрос только лишь после вызова send

     xhr.onload=function()
        {
          var myModal = document.getElementById('add-room'); //открытие и закрытие модельного окна по id
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          if(this.responseText==1)
              {
                alert('успешно', 'Добавлен новый номер!');
                add_room_form.reset()
                get_rooms();
              }

          else  
              {
              alert('ошибка', 'Нет связи с сервером!'); 
              }
        }
         xhr.send(data);
  }

  function get_rooms()
  {
     let xhr= new XMLHttpRequest();
     xhr.open("POST", "ajax/rooms.php", true);

     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Устанавливаем заголовок для передачи данных в URL
     xhr.onload=function()
    {
    document.getElementById('room-data').innerHTML=this.responseText;
    }
    xhr.send('get_rooms');
  };

    window.onload=function()
    {
     get_rooms();
    
    }

    function toggle_status(id, val)
  {
      let xhr= new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms.php", true);

      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Устанавливаем заголовок для передачи данных в URL

      xhr.onload=function()
    {
      if(this.responseText==1)
    {

      alert('success', 'Статус переключен');
      get_rooms()
    }
    else  
    {
      alert('erro', 'Server down!'); 
    }
    }
      xhr.send('toggle_status='+id+'&value='+val);
  }

  window.onload=function()
    {
      get_rooms();
    
    }


  let add_image_form=document.getElementById('add_image_form');
  add_image_form.addEventListener('submit', function(e)
     { 
     e.preventDefault();
     add_image();
    }
   );


   function add_image()
{

 let data= new FormData();
 data.append('image', add_image_form.elements['image'].files[0]);
 data.append('room_id', add_image_form.elements['room_id'].value);
 data.append('add_image','');
 let xhr= new XMLHttpRequest();
 xhr.open("POST", "ajax/rooms.php", true);
 xhr.onload=function()
     {
      // var myModal = document.getElementById('carousel-s');
      // var modal = bootstrap.Modal.getInstance(myModal);
      // modal.hide()

      if(this.responseText=='inv_img')
          {
          alert('error', 'Тоько JPG и PNG расширения!','image-alert');
          }
      else if (this.responseText=='inv_size')
          {
          alert('error', 'Фото должно быть меньше чем 2MB!','image-alert');
          }
      else if (this.responseText=='upd_failed')
          {
          alert('error', 'Фото незагружено!','image-alert');
          }
      else  
          {
          alert('success', 'Добавлено новое фото!', 'image-alert');
          room_images(add_image_form.elements['room_id'].value, document.querySelector("#room-images .modal-title").innerText)
         add_image_form.reset();
         
     
          }
              
    }
       xhr.send(data);
   
}

function room_images(id, rname)
{
  document.querySelector("#room-images .modal-title").innerText=rname;
  add_image_form.elements['room_id'].value= id;
  add_image_form.elements['image'].value= '';

  let xhr= new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms.php", true);

    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Устанавливаем заголовок для передачи данных в URL

    xhr.onload=function()
   {
   document.getElementById('room-image-data').innerHTML=this.responseText;
   }
    xhr.send('get_room_images='+id);

}

function rem_image(img_id, room_id)
{

 let data= new FormData();
 data.append('image_id', img_id);
 data.append('room_id', room_id);
 data.append('rem_image','');
 let xhr= new XMLHttpRequest();
 xhr.open("POST", "ajax/rooms.php", true);
 xhr.onload=function()
     {
      // var myModal = document.getElementById('carousel-s');
      // var modal = bootstrap.Modal.getInstance(myModal);
      // modal.hide()

      if(this.responseText==1)
          {
            alert('удачно', 'Фото удалено!', 'image-alert');
            room_images(room_id, document.querySelector("#room-images .modal-title").innerText)
          }
     
      else  
          {
          alert('ошибка', 'Фото неудалено!', 'image-alert');

        
          }
              
    }
       xhr.send(data);
   
}

function thumb_image(img_id, room_id)
{

 let data= new FormData();
 data.append('image_id', img_id);
 data.append('room_id', room_id);
 data.append('thumb_image','');
 let xhr= new XMLHttpRequest();
 xhr.open("POST", "ajax/rooms.php", true);
 xhr.onload=function()
     {
      // var myModal = document.getElementById('carousel-s');
      // var modal = bootstrap.Modal.getInstance(myModal);
      // modal.hide()

      if(this.responseText==1)
          {
            alert('успешно', 'Изображение изменилось!', 'image-alert');
            room_images(room_id, document.querySelector("#room-images .modal-title").innerText)
          }
     
      else  
          {
          alert('ошибка', 'Изображение не изменилось!', 'image-alert');
       
         
     
          }
              
    }
       xhr.send(data);
   
}

function remove_room(room_id)
{
if (confirm("Вы уверены, что хотите удалить номер"))
{
  let data= new FormData();
  data.append('room_id', room_id);
  data.append('remove_room','');

  let xhr= new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);
  xhr.onload=function()
      {
    
  
       if(this.responseText==1)
           {
             alert('успешно', 'Номер удален!');
             get_rooms();
           }
      
       else  
           {
           alert('ошибка', 'Номер не удален!');

           }
               
     }
        xhr.send(data);

}
 
}

window.onload=function()
    {
      get_rooms();
    
    }


