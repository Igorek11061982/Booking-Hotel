<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();


if(isset($_POST['add_facility']))  //отправлена ли форма
{
  $frm_data=filteration($_POST);
  $img_r=uploadImage($_FILES['picture'], FACILITIES_FOLDER);

   if ($img_r=='inv_img')
    {
     echo $img_r;
    }

   else if($img_r=='inv_size')
    {
     echo $img_r;
    }
   else if($img_r=='upd_failed')
    {
     echo $img_r;
    }

   else 
    {

    $q="INSERT INTO `facilities`(`picture`, `name`, `description`) VALUES (?,?,?)";
    $values=[$img_r, $frm_data['name'], $frm_data['description']];
    $res=insert($q, $values, 'sss');
    echo $res;
    }

}

if (isset($_POST['get_facilities'])) 
{

  $res = selectAll('facilities');
  $i=1;
  $path=FACILITIES_IMG_PATH;
  while ($row = mysqli_fetch_assoc($res)) {
      echo <<<data
      <tr>
        <td>$i</td>
        <td><img src="$path$row[picture]" width="100px" </td>
        <td>$row[name]</td>
        <td>$row[description]</td>
        <td>
               <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none"> 
                УДАЛИТЬ
               </button>
        </td>
      </tr> 
    data;
    $i++;
  }
}

if (isset($_POST['rem_facility']))
 {

  $frm_data=filteration($_POST);
  $values=[$frm_data['rem_facility']];
  $pre_q ='SELECT * FROM facilities WHERE id=?';
  $res= select($pre_q, $values, 'i' );
  $img=mysqli_fetch_assoc($res);
   if(deleteImage($img['picture'], FACILITIES_FOLDER))
     {
        $q='DELETE FROM facilities WHERE id=?';
        $res=delete($q, $values,'i');
        echo $res; 
     }
  else{
         echo 0;
      }

 }




?>