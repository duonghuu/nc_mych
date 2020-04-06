<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$duongdan=$_SERVER['HTTP_REFERER'];
$url_back=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];


if($_SESSION['login_admin']['type']=='daily'){
	if($_SESSION['login_admin']['id']!=$id){
		transfer("Bạn không có quyền truy cập vào đây","index.php");
	}
}


switch($act){

	case "man":
		get_items();
		$template = "user_daily/items";
		break;
	case "add":		
		$template = "user_daily/item_add";
		break;
	case "edit":		
		get_item();
		$template = "user_daily/item_add";
		break;
	
	case "delete_img":
		delete_img();
		break;	
		
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	case "capnhat_info":
		get_info();
		$template = "user_daily/items";
		break;
		
	case "save_info":
		save_info();
		break;		
		
	#===================================================	
	
	default:
		$template = "index";
}

#====================================


function get_items(){
	global $d, $items, $paging,$urldanhmuc,$duongdan ,$url_link,$totalRows , $pageSize, $offset;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chon'];
		
		
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_user SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=user_daily&act=man");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){

				$sql = "UPDATE table_user SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=user_daily&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_user where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
			
				$sql = "delete from table_user where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=user_daily&act=man");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = @$_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_user where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	redirect($duongdan);	
	}
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['daily']!='')
	{
	$id_up = @$_REQUEST['daily'];
	$sql_sp = "SELECT id,daily FROM table_user where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['daily'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET daily =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET daily =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($duongdan);	
	}
	#-------------------------------------------------------------------------------

	
	
	//$sql = "select * from #_user where role='1' and com='member'";	
	
	if(@$_REQUEST['keyword']!='')
	{
		$keyword= addslashes($_REQUEST['keyword']);
		$where.=" and username LIKE '%$keyword%'";
	}
	
	

	
	
	
	$sql="SELECT count(id) AS numrows FROM #_user where role='3' and type='daily' $where ";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_user where  role='3' and type='daily' $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=user_daily&act=man".$urldanhmuc;

	
}

function get_item(){
	global $d, $item,$ds_tags, $city,$district;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=user_daily&act=man");	
	$sql = "select * from #_user where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=user_daily&act=man");
	$item = $d->fetch_array();

	$d->reset();
	$sql = "select ten_vi,id from table_city_list where id='".$item['tinh']."'";
	$d->query($sql); 
	$city = $d->fetch_array(); 
	
	$d->reset();
	$sql = "select ten_vi,id from table_city_cat where id='".$item['huyen']."'";
	$d->query($sql);
	$district = $d->fetch_array();
	
	

	
}

function save_item(){
	global $d,$config_url;
	$file_name=fns_Rand_digit(0,9,12);
	$file_name1=fns_Rand_digit(0,9,11);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=user_daily&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	

	
	if($id){
		$id =  themdau($_POST['id']);
		$data['id_daily'] = (int)$_POST['id_daily'];
		$data['username'] = $_POST['username'];
		


		if($_POST['email']!="" && ($_POST['email'] !=$_POST['email_old'] )  )
		{
			// kiem tra ten trung

			
			$d->reset();
			$d->setTable('user');
			$d->setWhere('email', $_POST['email']);
			$d->select();
			if($d->num_rows()>0) transfer("Email này đã tồn tại.<br>Xin chọn email khác.", "index.php?com=user_daily&act=edit&id=".$id);

			$data['email'] = $_POST['email'];
			
			
		}else{
			
						

			$data['email'] = $_POST['email_old'];
			

		}
				
				
				

		$data['hienthi'] = 1; //active tài khoản
		// Thay dổi mật khẩu
		if($_POST['matkhau']!=""){
			
			$data['password'] = md5($_POST['matkhau']);
			$daily = getInfoDaily($_POST['id_daily']);

			// gửi mail thông tin đăng nhập khi insert
			$d->setTable('setting');
			$d->select();
			$company_mail = $d->fetch_array();
			
			$d->reset();
			$sql_setting = "select * from #_setting limit 0,1";
			$d->query($sql_setting);
			$row_setting= $d->fetch_array();

			include_once "../phpMailer/class.phpmailer.php";	
			
			$mail = new PHPMailer();
			$mail->Priority = 1;
			$mail->AddCustomHeader("X-MSMail-Priority: High");		
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "banhangonline.mych@gmail.com";  // GMAIL username
			$mail->Password   = "Giabao123"; 
		    //Thiet lap thong tin nguoi gui va email nguoi gui
		    $mail->SetFrom($row_setting['email'],$row_setting['ten_'.$lang]);

			//Thiết lập thông tin người nhận
			$mail->AddAddress($daily['email'], $daily['ten_vi']);
			
			$mail->AddAddress($_POST['email'], $_POST['username']);

			//Thiết lập tiêu đề
			$mail->Subject    = 'Thay đổi mật khẩu đại lý';
			$mail->IsHTML(true);
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";	
			$body = "THÔNG TIN TÀI KHOẢN ĐẠI LÝ";
			$body .= "<br/>";
			$body .= "<br/>";
			$body .= "Tài khoản đăng nhập vào hệ thống của bạn như sau:";
			$body .= "<br/>";
			$body .= "Tên đăng nhập: ".$_POST['username'];
			$body .= "<br/>";
			$body .= "Mật khẩu: ".$_POST['matkhau'];
			$body .= "<br/>";
			$body .= "Link đăng nhập : http://".$config_url.'/admindaily';
			$body .= "<br/>";
			$body .= "<br/>";
			$body .= "Sau khi đăng nhập, bạn sẽ có thể thay đổi thông tin tài khoản, quản lý sản phẩm thuộc đại lý của bạn.";
			$body .= "<br/>";
			$body .= "<br/>";
			$body .= "Cảm ơn.";
			
			$mail->Body = $body;
			$mail->Send();

		}
		

		$data['ngaydangky'] = time();
		$data['role'] = 3;		
		$data['type'] = "daily";	

		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		if($d->update($data)){
			if($_SESSION['login_admin']['type']=='daily'){
				if(!empty($_POST['matkhau'])){
					transfer("Cập nhật mật khẩu mới thành công !<br>Vui lòng đăng nhập lại.", "index.php");
				}else{
					redirect("index.php");
				}
			}
			redirect("index.php?com=user_daily&act=man&curPage=".@$_REQUEST['curPage']."");
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user_daily&act=man");
		}
	}else{

		
	
		$data['id_daily'] = (int)$_POST['id_daily'];
		$data['username'] = $_POST['username'];
		$data['hienthi'] = 1; //active tài khoản
		
		// tạo pass ngẫu nhiên
		$random_pass = substr(md5(microtime()),rand(0,26),6);
		$data['password'] = md5($random_pass);

		// kiem tra ten trung
		$d->reset();
		$d->setTable('user');
		$d->setWhere('email', $_POST['email']);
		$d->select();
		if($d->num_rows()>0) transfer("Email này đã tồng tại.<br>Xin chọn email khác.", "index.php?com=user_daily&act=edit&id=".$id);

		$data['email'] = $_POST['email'];

		$data['ngaydangky'] = time();

		
		
		$data['role'] = 3;
		$data['type'] = "daily";						

		$daily = getInfoDaily($_POST['id_daily']);
		
		
		$data['ngaytao'] = time();
		$d->setTable('user');
		if($d->insert($data))
		{			
			// gửi mail thông tin đăng nhập khi insert
			$d->setTable('setting');
			$d->select();
			$company_mail = $d->fetch_array();
			
			
			$d->reset();
			$sql_setting = "select * from #_setting limit 0,1";
			$d->query($sql_setting);
			$row_setting= $d->fetch_array();
			
			
			
			include_once "../phpMailer/class.phpmailer.php";	
			
			$mail = new PHPMailer();
			$mail->Priority = 1;
			$mail->AddCustomHeader("X-MSMail-Priority: High");		
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "banhangonline.mych@gmail.com";  // GMAIL username
			$mail->Password   = "Giabao123"; 
		    //Thiet lap thong tin nguoi gui va email nguoi gui
		    $mail->SetFrom($row_setting['email'],$row_setting['ten_'.$lang]);

			//Thiết lập thông tin người nhận
			$mail->AddAddress($daily['email'], $daily['ten_vi']);
			
			$mail->AddAddress($_POST['email'], $_POST['username']);

			//Thiết lập tiêu đề
			$mail->Subject    = 'Cảm ơn bạn đã đăng ký làm đại lý';
			$mail->IsHTML(true);
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";	
			$body = "Chào mừng và cảm ơn bạn đã đăng ký làm đại lý !";
			$body .= "<br/>";
			$body .= "<br/>";
			$body .= "Tài khoản đăng nhập vào hệ thống của bạn như sau:";
			$body .= "<br/>";
			$body .= "Tên đăng nhập: ".$_POST['username'];
			$body .= "<br/>";
			$body .= "Mật khẩu: ".$random_pass;
			$body .= "<br/>";
			$body .= "Link đăng nhập : http://".$config_url.'/admindaily';
			$body .= "<br/>";
			$body .= "<br/>";
			$body .= "Sau khi đăng nhập, bạn sẽ có thể thay đổi thông tin tài khoản, quản lý sản phẩm thuộc đại lý của bạn.";
			$body .= "<br/>";
			$body .= "<br/>";
			$body .= "Cảm ơn.";
			
			$mail->Body = $body;
			$mail->Send();
			
		

			redirect("index.php?com=user_daily&act=man");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=user_daily&act=man");
	}
}

function delete_item(){
	global $d,$duongdan;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		
		$sql = "delete from #_user where id='".$id."'";
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "delete from #_user where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
}


function delete_img(){
	global $d;		
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_user where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_user_daily.$row['photo']);
				delete_file(_upload_user_daily.$row['thumb']);			
			}
		$sql = "UPDATE #_user SET photo ='',thumb='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=user_daily&act=edit&id=".$id);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=user_daily&act=edit&id=".$id);
	}else transfer("Không nhận được dữ liệu", "index.php?com=user_daily&act=edit&id=".$id);
}


#====================================



function get_info(){
	global $d, $item_type;


	$sql = "select * from #_info where com='$_GET[type1]' limit 0,1";
	$d->query($sql);
	$item_type = $d->fetch_array();
	

	if($d->num_rows()==0){
		$data['mota_vi']='';
		$data['noidung_vi']="Nội dung đang cập nhật...";
		$data['is_noindex'] = 1;
		$data['com']=$_GET['type1'];
		$d->setTable('info');
		if($d->insert($data)){
			$sql = "select * from #_info where com='$_GET[type1]' limit 0,1";
			$item_type = $d->fetch_array();
		}else{
			transfer("Dữ liệu chưa khởi tạo.", "index.php");
		}
	};
}


function save_info(){
	global $d,$url_back;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=user_daily&act=capnhat_info&type1=$_GET[type1]");
	$file_name=fns_Rand_digit(0,9,5);
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|doc|pdf|docx|DOC|DOCX|PDF',_upload_hinhanh,$file_name)){
		$data['photo'] = $photo;
		$d->setTable('info');			
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
	}
	
	

	
		
	
		$data['deschar_vi'] = magic_quote($_POST['deschar_vi']);	
		$data['deschar_en'] = magic_quote($_POST['deschar_en']);	
	
		$data['h1_vi'] = magic_quote($_POST['h1_vi']);	
		$data['h1_en'] = magic_quote($_POST['h1_en']);	
		$data['h2_vi'] = magic_quote($_POST['h2_vi']);	
		$data['h2_en'] = magic_quote($_POST['h2_en']);	
	
	
		$data['title_vi'] = magic_quote($_POST['title_vi']);
		$data['title_en'] = magic_quote($_POST['title_en']);
		$data['title_ge'] = magic_quote($_POST['title_ge']);
		$data['keyword_vi'] = magic_quote($_POST['keyword_vi']);
		$data['keyword_en'] = magic_quote($_POST['keyword_en']);
		$data['keyword_ge'] = magic_quote($_POST['keyword_ge']);
		$data['description_vi'] = magic_quote($_POST['description_vi']);
		$data['description_en'] = magic_quote($_POST['description_en']);
		$data['description_ge'] = magic_quote($_POST['description_ge']);
	
	
	
	$data['mota_vi'] = magic_quote($_POST['mota_vi']);
	$data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
	$data['ten_vi'] = magic_quote($_POST['ten_vi']);
	$data['ten_en'] = magic_quote($_POST['ten_en']);
	
	$data['tamnhin_vi'] = magic_quote($_POST['tamnhin_vi']);
	$data['sumenh_vi'] = magic_quote($_POST['sumenh_vi']);
	$data['trietlikinhdoanh_vi'] = magic_quote($_POST['trietlikinhdoanh_vi']);
	
	$data['mota_en'] = magic_quote($_POST['mota_en']);
	
	$data['noidung_en'] = magic_quote($_POST['noidung_en']);
	$data['mota_ge'] = magic_quote($_POST['mota_ge']);
	$data['noidung_ge'] = magic_quote($_POST['noidung_ge']);
	
	$data['is_noindex'] = isset($_POST['is_noindex']) ? 1 : 0;	
	//$data['com']=magic_quote($_GET['type1']);
	$d->reset();
	$d->setTable('info');
	$d->setWhere('com','user_daily');
	
	
		//echo($_POST["mota_vi"]);
	//die();
	
	if($d->update($data))
		transfer("Dữ liệu được cập nhật", $url_back);
	else
		transfer("Cập nhật dữ liệu bị lỗi", $url_back);
}



?>