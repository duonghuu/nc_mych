<?php

	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	
	@define ( '_lib' , '../libraries/');
    
	include_once _lib."config.php";
	include_once _lib."constant.php";;
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
    
	$d = new database($config['database']);
	
	@$id = $_POST['id'];
	@$id_type = $_POST['id_type'];
	@$val = $_POST['val'];
		
		
	if ($val=="mau")
	{
		
		$d->reset();
		$sql="select * from #_product_hinhanh where hienthi=1 and id='".$id_color."' and id_photo = '".$id."' and type='san-pham' and kind='man' and val='mau' order by stt,id desc";
		$d->query($sql);
		$row_mausp = $d->fetch_array();
		
		$data_color .='<span class="selected">Màu - '.$row_mausp['ten'.$lang].'</span>';

$data_gia .=' '.number_format($row_mausp['gia'],0, ',', '.').' đ';

$data_name_pro .='<span class="name_thuoctinh"> - '.$row_mausp['ten'.$lang].'</span>';
		
	}
	else if ($val=="kichthuoc")
	{
		
		$d->reset();
		$sql="select * from #_product_hinhanh where hienthi=1 and id='".$id_color."' and id_photo = '".$id."' and type='san-pham' and kind='man' and val='kichthuoc' order by stt,id desc";
		$d->query($sql);
		$row_mausp = $d->fetch_array();
		
		
		$data_color .='<span class="selected">Model - '.$row_mausp['ten'.$lang].'</span>';

$data_gia .=' '.number_format($row_mausp['gia'],0, ',', '.').' đ';

$data_name_pro .='<span class="name_thuoctinh"> - '.$row_mausp['ten'.$lang].'</span>';
		
	}	

	




		
$data_photo .='<a id="Zoom-1" class="MagicZoom" href="'._upload_product_l.$row_mausp['photo'].'" title="'.$row_mausp['ten'.$lang].'">
     <img onerror="src=assets/images/noimage.png" src="timthumb.php?src='._upload_product_l.$row_mausp['photo'].'&w=400&h=350&zc=2&q=80" alt="'.$row_mausp['ten'.$lang].'">
</a>';

$data_photo .='<div class="selectors">  <div id="owl_pic_product_detail" class="owl-carousel owl-theme">';
				
				 foreach($row_hinhanhsp as $j =>$v_photo){
			
			$data_sp .='<div class="pic_product_detail">    
                            <a data-zoom-id="Zoom-1" href="'._upload_product_l.$v_photo['photo'].'" title="'.$row_detail['ten'.$lang].'">
                                <img onerror="src=assets/images/noimage.png" src="timthumb.php?src='._upload_product_l.$v_photo['photo'].'&w=400&h=350&zc=2&q=80" alt="'.$row_detail['ten'.$lang].'">
                            </a>
                        </div>';
				  
				  }
	$data_photo .=	'</div></div>';





$html_photo=$data_photo;
$html_color=$data_color;
$html_gia=$data_gia;
$html_name_pro=$data_name_pro;
$id_thuoctinh=$row_mausp["id"];

$data = array('id_thuoctinh' => $id_thuoctinh, 'html_photo' => $html_photo, 'html_color' => $html_color, 'html_name_pro' => $html_name_pro, 'html_gia' => $html_gia);	

echo json_encode($data);

?>

