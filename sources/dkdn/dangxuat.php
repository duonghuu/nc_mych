<?php	if(!defined('_source')) die("Error");
		unset($_SESSION["login"]);
    unset($_SESSION["daxem"]);
    unset($_SESSION["splike"]);
    unset($_SESSION["spview"]);
        transfer(_bandadangxuatthanhcong, "index.html");
?>