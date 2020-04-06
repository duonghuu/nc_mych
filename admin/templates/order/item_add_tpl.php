<?php
function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	?>
<script type="text/javascript">

function TreeFilterChanged2(){		
			$('#validate').submit();		
}
function update(id){
	if(id>0){
		var sl=$('#product'+id).val();
		if(sl>0){
			$('#ajaxloader'+id).css('display', 'block');	
			jQuery.ajax({
				type: 'POST',
				url: "ajax.php?do=cart&act=update",
				data: {'id':id, 'sl':sl},				
				success: function(data) {					
					$('#ajaxloader'+id).css('display', 'none');	
					var getData = $.parseJSON(data);
					$('#id_price'+id).html(addCommas(getData.thanhtien)+'&nbsp;VNĐ');
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
			});			
		}else alert('Số lượng phải lớn hơn 0');
	}
}

function del(id){
	if(id>0){				
		jQuery.ajax({
			type: 'POST',
			url: "ajax.php?do=cart&act=delete",
			data: {'id':id},			
			success: function(data) {										
					var getData = $.parseJSON(data);
					$('#productct'+id).css('display', 'none');	
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
		});
	}
}
</script>  
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=order&act=mam"><span>Đơn hàng</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Xem và sửa đơn hàng</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=order&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin người mua</h6>
		</div>
		
		<div class="formRow">
			<label>Mã đơn hàng</label>
			<div class="formRight">
               <?=@$item['madonhang']?>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Họ tên</label>
			<div class="formRight">
              <?=@$item['hoten']?>
			</div>
			<div class="clear"></div>
		</div>	
        
         <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
              <?=@$item['dienthoai']?>
			</div>
			<div class="clear"></div>
		</div>		        
        
         <div class="formRow">
			<label>Email</label>
			<div class="formRight">
             <?=@$item['email']?>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
             <?=@$item['diachi']?>
			</div>
			<div class="clear"></div>
		</div>	
		
		
		 <div class="formRow">
			<label>Tỉnh/Thành</label>
			
			<div class="formRight">
				 <?=@$item['id_tinh']?>
           <!--  <div class="selector">
					<select id="id_tinh" name="id_tinh" class="get_thuoctinh" class="main_font" >
                        <option value="0">Chọn </option>
						<?php 
				//Load tinh thanh
				 $d->reset();
				 $sql="select id,matinh,ten from #_tinh where hienthi =1 order by stt asc";
				$d->query($sql);
				$tinh = $d->result_array();
				 for($i=0,$count_tinh=count($tinh);$i<$count_tinh;$i++) { ?>
				<option value="<?=$tinh[$i]['matinh']?>" <?php if ($item["id_tinh"]==$tinh[$i]['matinh']) {?> selected <?php }?>><?=$tinh[$i]["ten"]?></option>
			<?php }?>
						
                    </select>
                </div> -->
			</div>
			<div class="clear"></div>
		</div>	
		
		
		 <div class="formRow">
			<label>Quận/Huyện</label>
			<div class="formRight">
            <?=@$item['id_huyen']?>
			
			<!-- <div class="selector">
					<select id="id_huyen" name="id_huyen" class="get_thuoctinh" class="main_font" >
                        <option value="0">Chọn </option>
						<?php 
						                        //Load tinh thanh
				 $d->reset();
				 $sql="select id,ma_huyen,ten from #_huyen where hienthi =1 order by stt asc";
				 $d->query($sql);
				 $huyen = $d->result_array();
				for($i=0,$count_tinh=count($huyen);$i<$count_tinh;$i++) { ?>
				<option value="<?=$huyen[$i]['ma_huyen']?>" <?php if ($item["id_huyen"]==$huyen[$i]['ma_huyen']) {?> selected <?php }?>><?=$huyen[$i]["ten"]?></option>
			<?php }?>
						
                    </select>
                </div> -->
			
			
			</div>
			<div class="clear"></div>
		</div>	
         <div class="formRow">
			<label>Yêu cầu thêm</label>
			<div class="formRight">
             <?=@$item['noidung']?>
			</div>
			<div class="clear"></div>
		</div>		        
        
        </div>
		<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Chi tiết đơn hàng</h6>
		</div>
      
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
       
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">STT</a></td>      
        <td class="sortCol" width="200"><div>Tên sản phẩm<span></span></div></td>
        <td width="150">Hình ảnh</td>
        <td width="150">Size</td>
        <td width="150">Màu</td>
        <td width="150">Đơn giá</td>
        <td width="150">Số lượng</td>
        <td width="150">Thành tiền</td>
        <td width="150">Thao tác</td>
      </tr>
    </thead> 

     <tfoot>
      <tr>
        <td colspan="8"><div class="pagination">Tổng tiền</div></td>
       
        <td><div class="pagination" id="sum_price"> <?=number_format(get_tong_tien($item['id']),0, ',', '.')?>&nbsp;VNĐ</div></td>
        <td></td>
      </tr>
    </tfoot>   
   
    <tbody>
     <?php      
				$tongtien=0;          
				for($i=0,$count_donhang=count($result_ctdonhang);$i<$count_donhang;$i++){	
				$pid=$result_ctdonhang[$i]['id_product'];
				$psize=$result_ctdonhang[$i]['size'];
				$pmau=$result_ctdonhang[$i]['mau'];
					// dump($pid);	
				 
				$pname=get_product_name($pid);
				$pphoto=get_thumb($pid);
				 $size = get_size($pid,$psize);
				$d->reset();
                $d->setTable("product");
                $d->setWhere("id",$pid);
                $d->select("*");
                $product_sp = $d->fetch_array();
				$tongtien+=	$result_ctdonhang[$i]['gia']*$result_ctdonhang[$i]['soluong'];				
				
				 
			?>
        <tr id="productct<?=$result_ctdonhang[$i]['id']?>">
          <td><?=$i+1?></td>
          <td>
              
              <a target="_blank" href="https://mych.vn/admin/index.php?com=product&act=edit&id_list=<?=$product_sp['id_list']?>&id_cat=<?=$product_sp['id_cat']?>&id_item=<?=$product_sp['id_item']?>&id_sub=<?=$product_sp['id_sub']?>&id=<?=$product_sp['id']?>&type=<?=$product_sp['type']?>"><?=$pname?></a>
          </td>
           <td><img src="<?=_upload_product.$pphoto?>" height="100"  /></td>
           <td><?=$size;//$result_ctdonhang[$i]['size']?></td>
           <td><?=$pmau?></td>
          <td align="center"><?=number_format($result_ctdonhang[$i]['gia'],0, ',', '.')?>&nbsp;VNĐ</td>
          <td align="center"><?=$result_ctdonhang[$i]['soluong']?>
          <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$result_ctdonhang[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            &nbsp;</td>
          <td align="center" id="id_price<?=$result_ctdonhang[$i]['id']?>"><?=number_format($result_ctdonhang[$i]['gia']*$result_ctdonhang[$i]['soluong'],0, ',', '.')?>&nbsp;VNĐ</td>
          <td class="actBtns"><a class="smallButton tipS" original-title="Xóa sản phẩm" href="javascript:del(<?=$result_ctdonhang[$i]['id']?>)"><img src="./images/icons/dark/close.png" alt=""></a></td>
        </tr>
        <?php } ?>
     </tbody>
  </table>
      	<div class="ship-tongtt" style="padding: 10px; text-align: right;">
      		<p>Phí vận chuyển: <span style="color:#f00; font-size: 16px;"><?=number_format($item['tienship'],0, ',', '.')?>&nbsp;VNĐ</span></p>
      		<p>Tổng thanh toán: <span style="color:#f00; font-size: 16px;"><?=number_format(($item['tienship']+get_tong_tien($item['id'])),0, ',', '.')?>&nbsp;VNĐ</span></p>
      	</div>
        
        </div>
        
		<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin thêm</h6>
		</div>
        
		<div class="formRow">
			<label>Mô tả ngắn:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Viết ghi chú cho đơn hàng" class="tipS" name="ghichu" id="ghichu"><?=@$item['ghichu']?></textarea>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Tình trạng</label>
			<div class="formRight">
            	<div class="selector">
					<?=tinhtrang($item['trangthai'])?>
                </div>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<div class="formRight">	     
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Cập nhật" />
                <input type="button" class="blueB" onclick="window.open('in.php?id='+<?=@$item['id']?>,'_blank'); return false;" value="In đơn" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>
   

</form>  