<?php
	session_start();
	/* @define ( '_template' , './templates/'); */
	@define ( '_source' , './sources/');
	@define ( '_lib' , './libraries/');


	@define ( '_template' , './templates/');
	
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
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	include_once _lib."counter.php"; 
	
	if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
	$pid=$_REQUEST['productid'];
	$soluong=1;
	addtocart($pid,$soluong);
	redirect("thanh-toan.htm");}
	
	if($_GET['lang']!=''){
		$_SESSION['lang']=$_GET['lang'];
		header("location:".$_SESSION['links']);
	} else {
		$_SESSION['links']=getCurrentPageURL();
	}
	//dump($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link id="favicon" rel="shortcut icon" href="images/logo.png" type="image/x-icon" />

<title><?php if($title_bar!='') echo $title_bar; else echo $row_setting['title']; ?></title>
<meta name="description" content="<?php if($description_bar!='') echo $description_bar; else echo $row_setting['description']; ?>">
<meta name="keywords" content="<?php if($keyword_bar!='') echo $keyword_bar; else echo $row_setting['keywords']; ?>">

<meta name="robots" content="noodp,index,follow" />
<meta name="google" content="notranslate" />
<meta name='revisit-after' content='1 days' />
<meta name="ICBM" content="<?=$row_setting['toado']?>">
<meta name="geo.position" content="<?=$row_setting['toado']?>">
<meta name="geo.placename" content="<?=$row_setting['diachi_'.$lang]?>">
<meta name="author" content="<?=$row_setting['ten_'.$lang]?>">
<base href="http://<?=$config_url?>/">

<?=$share_facebook?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="js/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="js/bootstrap/css/bootstrap.css">
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script language="javascript" src="js/my_script.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('body').on('click', '.donngfx1', function(event) {
			event.preventDefault();
			parent.location.href=$(this).attr('href');
			parent.$.fancybox.close();
		});
		$('.donngfx').click(function(event) {
			parent.location.href=$(this).attr('href');
			parent.$.fancybox.close();
			return false;
		});
	});
</script> 


 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#submit_thanhtoan').click(function(event) {


		 	if(isEmpty(document.getElementById('ten'), "Xin nhập Họ tên.")){
				document.getElementById('ten').focus();
				return false;
			}
			if(isEmpty(document.getElementById('diachi'), "Xin nhập Địa Chỉ.")){
				document.getElementById('diachi').focus();
				return false;
			}
			
			if(isEmpty(document.getElementById('dienthoai'), "Xin nhập Số điện thoại.")){
				document.getElementById('dienthoai').focus();
				return false;
			}
			
			if(!isNumber(document.getElementById('dienthoai'), "Số điện thoại không hợp lệ.")){
				document.getElementById('dienthoai').focus();
				return false;
			}
			
			if(!check_email(document.form_giohang.email.value)){
				alert("Email không hợp lệ");
				document.form_giohang.email.focus();
				return false;
			}



 			var frm1 = $('#frm_giohang').serialize();
 			var frm2 = $('#frmthanhtoan').serialize();
		       $.ajax({
		       			
                      url:'ajax/ajax_thanhtoan.php',
                      type:'post',
                      data: frm1+frm2,
                      async:true,
                      success:function(result){
                       alert("Gửi đơn hàng thành công!");
                       parent.$.fancybox.close();
                      
                      }
             });                                    
     	 });
 	});
</script>


</head>
	<body>


<?php
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
		else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
		else if($_REQUEST['command']=='update'){
			//dump($_POST);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];

			

			
			// $psize=$_SESSION['cart'][$i]['size'];

			$_SESSION['cart'][$i]['size'] = $_POST['size_sp'.$i];
			

				$d->reset();
				$sql = "select size,gia,giaban from #_product where id='".$pid."'";
				$d->query($sql);
				$sizegh1 = $d->fetch_array();

			if($_SESSION['cart'][$i]['size']  !=""){
				$sizespgh1 = explode('|',$sizegh1['size']);
				$giasp1 = explode('|',$sizegh1['gia']);
				for($j=0;$j<count($sizespgh1);$j++){
					if($_POST['size_sp'.$i]==$sizespgh1[$j]) $gia_sp1=$giasp1[$j];
				}
				$_SESSION['cart'][$i]['gia']=$gia_sp1;

			}
			else{
				$_SESSION['cart'][$i]['gia'] = $sizegh1['giaban'];
			}
			$color=$_SESSION['cart'][$i]['mausp'];
			$q=$_REQUEST['product'.$pid];
			if($q>0 && $q<=999){
				$soluong = intval($q);
				$_SESSION['cart'][$i]['qty']=$soluong;
			}

			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}
?>
<script language="javascript">
	function del(pid){
		if(confirm('Xóa sản phẩm này ! ')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('Bạn Chắc Có Muốn Xóa Giỏ Hàng Hay Không ? ')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		if(confirm('Cập nhật giỏ hàng của bạn ?')){
			document.form1.command.value='update';
			document.form1.submit();
		}
	}
	
		$(document).ready(function(e) {
		
		$("#id_tinh").change(function(){
		var id_list=$(this).val();
		$("#id_huyen").load('ajax/ajax_city.php?id_list='+id_list);
		});
		
	})
	
</script>
<link href="css/giohang.css" rel="stylesheet" type="text/css" />
<div id="info">
        <div id="sanpham">
          <div class="thanh_title title_tt_gh"><h2>Giỏ hàng của bạn (<?=count($_SESSION['cart'])?>) sản phẩm</h2></div><div class="clear" style="height:20px;"></div>
            <div class="khung">
            <div class="noidungj" >
              <div id="tinh">
                <div id="giohang_ct" class="giohang_load">
                
<form name="form1" method="post" id ="frm_giohang">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
  <div style="margin-left: 2px; margin-right: 2px; color:#000; padding: 10px;" class="giohang_tk">
				<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;text-transform: uppercase;"  width="100%">
    	<?
    	//print_r($_SESSION['cart']);
			if(is_array($_SESSION['cart'])){
            	echo '<tr class="menu_giohang2" ><td>Stt</td><td>Sản phẩm</td><td></td><td>Size</td><td>Màu</td><td>Giá</td><td>Số lượng</td><td>Tổng giá</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
						$pid=$_SESSION['cart'][$i]['productid'];
						$q=$_SESSION['cart'][$i]['qty'];
						$pgia=$_SESSION['cart'][$i]['gia'];
						$psize=$_SESSION['cart'][$i]['size'];
						$color=$_SESSION['cart'][$i]['mausp'];
						$pname=get_product_name($pid);
						$gia_sp=0;
						if($q==0) continue;
				?>
            		<tr bgcolor="#FFFFFF">

                    <td width="5%"><?=$i+1?></td>
                    <td width="10%"><a href="san-pham/<?=changeTitle($pname)?>.html" class="donngfx1"><img src="upload/product/<?=get_thumb($pid)?>" width="120" style="padding:5px;" /></a></td>
            		<td width="29%" class="lef_name_gh"> 
            			<a href="san-pham/<?=changeTitle($pname)?>.html" class="donngfx1" style="color:rgba(0,102,153,1); font-size:13px; "><?=$pname?> </a>
            			<div class="bosp"><a href="javascript:del(<?=$pid?>)">Bỏ sản phẩm</a></div>

            		</td>
            		<td width="8%"> 
            			<?php 
							$d->reset();
							$sql = "select size,gia,giaban from #_product where id='".$_SESSION['cart'][$i]['productid']."'";
							$d->query($sql);
							$sizegh = $d->fetch_array();
						$giagoc = $sizegh['giaban'];
            			 $sizespgh = explode('|',$sizegh['size']);
            			 $giasp = explode('|',$sizegh['gia']);	
            			

            			 ?>
            			
            			<?php   if(count($sizespgh) == 1) {?>
            				<?= get_size($pid,$psize)?>
            			<?php  } else  if(count($sizespgh) > 1) {  ?>

	            			<select name="size_sp<?=$i?>" id="size_sp">
	            			<?php for($j=0;$j<count($sizespgh);$j++){
	            				if($_SESSION['cart'][$i]['size']==$sizespgh[$j]) $gia_sp=$giasp[$j];	
	            				?>
	            				<option value="<?=$sizespgh[$j]?>" <?php if($_SESSION['cart'][$i]['size']==$sizespgh[$j]){echo 'selected="selected"';} ?>><?= $sizespgh[$j]?> </option>
	            			<?php } ?>
	            			</select>
            			<?php } else {?>
            				N/A
            			<?php }?>

            		</td>
            		<td width="8%"><?=$color?></td>
                    <td width="15%">
                    	<?php if($psize ==  "" || $psize == 0 ) { ?>
                    	<?=number_format($giagoc,0, ',', '.')?>&nbsp;VND</td>
	                    <?php } else { ?>
	                    	<?=number_format($gia_sp,0, ',', '.')?>&nbsp;VND</td>
	                    <?php } ?>


                    	
                    <td width="8%"><input type="number" name="product<?=$pid?>" value="<?=$q?>" maxlength="5" size="3"  class="input_sl_gh"/>&nbsp;</td>                    
                    <td width="15%">
                    	
                    	
	                    
	                    <?php if($psize ==  "" || $psize == 0  ) { ?>
                    	<?=number_format($giagoc*$q,0, ',', '.') ?>&nbsp;VND</td>
	                    <?php } else { ?>
	                    	<?=number_format($gia_sp*$q,0, ',', '.') ?>&nbsp;VND</td>
	                    <?php } ?>

                  
            		</tr>
            <?php	} ?>

            <tr class="tonggia2">
            	<td colspan="10" style="text-align: right;">
               
                <b>Tổng giá : <span><?=number_format(get_order_total(),0, ',', '.')?>&nbsp;đ</span></b>
            	</td>
            </tr>
            
				<tr><td colspan="7">
              
                <input type="button" value="Tiếp tục mua hàng" onclick="window.location='index.php'" class="donngfx g_muatiep2">
                <input type="button" value="Xóa" onclick="clear_cart()" class="g_muatiep2">
                <input type="button" value="Cập nhật" onclick="update_cart()" class="g_muatiep2">
              <!--   <input type="button" value="Thanh toán" onclick="window.location='thanh-toan.htm'" class="g_muatiep"> -->
                </td></tr>
			<?
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
			}
		?>
        </table>
		<h4 id="title-notifi">Vui lòng bấm nút cập nhập sau khi chọn size và số lượng</h4>
			</div>
  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


<form name="form_giohang" id="frmthanhtoan" action="index.php?com=thanh-toan" method="get">
	<input type="hidden" name="com" value="thanh-toan" />
	<input type="hidden" name="pid" />
    <input type="hidden" name="command" />

	<table width="100%" cellpadding="0" cellspacing="0"  style="padding:5px;" class="noidung thanhtoan thanhtoan2">
    
      <tr>
   
        <td class="contentinformationleft" width="50%"><input name="ten" id="ten" class="formsubmit" value="<?=$thanhvien_tv['hoten']?>" required="required" placeholder=" Họ tên"/></td>
        <td width="50%" class="contentinformationleft" ><input name="dienthoai" id="dienthoai" class="formsubmit" value="<?=$thanhvien_tv['dienthoai']?>" placeholder=" Điện thoại" required="required" /></td>
      </tr>
      <tr>

        <td width="50%"  class="contentinformationleft"><input  name="diachi"  id="diachi" class="formsubmit" required="required"  value="<?=$thanhvien_tv['diachi']?>" placeholder=" Địa chỉ "/></td>
        <td width="50%"  class="contentinformationleft" ><input type="email" name="email" id="email" class="formsubmit" required="required"  value="<?=$thanhvien_tv['email']?>" placeholder=" E-mail"/></td>
      </tr>

   
		<tr>

        <td width="50%"  class="contentinformationleft">
		
		<select class="form-control" name="id_tinh" id="id_tinh" style="max-width:200px;">
		
			<option value="">Chọn</option>
			<?php 
				//Load tinh thanh
				 $d->reset();
				 $sql="select id,ten_$lang as ten from #_city_list where hienthi =1 order by stt asc";
				$d->query($sql);
				$tinh = $d->result_array();
				 for($i=0,$count_tinh=count($tinh);$i<$count_tinh;$i++) { ?>
				<option value="<?=$tinh[$i]['id']?>" <?php if ($thanhvien_tv["id_city"]==$tinh[$i]['id']) {?> selected <?php }?>><?=$tinh[$i]["ten"]?></option>
			<?php }?>
		
		</select>
		
		</td>
		
        <td width="50%"  class="contentinformationleft" >
		
		
		<select class="form-control" name="id_huyen" id="id_huyen" style="max-width:200px;">
		
			<option value="">Chọn</option>
			<?php 
						                        //Load tinh thanh
				 $d->reset();
				 $sql="select id,ten_$lang as ten from #_city_cat where hienthi =1 order by stt asc";
				 $d->query($sql);
				 $huyen = $d->result_array();
				for($i=0,$count_tinh=count($huyen);$i<$count_tinh;$i++) { ?>
				<option value="<?=$huyen[$i]['id']?>" <?php if ($thanhvien_tv["id_district"]==$huyen[$i]['id']) {?> selected <?php }?>><?=$huyen[$i]["ten"]?></option>
			<?php }?>
		
		</select>
		
		
		</td>
		
      </tr>

      <tr>
        <td colspan="4"  style="vertical-align:top"> <textarea name="noidung"  cols="120" rows="5" style="color:#333333;"  placeholder="THÔNG TIN NGƯỜI NHẬN " ><?=$_POST['noidung']?></textarea></td>
      </tr>
     
      <tr>
        <td id="phuongthucthanhtoan" colspan="4" style="padding:10px; color:#990000; position:relative;">
        

        </td>
      </tr>
      
             
    </table>
    
    <div style=" float:right; padding-bottom:20px; padding-top:20px;" align="right">
      
        <input  id="submit_thanhtoan" title='tiếp tục' alt='tiếp tục' align="right" type="button" name="next" value="Thanh Toán" style="cursor:pointer;" style="padding:2px;" class="g_muatiep g_giohang_sb"/>
        <input name="mod" type="hidden" id="mod3">
    </div>
</form>

	</body>
</html>
