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
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=order&act=man"><span>Đơn hàng</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<style type="text/css">
  .sendghtk{
    background: #0099FF;
    display: inline-block;
    padding: 4px 7px;
    color: #FFF;
    font-weight: 300;
    font-size: 11px;
  }
</style>
<script src="js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".datetimepicker").datetimepicker({
      yearOffset:222,
      lang:'ch',
      timepicker:false,
      format:'m/d/Y',
      formatDate:'Y/m/d',
      minDate:'-1970/01/02', // yesterday is minimum date
      maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
  });
</script>

<div class="widget">
  <div class="titlee" style="padding-bottom:5px;">

    <div class="timkiem" >
    <form name="search" action="index.php" method="GET" class="form giohang_ser">
      <input name="com" value="order" type="hidden"  />
      <input name="act" value="man" type="hidden" />
      <input name="p" value="<?=($_GET['p']=='')?'1':$_GET['p']?>" type="hidden" />

      <input class="form_or" name="keyword" placeholder="Nhập từ khóa.." value="<?=$_GET['keyword']?>" type="text" />
      <input class="form_or" name="ngaybd" id="datefm" type="text" value="<?=$_GET['ngaybd']?>" placeholder="Từ ngày.."/>
      <input class="form_or" name="ngaykt" id="dateto" type="text" value="<?=$_GET['ngaykt']?>" placeholder="Đến ngày.." />

      <select name="sotien">
      <option value="0">Chọn giá</option>
        <?php 
          $sql="select id,ten from #_giasearch order by id";
          $d->query($sql);
          $giasearch = $d->result_array();
          for ($i=0,$count=count($giasearch); $i < $count; $i++) { 
        ?>
          <option value="<?=$giasearch[$i]["id"]?>" <?php if($giasearch[$i]["id"]==$_GET['sotien']) echo "selected='selected'";?> >
            <?=$giasearch[$i]["ten"]?>
          </option>
        <?php }?>
      </select>
      <select name="httt">
      <option value="0">Hình thức thanh toán</option>
        <?php 
          $sql="select id,ten from #_httt order by id";
          $d->query($sql);
          $httt_sr = $d->result_array();
          for ($i=0,$count=count($httt_sr); $i < $count; $i++) { 
        ?>
          <option value="<?=$httt_sr[$i]["id"]?>" <?php if($httt_sr[$i]["id"]==$_GET['httt']) echo "selected='selected'";?>>
            <?=$httt_sr[$i]["ten"]?>
          </option>
        <?php }?>
      </select>
      <select name="tinhtrang">
      <option value="0">Tình trạng</option>
        <?php  
          $sql="select id,trangthai from #_tinhtrang order by id";
          $d->query($sql);
          $tinhtrang_sr = $d->result_array();
          for ($i=0,$count=count($tinhtrang_sr); $i < $count; $i++) { 
        ?>
          <option value="<?=$tinhtrang_sr[$i]["id"]?>" <?php if($tinhtrang_sr[$i]["id"]==$_GET['tinhtrang']) echo "selected='selected'";?> >
            <?=$tinhtrang_sr[$i]["trangthai"]?>
          </option>
        <?php }?>
      </select>
      <input type="submit" class="blueB" value="Tìm kiếm" style="width:100px; margin:0px 0px 0px 10px;"  />
    </form>
    </div><!--end tim kiem-->
    
  </div>
</div>

<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá đơn hàng này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}		
					
</script>
<style type="text/css">
  .flex_xoa_donhang{display: flex;justify-content: space-between;align-items: center;}
.div_widget{margin:10px 0px;width: calc(100% - 70px)}
.tab_donhang{display: flex;justify-content: space-between;}
.tab_donhang li{width: calc((100% / 5) - 5px);border:1px solid #ccc;font-weight:bold;text-align: center;border-color: #ccc!important;padding: 5px;box-sizing: border-box;background: #fff}
.tab_donhang li a{display: block;}
.tab_donhang li.active{background: #09f;color: #fff!important}
.tab_donhang li.active a{color: #fff!important}

</style>




<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
    <div class="flex_xoa_donhang">
    	<div>
          <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=order&act=man&multi=del');return false;" />
      </div>  

      <div class="div_widget">
        <ul class="tab_donhang">
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='1') echo ' class="active"' ?> ><a href="index.php?com=order&act=man&tinhtrang=1">Đơn hàng mới</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='6') echo ' class="active"' ?> ><a href="index.php?com=order&act=man&tinhtrang=6">Mua hàng</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='2') echo ' class="active"' ?> ><a href="index.php?com=order&act=man&tinhtrang=2">Chuẩn bị hàng</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='3') echo ' class="active"' ?> ><a href="index.php?com=order&act=man&tinhtrang=3">Đang giao</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='4') echo ' class="active"' ?> ><a href="index.php?com=order&act=man&tinhtrang=4">Đã giao</a></li>
          <li<?php if($_GET['com']=='order' && $_GET['tinhtrang']=='5') echo ' class="active"' ?> ><a href="index.php?com=order&act=man&tinhtrang=5">Đã hủy</a></li>
        </ul>
      </div>
    </div>

</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách đơn hàng</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
       <td class="sortCol" width="100"><div>Mã đơn hàng<span></span></div></td>    
       <td class="sortCol" width="100"><div>Ngày đặt<span></span></div></td>    
		<td class="sortCol" width="120"><div>Tên sản phẩm<span></span></div></td>
        <td class="sortCol" width="150"><div>Họ tên<span></span></div></td>
        <td class="sortCol" width="100"><div>Điện thoại<span></span></div></td>
		<td width="150">Số tiền</td>
		<td width="150">Tiền ship</td>
		<td width="150">Tổng tiền</td>
        <td width="150">Tình trạng</td>
        <td width="150">Giao hàng</td>
        <td width="150">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="11"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){
		
				$d->reset();
				$sql = "select id,id_product,id_order,ten from #_order_detail where  id_order='".$items[$i]["id"]."' ";
				$d->query($sql);
				$order_detail = $d->fetch_array();

        $d->reset();
        $sql = "select * from #_product where  id='".$order_detail["id_product"]."' ";
        $d->query($sql);
        $product_sp = $d->fetch_array();
			 
		?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
            <?=$items[$i]['madonhang']?>
        </td> 
        <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
            <?=date('d/m/Y',$items[$i]['ngaytao'])?>
        </td> 
		    <td <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
            <a target="_blank" href="https://mych.vn/admin/index.php?com=product&act=edit&id_list=<?=$product_sp['id_list']?>&id_cat=<?=$product_sp['id_cat']?>&id_item=<?=$product_sp['id_item']?>&id_sub=<?=$product_sp['id_sub']?>&id=<?=$product_sp['id']?>&type=<?=$product_sp['type']?>"><?=$order_detail['ten']?></a>
        </td>
		<td <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
            <?=$items[$i]['hoten']?>
        </td>
     
        
		<td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
            <?=$items[$i]['dienthoai']?>
        </td>
      
	 
	  
        <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
           <?=number_format(get_tong_tien($items[$i]['id']),0, ',', '.')?>&nbsp;VNĐ
        </td>

       <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
           <?=number_format($items[$i]['tienship'],0, ',', '.')?>&nbsp;VNĐ
        </td>
		
		 <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
           <?=number_format(get_tong_tien($items[$i]['id'])+$items[$i]['tienship'],0, ',', '.')?>&nbsp;VNĐ
        </td>
		
		
		
       
        <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
          <?php 
    		   	$sql="select trangthai from #_tinhtrang where id= '".$items[$i]['trangthai']."' ";
    				$d->query($sql);
    				$result=$d->fetch_array();
    				echo $result['trangthai'];
    		  ?>
        </td>

         <td align="center">
           <a href="chuyen-ghtk.php?id=<?=$items[$i]['id']?>" class="sendghtk">Chuyển GHTK</a>
        </td>
       
        <td class="actBtns">
            <a href="export.php?id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xuất đơn hàng"><img src="./images/icons/dark/excel.png" alt=""></a>
            
            <a href="index.php?com=order&act=edit&id=<?=$items[$i]['id']?>" target="_blank" title="" class="smallButton tipS" original-title="Xem và sửa"><img src="./images/icons/dark/preview.png" alt=""></a>
            <a href="" onclick="CheckDelete('index.php?com=order&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa đơn hàng"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>               
<style type="text/css">
.smallButton{margin-bottom: 3px;}
</style>

<script type="text/javascript">
function onSearch(evt) {	
		var datefm = document.getElementById("datefm").value;	
		var dateto = document.getElementById("dateto").value;
		var status = document.getElementById("id_tinhtrang").value;		
		//var encoded = Base64.encode(keyword);
		location.href = "index.php?com=order&act=man&datefm="+datefm+"&dateto="+dateto+"&status="+status;
		loadPage(document.location);
			
}
$(document).ready(function(){						
	var dates = $( "#datefm, #dateto" ).datepicker({
			defaultDate: "+1w",
			dateFormat: 'dd/mm/yy',
			changeMonth: true,			
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				var option = this.id == "datefm" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
        
		});
		
</script>