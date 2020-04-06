<?php  if(!defined('_source')) die("Error");
		

		$title_detail = _timkiem;
 


		$id_list=trim($_GET['danhmuc']);

		 $key=trim($_GET['keywords']);
		//$key='Quạt bàn Asia B16017, công suất 45w';
		  $NameKey=changeTitle($key);
		 $arraykkey=changArrayKey($NameKey);	
		 
		// checkarray($arraykkey);
 
		$d->reset();
		$sql = "select id,type,ten_$lang,tenkhongdau from #_product where hienthi=1 and tenkhongdau like '%".$key."%' and type='product'    order by stt asc";
		    //$sql = "select id,type,ten_$lang,tenkhongdau from #_product where hienthi=1     and type='product'    order by stt asc limit 0,1000";
		$d->query($sql);
		$result_dataFiter1 = $d->result_array();
		
		
		
		$arrayID=fiterArrayProduct($NameKey,$result_dataFiter1);
		//checkarray($arrayID);	
		
		$stringkeyID='';
		for($i=0;$i<count($arrayID);$i++){
			if($i<count($arrayID)-1 ){
			$stringkeyID.="'".$arrayID[$i]['id']."',";
			}else{
				$stringkeyID.="'".$arrayID[$i]['id']."'";
				}
		
		}
		
		
		 


		$per_page = 12; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_product where hienthi=1 and type='product' ";
		

		if( $stringkeyID!="")
		{
			//$where.=" and ten_$lang like'%$key%'";
			 
			$where.=" and  id in (".$stringkeyID.")";
			 
		}
		if($id_list!='')
		{
			$where.=" and id_list='".$id_list."' ";
		}
		$where .= " order by stt,ngaytao desc";

		$sql = "select * from $where $limit";
		$d->query($sql);
		$product = $d->result_array();

		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

?>