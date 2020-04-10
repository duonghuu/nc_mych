<?php	if(!defined('_source')) die("Error");
		unset($_SESSION["login"]);
    unset($_SESSION["daxem"]);
    unset($_SESSION["splike"]);
        transfer(_bandadangxuatthanhcong, "index.html");
?>