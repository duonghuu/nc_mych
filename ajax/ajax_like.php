<?php

  session_start();
  error_reporting(0);
  
  @define ( '_lib' , '../libraries/');
    if(!isset($_SESSION['lang']))
    {
      $_SESSION['lang']='vi';
    }
    $lang=$_SESSION['lang'];
    if($lang=="")
    {
      $lang='vi';
    }
  include_once _lib."config.php";
  include_once _lib."constant.php";;
  include_once _lib."functions_giohang.php";
  include_once _lib."class.database.php";
    
  $d = new database($config['database']);
  $result = array();
  $a_ds_like = array();
  $result["class"] = "";
  if(isset($_POST['id'])){
    $id=$_POST['id'];
    // {"class":"active","ds_like":null,"key":false,"ds":["","4409"]}
    if(isset($_SESSION['login']['id_tv']) && $_SESSION['login']['id_tv'] > 0){
      $s_idtv = $_SESSION['login']['id_tv'];
      $d->reset();
      $d->setTable("member");
      $d->setWhere("id", $s_idtv);
      $d->select("splike");
      $ds_like = $d->fetch_array();
      if(!empty($ds_like["splike"]))
        $a_ds_like = explode(",", $ds_like["splike"]);
      $key = array_search($id, $a_ds_like);
      $result["a_ds_like"] = $a_ds_like;
      $result["key"] = $key;
      if(!is_null($key) && $key !== false){
        unset($a_ds_like[$key]);
      }else{
        array_push($a_ds_like, $id);
        $result["class"] = "active";
      }
      $data = array();
      $data["splike"] = implode(',', $a_ds_like);
      $d->reset();
      $d->setTable("member");
      $d->setWhere("id", $s_idtv);
      $d->update($data);

      $_SESSION["splike"] = $a_ds_like;

    }
    
  }
  $result["ds"] = $a_ds_like;
  echo json_encode($result);

?>