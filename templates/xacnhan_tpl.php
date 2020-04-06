<script language="javascript">
	function clear_cart(){
		if(confirm('Bạn có muốn xóa tất giỏ hàng không ?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}
</script>
<script language="javascript">
	function xoa(pid){
		if(confirm('Xóa sản phẩm này ! ')){
			document.form_giohang.pid.value=pid;
			document.form_giohang.command.value='delete';
			document.form_giohang.submit();
		}
	}
</script>
<form name="form_giohang" action="index.php?com=thanh-toan" method="get">
	<input type="hidden" name="com" value="thanh-toan" />
	<input type="hidden" name="pid" />
    <input type="hidden" name="command" />
</form>

<?php
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_pro_thanh($_REQUEST['pid']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
		else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_REQUEST['product'.$pid];
			if($q>0 && $q<=999){
				$soluong = str_replace(",", '.', $q);
				$_SESSION['cart'][$i]['qty']=$soluong;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}
?>

<link href="css/giohang.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function(e) {

	$(document).ready(function(){
      $('#submit_thanhtoan').click(function(e){ 

          var ten = '<?=$_POST['ten']?>';
          var dienthoai = '<?=$_POST['dienthoai']?>';
          var diachi = '<?=$_POST['diachi']?>';
          var email = '<?=$_POST['email']?>';
          var noidung = '<?=$_POST['noidung']?>';
          var phuongthuc = $('input[name=phuongthuc]:checked').val();
          var dongy = $('input[name=dongy]:checked').val();

          if(!dongy){
	          	alert('Bạn cần đồng ý với điều khoản thanh toán . ');
	          	$('#dongy').focus();
	          	return false;
          } else if(ten==''){
	          	alert('Bạn chưa nhập tên . ');
	          	$('#ten').focus();
	          	return false;
          } else if(dienthoai==''){
	          	alert('Bạn chưa nhập điện thoại . ');
	          	$('#dienthoai').focus();
	          	return false;
          } else if(diachi==''){
	          	alert('Bạn chưa nhập địa chỉ . ');
	          	$('#diachi').focus();
	          	return false;
          } else if(email==''){
	          	alert('Bạn chưa nhập email . ');
	          	$('#email').focus();
	          	return false;
          } else if(!phuongthuc){
	          	alert('Bạn chưa chọn phương thức thanh toán . ');
	          	return false;
          } else {
          		$.ajax({
		            type:'POST',
		            url:'ajax/thanhtoan.php',
		            data:{phuongthuc:phuongthuc,ten:ten,dienthoai:dienthoai,diachi:diachi,email:email,noidung:noidung},
		            success: function(result) {
		            	var getData = $.parseJSON(result);
		            	if(getData.ketqua==1){
		            		alert("chúc mừng bạn đã đặt hàng thành công .");
		            		window.location.href="trang-chu.html";
		            	} else if(getData.ketqua==0){
		            		alert("Hệ thống bị lổi vui lòng thực hiện lại sau vài giây .");
		            	} else {
		            		$('#frm_order').html(getData.form_tt);
							$('#frm_order').submit();
		            	}
		                
		            }
	          	});
          }

        });
    });

});
</script>
<div id="info">
<div id="sanpham">
               <div class="thanh_title"><h2>Xác Nhận Thanh Toán</h2></div><div class="clear" style="height:20px;"></div>
     <form method="post" name="frm_order" action="" enctype="multipart/form-data"  id="frm_order"> </form>
              <div class="khung">
             <div style="padding:5px; color:#000000;" >              
               <form name="form1" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
           <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1; padding:5px;" width="100%" class="giohang_tk">
    	<?
			if(is_array($_SESSION['cart'])){
            	echo '<tr class="menu_giohang" ><td>STT</td><td>Hình Ảnh</td><td>Tên</td><td>Size</td><td>Giá</td><td>Số lượng</td><td>Tổng giá</td><td>Xóa</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pgia=$_SESSION['cart'][$i]['gia'];
					$psize=$_SESSION['cart'][$i]['size'];
					$pname=get_product_name($pid);
					if($q==0) continue;
					
			?>
            		<tr bgcolor="#FFFFFF" class="ahaa"><td width="5%"><?=$i+1?></td>
                    <td width="10%"><a href="san-pham/<?=$pid?>/<?=changeTitle($pname)?>.html"><img src="upload/product/<?=get_thumb($pid)?>" width="120" style="padding:5px;" /></a></td>
            		<td width="29%"> <a href="san-pham/<?=$pid?>/<?=changeTitle($pname)?>.html" style="color:rgba(0,102,153,1); font-size:16px; font-weight:bold;"><?=$pname?></a></td>
                    <td width="29%"><?=$get_size($pid,$psize)?></td>
                    <td width="15%"><?=number_format(get_gia($pid,$pgia),0, ',', '.')?>&nbsp;đ</td>
                    <td width="8%"><?=$q?></td>                    
                    <td width="15%"><?=number_format(get_price($pid,$pgia)*$q,0, ',', '.')?>&nbsp;đ</td>
                     <td width="10%"><img src="images/disabled.png" border="0" onclick="xoa(<?=$pid?>)" width="30" height="30" style="padding-top:10px;"/></td>
            		</tr>
            <?					
				}
			?>
				
                <tr><td colspan="7">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr class="tonggia">
              <td >  
                
                <b>Tổng giá : <?=number_format(get_order_total(),0, ',', '.')?>&nbsp;đ</b></td>
             </tr>
             
            
             </table>   
                </td></tr>
			<?
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>Bạn Không có sản phẩm nào trong giỏ hàng</td>";
			}
		?>
        
        </table>

        <div class="dieukhoan">
        	<h4>Điều khoản thanh toán</h4>
        	<div class="cuoncuon"><?=$dieukhoan_muahang['noidung_'.$lang]?></div>
        	<label class="dongy"><input type="checkbox" name="dongy" value="1"> Đồng ý với điều khoản  thanh toán. </label>
        </div>

        <div class="xacnhan">
        <div class="khungxn">
        		<h4>Xác nhận thông tin giao hàng </h4>
        		<p><label><b>Tên :</b> <?=$_POST['ten']?></label></p>
        		<p><label><b>Địa chỉ : </b><?=$_POST['diachi']?></label></p>
        		<p><label><b>Điện thoại :</b> <?=$_POST['dienthoai']?></label></p>
        		<p><label><b>Email : </b><?=$_POST['email']?></label></p>
        		<p><label><b>Nội dung : </b><?=$_POST['noidung']?></label></p>
        </div>
		<div class="phuongthuc">
		<h4>Phương thức thanh toán </h4>
        <p><label> <input type="radio" name="phuongthuc" value="Thanh toán khi nhận hàng" /><span> </span>Thanh toán khi nhận hàng  . <br /><strong style="color:rgba(102,102,102,1); text-transform:capitalize; font-weight:100;"><b>Miễn Phí </b>, áp dụng cho khu vực TP . Hồ Chí Minh</strong></label></p>

        <p> <label> <input type="radio" name="phuongthuc" value="Thanh toán Onepay" /> <span> </span>Thanh toán Onepay  . <br /><strong style="color:rgba(102,102,102,1); text-transform:capitalize; font-weight:100;"><b>Miễn Phí </b> , Giao Dịch  ,  Đăng ký onepay.vn <a href="https://www.onepay.vn/" target="_blank">Tại Đây</a><br />Visa  , Master card , Internet Banking , Tài khoản onepay ....</strong></label> </p>
                 
        <p> <label> <input type="radio" name="phuongthuc" value="Thanh toán tại cửa hàng" /> <span></span> Thanh toán qua chuyển khoản.  <br /><strong style="color:rgba(102,102,102,1); text-transform:capitalize; font-weight:100;">Thanh toán tại : <?=$row_setting['diachi_'.$lang]?></strong></label></p>
		</div>

        </div>
    

    <div style=" float:right; padding-bottom:20px; padding-top:20px;" align="right">
      
        <input  id="submit_thanhtoan" title='tiếp tục' alt='tiếp tục' align="right" type="button" name="next" value="Thanh Toán" style="cursor:pointer;" style="padding:2px;" class="g_muatiep"/>
        <input name="mod" type="hidden" id="mod3">
    </div>
    
    <input type="hidden" id="priceproduct" name="priceproduct" value="7850000" />
    <div id="totalprice" style="display:none;"><input type="hidden" id="total" name="total" value="7850000" /></div>
    <div id="delivery" style="display:none;"><input type="hidden" id="delivery" name="delivery" value="0" /></div>
</form>
                
                </div></div>
     
              </div>
              
</div>