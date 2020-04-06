<?php if(!defined('_source')) die("Error");
if(!empty($_POST["nltval"])){

    if($_SESSION['nlttoken'] == $_POST['nlttoken']){ // refresh page
      unset($_SESSION['nlttoken']);
      header('location: '.getCurrentPageURL());
      exit();
    }else{
      $_SESSION['nlttoken'] = $_POST['nlttoken'];
      
      $noidung = trim(strip_tags($_POST["noidung"]));
      if(!empty($noidung) && !empty($_SESSION['thanks']["madon"])){

        $data["noidung"]=$noidung;
        $d->reset();
        $d->setTable("order");
        $d->setWhere("madonhang",$_SESSION['thanks']["madon"]);
        $d->update($data);
      }
      redirect("thank-you.html");
    }
  }
