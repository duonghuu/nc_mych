<?php
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
		else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
		else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$pgia=$_SESSION['cart'][$i]['gia'];
			$psize=$_SESSION['cart'][$i]['size'];
			$color=$_SESSION['cart'][$i]['mausp'];
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
</script>
<link href="css/giohang.css" rel="stylesheet" type="text/css" />
<div id="info">
        <div id="sanpham">
          <div class="thanh_title"><h2>Giỏ hàng</h2></div><div class="clear" style="height:20px;"></div>
            <div class="khung">
            <div class="noidungj" >
              <div id="tinh">
                <div id="giohang_ct">
                
                <form name="form1" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
  <div style="margin-left: 2px; margin-right: 2px; color:#000;" class="giohang_tk">
				<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;"  width="100%">
    	<?php
		
			if(is_array($_SESSION['cart'])){
            	echo '<tr class="menu_giohang" ><td>Stt</td><td>Hình Ảnh</td><td>Tên Sản Phẩm</td><td>Size</td><td>Màu</td><td>Giá</td><td>Số lượng</td><td>Tổng giá</td><td>Xóa</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
						$pid=$_SESSION['cart'][$i]['productid'];
						$q=$_SESSION['cart'][$i]['qty'];
						$pgia=$_SESSION['cart'][$i]['gia'];
						$psize=$_SESSION['cart'][$i]['size'];
						$color=$_SESSION['cart'][$i]['mausp'];
						$pname=get_product_name($pid);
				
						if($q==0) continue;
				?>
            		<tr bgcolor="#FFFFFF">
				
                    <td width="5%"><?=$i+1?></td>
                    <td width="10%"><a href="san-pham/<?=changeTitle($pname)?>.html"><img src="upload/product/<?=get_thumb($pid)?>" width="120" style="padding:5px;" /></a></td>
            		<td width="29%"> <a href="san-pham/<?=changeTitle($pname)?>.html" class="pname"><?=$pname?> </a></td>
            		<td width="8%"><?=get_size($pid,$psize)?></td>
            		<td width="8%"><?=$color?></td>
                    <td width="15%"><?=number_format(get_gia($pid,$pgia),0, ',', '.')?>&nbsp;VND</td>
                    <td width="8%"><input type="text" name="product<?=$pid?>" value="<?=$q?>" maxlength="5" size="3" style="background:#CCC;text-align:center;border-radius:5px 5px 5px 5px; " />&nbsp;</td>                    
                    <td width="15%"><?=number_format(get_gia($pid,$pgia)*$q,0, ',', '.') ?>&nbsp;VND</td>
                    <td width="10%"><a href="javascript:del(<?=$pid?>)"><img src="img/delete.png" border="0" width="25" /></a></td>
            		</tr>
            <?php	} ?>

            <tr class="tonggia">
              <td colspan="7">  
               
                <b>Tổng giá : <?=number_format(get_order_total(),0, ',', '.')?>&nbsp;đ</b></td>
            </tr>
            
				<tr><td colspan="7">
              
                <input type="button" value="Mua tiếp" onclick="window.location='index.php'" class="g_muatiep">
                <input type="button" value="Xóa tất cả" onclick="clear_cart()" class="g_muatiep">
                <input type="button" value="Cập nhật" onclick="update_cart()" class="g_muatiep">
                <input type="button" value="Thanh toán" onclick="window.location='thanh-toan.htm'" class="g_muatiep">
                </td></tr>
			<?php
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
			}
		?>
        </table>
				
			</div>
  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>