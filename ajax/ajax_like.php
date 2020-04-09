<?php

  session_start();
  error_reporting(E_ALL & ~E_NOTICE & ~8192);
  
  @define ( '_lib' , '../libraries/');
    
  include_once _lib."config.php";
  include_once _lib."constant.php";;
  include_once _lib."functions_giohang.php";
  include_once _lib."class.database.php";
    
  $d = new database($config['database']);

  
  if(isset($_POST['id'])){
    $id=$_POST['id'];
    if(isset($_SESSION['login']['id_tv']) && $_SESSION['login']['id_tv'] > 0){
      $s_idtv = $_SESSION['login']['id_tv'];
      $d->reset();
      $d->setTable("member");
      $d->setTable("id", $s_idtv);
      $d->select("splike");
      $ds_like = $d->fetch_array();

      $a_ds_like = explode(",", $ds_like["splike"]);
      if(in_array($id, $a_ds_like)){

      }else{

      }
    }
    
  }
  

?>