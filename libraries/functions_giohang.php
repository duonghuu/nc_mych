<?php
	
	function get_product($pid){
		global $d, $row,$lang;
		$sql = "select * from #_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row;
	}
	
	function get_product_name($pid){
		global $d, $row,$lang;
		$sql = "select ten_$lang from #_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten_'.$lang];
	}
	function get_product_tggiao($pid){
		global $d, $row,$lang;
		$sql = "select id_tggiao from #_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['id_tggiao'];
	}
	
	function get_product_kl($pid){
		global $d, $row,$lang;
		$sql = "select Weight from #_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array(); 
		return $row['Weight'];
	}
	
	function get_price($pid){
		global $d, $row;
		$sql = "select giaban from table_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['giaban'];
	}
	function get_color($color_id){
		global $d, $row;
		$sql = "select thumb from table_baiviet where type='mausp' and id='".$color_id."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['thumb'];
	}

	function get_gia($pid,$mid){
		global $d, $row;
		$sql = "select gia,giaban from table_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		$gia = explode('|', $row['gia']);

		
		if ($mid>0)
		{
			return $mid;
		}
		else 
		{
			return $row['giaban'];
		}
	
		/*if($gia[$mid-1]!=0){
			return $gia[$mid-1];
		}else{
			return $row['giaban'];
		}*/
	}

	function get_size($pid,$mid){
		global $d, $row;
		$sql = "select size from table_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		$size = explode('|', $row['size']);
		return $size[$mid-1];
	}
		
	function get_thumb($pid){
		global $d, $row;
		$sql = "select thumb from table_product where id='".$pid."' ";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['thumb'];
	}
	function get_thumb2($pid){
		global $d, $row;
		$sql = "select photo from table_product where id='".$pid."' ";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['photo'];
	}


	function remove_product($code){
		$max=count($_SESSION['cart']);
		foreach($_SESSION['cart'] as $k => $v){
			if($code == $k){
				unset($_SESSION['cart'][$k]);
				break;
			}
		}
		//$_SESSION['cart'] = array_values($_SESSION['cart']);
	}


	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		foreach($_SESSION['cart'] as $k => $v){
			/*$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			//$mid=$_SESSION['cart'][$i]['gia'];
			$price=$_SESSION['cart'][$i]['gia'];
			$sum+=$price*$q;*/
			
			$pid=$v['productid'];
			$q=$v['qty'];
			$pgia=$v['gia'];
			//$mid=$v['gia'];
			$price=$v['gia'];
			
			$total=get_gia($pid,$pgia)*$q;
			
			$sum+=$total;
			
		}
		return $sum;
	}
	function addtocart($pid,$q,$pgia,$psize,$color_id){

		//print_r($_SESSION['cart']);
		if($pid<1 or $q<1) return;
		$code= md5($pid.$psize.$color_id);
		if(is_array($_SESSION['cart'])){
				//if(product_exists($pid,$q,$pgia,$psize,$color_id)) return;
				//$max=count($_SESSION['cart']);
			if(isset($_SESSION['cart'][$code])){
				$_SESSION['cart'][$code]['qty'] = $_SESSION['cart'][$code]['qty']+$q;
				return count($_SESSION['cart']);	
			}else{
				$_SESSION['cart'][$code]['productid']=$pid;
				$_SESSION['cart'][$code]['qty']=$q;
				$_SESSION['cart'][$code]['gia']=$pgia;
				$_SESSION['cart'][$code]['size']=$psize;
				$_SESSION['cart'][$code]['mausp']=$color_id;
				return count($_SESSION['cart']);	
			}
		}else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][$code]['productid']=$pid;
			$_SESSION['cart'][$code]['qty']=$q;
			$_SESSION['cart'][$code]['gia']=$pgia;
			$_SESSION['cart'][$code]['size']=$psize;
			$_SESSION['cart'][$code]['mausp']=$color_id;
			return count($_SESSION['cart']);	
		}
	}

	function product_exists($pid,$q,$pgia,$psize,$color_id){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']&&$pgia==$_SESSION['cart'][$i]['gia']&&$psize==$_SESSION['cart'][$i]['size']&&$color_id==$_SESSION['cart'][$i]['mausp']){
				$_SESSION['cart'][$i]['qty'] = $_SESSION['cart'][$i]['qty'] + $q;
				$flag=1;
				break;
			}
		}
		return $flag;
	}

	function get_total(){
		$num = 0;
		if(isset($_SESSION['cart'])){
			
			foreach($_SESSION['cart'] as $k=>$v){
				$num+=$v['qty'];
			}
		}
		return $num;
	}

?>