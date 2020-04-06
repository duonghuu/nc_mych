<?php 

function tinhtrang($i=0)
	{
		$sql="select * from table_trangthai_order_daily order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font" >					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option  value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}




?>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=order_daily&act=man"><span>Đơn hàng</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Xem và sửa ghi chú</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=order_daily&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin sản phẩm đã đặt hàng</h6>
		</div>
		
		<div class="formRow">
			<label>Mã đơn hàng</label>
			<div class="formRight">
               <?php
				$d->reset();
				$sql="select madonhang from table_order where id='".$item['id_order']."'";
				$d->query($sql);
				$result=$d->fetch_array();
				echo $result["madonhang"];
				?>
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow">
			<label>Mã sản phẩm</label>
			<div class="formRight">
               <?php
				$d->reset();
				$sql="select masp from table_product where id='".$item['id_product']."'";
				$d->query($sql);
				$result=$d->fetch_array();
				echo $result["masp"];
				?>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Tên sản phẩm</label>
			<div class="formRight">
         		<?php
	          $d->reset();
	          $sql="select ten_vi from table_product where id='".$item['id_product']."'";
	          $d->query($sql);
	          $result=$d->fetch_array();
	          echo $result["ten_vi"];
	          

	 
	          ?>
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow">
			<label>Hình ảnh sản phẩm</label>
			<div class="formRight">
	           <img src="<?=_upload_product.$pro_cart['photo']?>" height="100">
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow">
			<label>Đơn giá</label>
			<div class="formRight">
	           <?=number_format($item['gia'],0,'.','.').' VNĐ';?>
			</div>
			<div class="clear"></div>
		</div>	


		<div class="formRow">
			<label>Số lượng</label>
			<div class="formRight">
	           <?=$item['soluong'];?>
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow">
			<label>Thành tiền</label>
			<div class="formRight">
	           <?=number_format($item['gia']*$item['soluong'],0,'.','.').' VNĐ';?>
			</div>
			<div class="clear"></div>
		</div>

		

		
		
		
		 <div class="formRow">
			<label>Tình trạng</label>
			<div class="formRight">
            	<div class="selector" >
					<?=tinhtrang($item['trangthai'])?>
                </div>
			</div>
			<div class="clear"></div>
		</div>	


		<div class="formRow">
			<label>Ghi chú</label>
			<div class="formRight">
	           <textarea rows="8" cols="" title="Viết ghi chú cho sản phẩm này trong hóa đơn"  name="ghichu" id="short"><?=@$item['ghichu']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

    </div>

    	
	

    <?php if($item['type_payment']==5){ ?>
        <div class="formRow info_tragop">
			<label>Loại trả góp</label>
			<div class="formRight">
            	<?php
				$record_tragop = get_detai_tragop($item['id_tragop']);
				echo $record_tragop['ten_vi'];
				?>
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow info_tragop">
			<label>Số Tiền trả trước</label>
			<div class="formRight">
            	<?=number_format($item['sotientratruoc'],0,'.','.').' VNĐ'?>
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow info_tragop">
			<label>Số tiền góp mỗi tháng</label>
			<div class="formRight">
            	<?=number_format($item['sotiengopmoithang'],0,'.','.').' VNĐ'.' ('.$record_tragop['month'].' tháng)'?>
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow info_tragop">
			<label>Tổng số tiền trả góp: </label>
			<div class="formRight">
            	<?=number_format($item['tonggia'],0,'.','.').' VNĐ'?>
			</div>
			<div class="clear"></div>
		</div>	
	<?php } ?>
        
	<div class="formRow">
		<div class="formRight">
        
        	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            <input type="hidden" name="referer_link" id="id" value="<?=$_SERVER['HTTP_REFERER']?>" />

            <input type="submit" value="Hoàn tất" class="blueB" />
            <input type="button" value="Thoát" onclick="javascript:window.location='<?=$_SERVER['HTTP_REFERER']?>'" class="blueB" />

		</div>
		<div class="clear"></div>
	</div>
</form>  

<style type="text/css">
	tr.row_last{
		height: 30px !important;
		background: none !important;
		font-size: 15px;
		border-bottom: none !important;
		line-height: 30px; 
	}

	tr.row_last .pagination{
		margin-top: 0px !important;
	}

	tr.row_last .tt_row{
		text-align: right;
	}
</style>