<?php
	session_start();
		@define ( '_template' , '../templates/');
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";
	$d = new database($config['database']);

	$status = 0;
	$result='';
	$delete = $_POST['delete'];
	if($_POST['codecart']!=''){
		$codecart = $_POST['codecart'];
	}
	if($delete==1){
		remove_product($codecart);
	}
	if($_SESSION['cart']){
		$result.='<div class="tit_gh-mini">Sản Phẩm Đã Thêm Vào Giỏ Hàng</div>
		<div class="content_gh-mini">';
			foreach($_SESSION['cart'] as $k =>$v){
				$code = $k;
				$pid=$v['productid'];
				$q=$v['qty'];
				$pgia=$v['gia'];
				$psize=$v['size'];
				$color=$v['mausp'];
				$pname = get_product_name($pid);
				$weight = get_product_kl($pid)*$q;
				//$trongluong = $trongluong + $weight;
	            $result.='<div class="item_gh-mini">
		                	<div class="img-info-gh-mini">
		                        <div class="img-gh_mini">';
		                        	$result.='<img src="'._upload_product_l.get_thumb($pid).'" alt="'.$pname.'">';
		                        $result.='</div>';
		                   	    $result.='<div class="info_gh-mini">
		                            <a href="san-pham/'.changeTitle($pname).'.html">'.$pname.'</a>';
		                                $result.='<p>'; if($pgia==0) { 
		                                	$result.=_lienhe;
		                                }else{
		                                	$result.=number_format($pgia*$q,0,",",",")." đ";
		                                } 
		                                $result.='</p>';
		                        $result.='</div>
	                        </div>
	                        <div class="xoa_gh-mini" Onclick="delete_mini('."'".$code."'".')"><img src="images/close-light.svg"></div>
	                    </div>';
	        } 
        $result.='</div>
		<a class="btn-xemgh" href="thanh-toan.htm">Xem Giỏ Hàng</a>';

	}else{
		$result.='<div class="tit_gh-mini">Chưa có sản phẩm nào trong giỏ!</div>';
	}

	echo json_encode(array("result"=>$result));

	
?>


