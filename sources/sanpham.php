<?php  if(!defined('_source')) die("Error");

		@$idc =  addslashes($_GET['idc']);
		@$idl =  addslashes($_GET['idl']);
		@$idi =  addslashes($_GET['idi']);
		@$ids =  addslashes($_GET['ids']);
		@$id=  addslashes($_GET['id']);
		#các sản phẩm khác======================
		$where = " #_product where hienthi=1 and type='product' ";

		if($com=='tag-tu-khoa'){
			if($_GET['tags']==''){
				$tag = $id;
			}else{
				$tag = $_GET['tags'];
			}
			
			$d->reset();
			$sql = "select ten_$lang,tenkhongdau,id from #_tags where hienthi=1 and type='product' and tenkhongdau='".$tag."'";
			$d->query($sql);
			$detail_tukhoa = $d->fetch_array();

			$where_tk  .= " and FIND_IN_SET('".$detail_tukhoa['id']."',tags)";
		}else{

			$d->reset();
			$sql_detail = "select * from #_product where hienthi=1 and type='product' and tenkhongdau='".$id."'";
			$d->query($sql_detail);
			$row_detail = $d->fetch_array();


			$chuoi = $id;
			//print_r('Tên :'.$chuoi .'<br />');
			$chuoi1 = explode('-',$chuoi); 

			$noichuoi = $chuoi1[0].' '.$chuoi1[1].' '.$chuoi1[2];
			//print_r($noichuoi);


			$per_page = 30; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;

			
			if($com=='san-pham-tuong-tu'){
				$where_tk  .= " and ten_$lang like'%$noichuoi%' and id!='".$row_detail['id']."'";
			}else{

				$where_tk  .= " and id!='".$row_detail['id']."' and id_item='".$row_detail['id_item']."'";
			}

			
		}
		if($_GET['idl']!=''){
			$idl = $_GET['idl'];
			$d->reset();
			$sql_detail = "select id from #_product_list where hienthi=1 and type='product' and tenkhongdau!='".$idl."'";
			$d->query($sql_detail);
			$row_list = $d->fetch_array();

			$where_tk .= " and idl='".$row_list['id']."'";
		}


		if($_GET['idc']!=''){
			$idc = $_GET['idc'];
			$d->reset();
			$sql_detail = "select id from #_product_cat where hienthi=1 and type='product' and tenkhongdau!='".$idc."'";
			$d->query($sql_detail);
			$row_cat = $d->fetch_array();

			$where_tk .= " and idc='".$row_cat['id']."'";
		}

		if($_GET['idi']!=''){
			$idc = $_GET['idi'];
			$d->reset();
			$sql_detail = "select id from #_product_cat where hienthi=1 and type='product' and tenkhongdau!='".$idi."'";
			$d->query($sql_detail);
			$row_item = $d->fetch_array();

			$where_tk .= " and idi='".$row_item['id']."'";
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
		
		$sql = "select id,thumb,ten_$lang,giaban,tenkhongdau,giacu,luotxem,luotxem2,photo from $where $limit";
		
		$d->query($sql);
		$product = $d->result_array();
		if($com=='san-pham-cung-nghanh'){
			$active_l =  $row_detail['id_list'];
	        $active_c =  $row_detail['id_cat'];
	        $active_i =  $row_detail['id_item'];
        }

		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

	
?>
