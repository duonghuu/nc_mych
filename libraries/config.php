<?php 
	/**
	 * NINA Framework
	 * Vertion 1.0
	 * Author NINA Co.,Ltd. (nina@nina.vn)
	 * Copyright (C) 2015 NINA Co.,Ltd. All rights reserved
	*/
	 
	if(!defined('_lib')) die("Error");
	function nettuts_error_handler($number, $message, $file, $line, $vars)
	{
		if ( ($number !== E_NOTICE) && ($number < 2048) ) {
			include 'templates/error_tpl.php';
			die();
		}
	}
	//set_error_handler('nettuts_error_handler');
	//error_reporting(0);

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$config_url=$_SERVER["SERVER_NAME"].'';
	$config['debug']=1;    #Bật chế độ debug dành cho developer
	$config['lang']="vi";
	$config_email="info@mych.vn";
	$config_pass="Q6PDItKx2";
	$config_ip="120.72.119.3";

	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'giadungmyc_db2';
	$config['database']['password'] = 'BhJi6ZctS';
	$config['database']['database'] = 'giadungmyc_db2';
	$config['database']['refix'] = 'table_';	

	// $config['database']['servername'] = 'localhost';
	// $config['database']['username'] = 'demo108_mych';
	// $config['database']['password'] = 'C4qM0KeNCu';
	// $config['database']['database'] = 'demo108_mych';
	// $config['database']['refix'] = 'table_';

	$config['name-active'] = "GIA DỤNG MY CHÂU";
	$config['tinh-active'] = "Hồ Chí Minh";
	$config['quan-active'] = "Quận 12";
	$config['tel-active'] = " 0908 724 241";
	$config['address-active'] = "A21 Tô Ký - KP1 - P.Đông Hưng Thuận, Quận 12, Hồ Chí Minh";
	$config['key_ghtk'] = '8711a3421aFCF5362e11607dEa4E6Cd4294Df518';

	$config_recaptcha="6Le8YKkUAAAAACm5RNHkoOmKmc5VvzlO6aCUfhEv";
	$config_secretkey="6Le8YKkUAAAAAHxleKOB6SC3U6XbJrytzeAfvyqv";