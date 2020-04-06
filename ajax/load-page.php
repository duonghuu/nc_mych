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
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";
	$d = new database($config['database']);


	$p = $_POST['p'];
	$item = $_POST['item'];

	$startpoint = ($p * 36) - 36;
	$limit = ' limit '.$startpoint.',36';

	$d->reset();
	$sql = "select * from #_product where hienthi=1 and noibat!=0 and type='product' order by RAND () ".$limit."";
	$d->query($sql);
	$sanpham = $d->result_array();
	
	$status = 0;
	$result='';
	$error_img = "1x1.png";

	if($sanpham){
		$status = 1;
		foreach($sanpham as $k){
		$giasp = explode('|',$k['gia']);              
		$pricesize=str_replace(',', '', $giasp[0]);
		if($pricesize <=0){$pricesize = $k['giaban'];}
                               
            $result.='<div class="item_sp">
            	<div class="pre_css">
                    <div class="border_css">
	                		<div class="zoom">
	                        	<div class="hidden_img">';
	                            $result.='<a  target="_blank" href="san-pham/'.$k['tenkhongdau'].'.html">';
	                                  $result.='<img onerror="this.src=\'1x1.png\';" class="lazy" src="1x1.png" data-src="'._upload_product_l.'475x500x2/'.$k['photo'].'" alt="'.$k['ten_'.$lang].'"';
	                                  //$result.='onerror="this.src='.$error_img.';">';
	                                  	if($k['giacu'] > 0){
	                                        $result.='<span class="giamgia">'.giamgia($k['giacu'],$k['giaban']).'</span>';
	                                    } 
	                            $result.='</a>';
	                            $result.='</div>
	                        </div>
	                        <div class="info_sp">
	                            <h3><a  target="_blank" href="san-pham/'.$k['tenkhongdau'].'.html">'.$k['ten_'.$lang].'</a></h3>
	                            <div class="giasp '; if($k['giacu']<=0) {$result.='none-price';} $result.='">';
	                                $result.='<span>'; if($pricesize==0) { $result.=_lienhe;}else{$result.=number_format ($pricesize,0,",",",")." đ";} $result.='</span>';
	                                if($k['giacu']>0){
	                                    $result.='<span>'.number_format ($k['giacu'],0,",",",")." đ" .'</span>';
	                               	} 
	                         	$result.='</div>
	                    	</div>';
	                    $result.='</div>
                        	<div class="hover_bot">
                                <a href="san-pham-cung-nghanh.html">SP cùng ngành</a>
                                <a href="san-pham-cung-nghanh.html">SP tương tự</a>
                            </div>';
	                $result.='</div>
	            </div>
            </div>';
        } 

	}

	echo json_encode(array("status"=>$status,"result"=>$result));

	
?>


