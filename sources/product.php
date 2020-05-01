<?php  if(!defined('_source')) die("Error");
if($com=='deal-gia-soc'){
	if($thoigianden <= time() ) {
		redirect('http://'.$config_url.'/404.php');
	}
}
@$idc =  addslashes($_GET['idc']);
@$idl =  addslashes($_GET['idl']);
@$idi =  addslashes($_GET['idi']);
@$ids =  addslashes($_GET['ids']);
@$id=  addslashes($_GET['id']);
		#các sản phẩm khác======================
if($id!=''){
	$d->reset();
	$sql= "select noidung_$lang from #_company where type='vchuyen'";
	$d->query($sql);
	$row_vchuyen = $d->fetch_array();
	$d->reset();
	$sql= "select noidung_$lang from #_company where type='van-chuyen'";
	$d->query($sql);
	$row_vanchuyen = $d->fetch_array();
	$sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE tenkhongdau ='".$id."'";
	$d->query($sql_lanxem);
	$d->reset();
	$sql_detail = "select * from #_product where hienthi=1 and type='".$type_bar."' and tenkhongdau='".$id."'";
	$d->query($sql_detail);
	$row_detail = $d->fetch_array();
	if($row_detail['id_user']){
		$d->reset();
		$sql = "select * from #_user where id = '".$row_detail['id_user']."' ";
		$d->query($sql);
		$user_post = $d->fetch_array();
	}
	$id_listhome=$row_detail["id_list"];
	$id_cathome=$row_detail["id_cat"];
	$id_itemhome=$row_detail["id_item"];
	daxem($row_detail["id"]);
	$a_ds_view = array();
	if(isset($_SESSION["login"]) && $_SESSION["login"]["id_tv"]>0){
			
		  $s_idtv = $_SESSION['login']['id_tv'];
		  $d->reset();
		  $d->setTable("member");
		  $d->setWhere("id", $s_idtv);
		  $d->select("spview");
		  $ds_view = $d->fetch_array();
		  if(!empty($ds_view["spview"]))
		    $a_ds_view = explode(",", $ds_view["spview"]);
		  $key = array_search($row_detail["id"], $a_ds_view);
		  if(!is_null($key) && $key !== false){
		    // unset($a_ds_view[$key]);
		  }else{
		  	$count = count($a_ds_view);
  	    if($count>=20)
  	        array_shift($a_ds_view);
  	    $a_ds_view[] = $row_detail["id"];
		    // array_push($a_ds_view, $row_detail["id"]);
		  }
		  $data = array();
		  $data["spview"] = implode(',', $a_ds_view);
		  $d->reset();
		  $d->setTable("member");
		  $d->setWhere("id", $s_idtv);
		  $d->update($data);

		  $_SESSION["spview"] = $a_ds_view;

	}
	$d->reset();
	$sql_detail = "select * from #_product_list where hienthi=1 and id='".$row_detail['id_list']."' and type='".$type_bar."'  ";
	$d->query($sql_detail);
	$row_detail_list = $d->fetch_array();
	$d->reset();
	$sql_cat = "select * from #_product_cat where hienthi=1 and id='".$row_detail['id_cat']."' and type='".$type_bar."'  ";
	$d->query($sql_cat);
	$row_detail_cat = $d->fetch_array();
	$d->reset();
	$sql_item = "select * from #_product_item where hienthi=1 and id='".$row_detail['id_item']."' and type='".$type_bar."'  ";
	$d->query($sql_item);
	$row_detail_item = $d->fetch_array();
	$bredrum='<ul class="line_breadrum">
	<li><a href="./">Trang chủ</a></li>';
	if($com!='deal-gia-soc'){
		$bredrum.='<li><a href="'.$row_detail_list['tenkhongdau'].'">'.$row_detail_list['ten_vi'].'</a></li>
		<li><a href="'.$row_detail_list['tenkhongdau'].'/'.$row_detail_cat['tenkhongdau'].'">'.$row_detail_cat['ten_vi'].'</a></li>
		<li><a href="'.$row_detail_list['tenkhongdau'].'/'.$row_detail_cat['tenkhongdau'].'/'.$row_detail_item['tenkhongdau'].'">'.$row_detail_item['ten_vi'].'</a></li>';	
	}	 
	$bredrum.='<li><span>'.$row_detail['ten_vi'].'</span></li>
	</ul>';
			//màu sắc 
	$d->reset();
	$sql_detail = "select * from #_mausp where id_product='".$row_detail['id']."'";
	$d->query($sql_detail);
	$row_mausp = $d->result_array();
	$d->reset();
	$sql = "select id,thumb,ten_$lang,giaban,tenkhongdau,giacu,thuoctinh,trongluong,rate,total from #_product where hienthi=1 and type='".$type_bar."' and banchay=1 order by stt,ngaytao desc";
	$d->query($sql);
	$product_banchay = $d->result_array();
	$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
	$share_facebook .= '<meta property="og:type" content="website" />';
	$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
	$share_facebook .= '<meta property="og:description" content="'.$row_detail['mota_'.$lang].'" />';
	$share_facebook .= '<meta property="og:locale" content="vi" />';
	$share_facebook .= '<meta property="og:image" content="http://'.$config_url.'/'._upload_product_l.$row_detail['photo'].'" />';
	$d->reset();
	$sql = "select * from #_product_photo where hienthi=1 and id_product='".$row_detail["id"]."' and type='".$type_bar."' order by stt,id desc";
	$d->query($sql);
	$hinhanh = $d->result_array();
	$d->reset();
	$sql = "select ten_vi,id,tenkhongdau,photo from #_baiviet where hienthi=1 and id_item='".$row_detail["id"]."' and type='".$type_bar."' order by stt,id desc";
	$d->query($sql);
	$hinhmau = $d->result_array();
	$chuoi = $row_detail['ten_'.$lang];
			//print_r('Tên :'.$chuoi .'<br />');
	$chuoi1 = explode(' ',$chuoi);
	$noichuoi = $chuoi1[0].' '.$chuoi1[1].' '.$chuoi1[2];
			//print_r($noichuoi);
	$d->reset();
	$sql_detail = "select id,thumb,ten_$lang,giaban,tenkhongdau,giacu,luotxem,luotxem2,photo,gia from #_product where hienthi=1 and type='".$type_bar."' and ten_$lang like'%$noichuoi%' and id!='".$row_detail['id']."'  order by stt,ngaytao desc  limit 0,60";
	$d->query($sql_detail);
	$product_cungloai = $d->result_array();
			// /print_r($product);
	$d->reset();
	$sql = "select id,thumb,ten_$lang,giaban,tenkhongdau,giacu,luotxem,luotxem2,photo,gia from #_product where hienthi=1 and type='".$type_bar."' and id!='".$row_detail['id']."' and id_item='".$row_detail['id_item']."' limit 0,60 ";
	$d->query($sql);
	$product_cungnganh = $d->result_array();
	$title_bar .= $row_detail['title'];
	$keyword_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
} elseif($idl!=''){
	$d->reset();
	$sql = "select id,ten_$lang,tenkhongdau from #_product_list where hienthi=1 and type='product' and tenkhongdau='".$idl."'";
	$d->query($sql);
	$row_detail = $d->fetch_array();
	$d->reset();
	$sql = "select id,ten_$lang,tenkhongdau,thumb from #_product_cat where hienthi=1 and type='product' and id_list='".$row_detail['id']."' order by stt,ngaytao desc";
	$d->query($sql);
	$row_item_tt = $d->result_array();
	$per_page = 30; 
			// Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " #_product where hienthi=1 and type='product' and id_list='".$row_detail['id']."'";
	$where .= $where_tk;
	if($_GET['sort']!=''){
		if($_GET['sort']=='price_DESC'){
			$where .= " order by giaban desc ";
		}else{
			$where .= " order by giaban ";
		}
	}else{
		if(empty($_GET["page"])){
			$where .= " order by RAND () ";	
		}
	}
	$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,thongtin_en,thuoctinh,trongluong,rate,total,photo,gia from $where $limit";
	$d->query($sql);
	$page_rs = $d->result_array();
	$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,
	thongtin_en,thuoctinh,trongluong,rate,total,photo,gia,luotxem2,luotxem from $where $limit";
	$d->query($sql);
	$product = $d->result_array();
	$id_listhome=$row_detail["id"];
	$url = getCurrentPageURL();
			// $url = $com."/".$row_detail["tenkhongdau"];
	$paging2 = pagination($where,$per_page,$page,$url);
			// $paging_arr = paging_home($page_rs, $url, $_GET["page"], $per_page, 10, 'pagination');
			// $product = $paging_arr["source"];
			// $paging = $paging_arr["paging"];
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keyword_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
} elseif($idc!=''){
	$d->reset();
	$sql = "select id,ten_$lang,tenkhongdau,id_list from #_product_cat where hienthi=1 and type='product' and tenkhongdau='".$idc."'";
	$d->query($sql);
	$row_detail = $d->fetch_array();
			//echo $template;
	$d->reset();
	$sql = "select id,ten_$lang,tenkhongdau from #_product_list where hienthi=1 and type='product' and id='".$row_detail['id_list']."'";
	$d->query($sql);
	$row_detail_list = $d->fetch_array();
	$d->reset();
	$sql = "select id,ten_$lang,tenkhongdau,thumb from #_product_item where hienthi=1 and type='product' and id_cat='".$row_detail['id']."' and id_list = '".$row_detail_list['id']."' order by stt,ngaytao desc";
	$d->query($sql);
	$row_item_tt = $d->result_array();
			//dump($row_detail['id']);
			//dump($row_item_tt);
	$where = " #_product where hienthi=1 and type='product' and id_cat='".$row_detail['id']."' ";
	$per_page = 30; 
			// Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where .= $where_tk;
	if($_GET['sort']!=''){
		if($_GET['sort']=='price_DESC'){
			$where .= " order by giaban desc ";
		}else{
			$where .= " order by giaban ";
		}
	}else{
		if(empty($_GET["page"])){
			$where .= " order by RAND () ";	
		}
	}
	$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,
	thongtin_en,thuoctinh,trongluong,rate,total,photo,luotxem2,luotxem from $where $limit";
	$d->query($sql);
	$product = $d->result_array();
	$url = getCurrentPageURL();
	// $paging = pagination($where,$per_page,$page,$url);
	$paging2 = pagination($where,$per_page,$page,$url);
	$id_listhome=$row_detail_list["id"];
	$id_cathome=$row_detail["id"];
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keyword_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
} elseif($idi!=''){
	$d->reset();
	$sql = "select id,id_list,id_cat,ten_$lang,tenkhongdau from #_product_item where hienthi=1 and type='product' and tenkhongdau='".$idi."'";
	$d->query($sql);
	$row_detail = $d->fetch_array();
	$per_page = 30; 
			// Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " #_product where hienthi=1 and type='product' and id_item='".$row_detail['id']."'";
	$where .= $where_tk;
	if($_GET['sort']!=''){
		if($_GET['sort']=='price_DESC'){
			$where .= " order by giaban desc ";
		}else{
			$where .= " order by giaban ";
		}
	}else{
		if(empty($_GET["page"])){
			$where .= " order by RAND () ";	
		}
	}
	$sql = "select * from $where $limit";
	$d->query($sql);
	$product = $d->result_array();
	$id_listhome=$id_list["id_list"];
	$id_cathome=$row_detail["id_cat"];
	$id_itemhome=$row_detail["id"];
	$url = getCurrentPageURL();
	// $paging = pagination($where,$per_page,$page,$url);
	$paging2 = pagination($where,$per_page,$page,$url);
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keyword_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
} else {
	$where = " #_product where hienthi=1 and type='product' ";
	$per_page = 30; 
			// Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	if($_GET['thongtin']!=''){
		$thongtin_tk = $_GET['thongtin'];
		if($thongtin_tk=='hang-moi-ve'){
		} elseif($thongtin_tk=='hang-ban-chay'){
			$where_tk  = " and banchay!=0 ";
		} elseif($thongtin_tk=='hang-giam-gia'){
			$where_tk  = " and giacu!=0 ";
		} else {
			$where_tk=explode("-",$thongtin_tk);
			$where_tk  = " and giaban>='".$where_tk[0]."' and giaban<='".$where_tk[1]."' ";
		}
	}
	$where .= $where_tk;
	if($_GET['sort']!=''){
		if($_GET['sort']=='price_DESC'){
			$where .= " order by giaban desc ";
		}else{
			$where .= " order by giaban ";
		}
	}else{
		$where .= " order by stt,ngaytao desc ";
	}
	$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,
	thongtin_en,thuoctinh,trongluong,rate,total,photo,luotxem2,luotxem from $where $limit";
	$d->query($sql);
	$product = $d->result_array();
	$url = getCurrentPageURL();
	// $paging = pagination($where,$per_page,$page,$url);
	$paging2 = pagination($where,$per_page,$page,$url);
}
?>
<?php /*
		if(!empty($_POST)&&isset($_POST['dangky'])){
		$data['email'] = $_POST['email'];
		$data['tieude'] = $_POST['tieude'];
		$data['ten'] = $_POST['ten'];
		$data['noidung'] = $_POST['noidung'];
		$data['sanpham'] = $_POST['sanpham'];
		$data['ngaytao'] = time();
		$d->setTable('nhanmail');
		if($d->insert($data))
			transfer("Bạn đã đăng ký thành công<br/>Cảm ơn", "san-pham.html");
		else
			transfer("Lưu dữ liệu bị lỗi", "san-pham.html");
		}
			if($_GET['idl']!=''){
				$idl = $_GET['idl'];
				$d->reset();
				$sql_detail = "select id from #_product_list where hienthi=1 and type='product' and tenkhongdau!='".$idl."'";
				$d->query($sql_detail);
				$row_list = $d->fetch_array();
				$where_tk .= " and id_list='".$row_list['id']."'";
			}
			if($_GET['idc']!=''){
				$idc = $_GET['idc'];
				$d->reset();
				$sql_detail = "select id from #_product_cat where hienthi=1 and type='product' and tenkhongdau!='".$idc."'";
				$d->query($sql_detail);
				$row_cat = $d->fetch_array();
				$where_tk .= " and id_cat='".$row_cat['id']."'";
			}
			if($_GET['idi']!=''){
				$idc = $_GET['idi'];
				$d->reset();
				$sql_detail = "select id from #_product_cat where hienthi=1 and type='product' and tenkhongdau!='".$idi."'";
				$d->query($sql_detail);
				$row_item = $d->fetch_array();
				$where_tk .= " and id_item='".$row_item['id']."'";
			}
		*/ ?>