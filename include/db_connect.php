<?php
  $mysqli  = mysqli_connect('localhost','root','','DBAutoAuk');
  if(!$mysqli){
    die("Підключення відсутнє:"  . mysqli_connect_error());
  }
 ?>
