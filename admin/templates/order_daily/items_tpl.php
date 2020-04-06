<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
	            <li><a href="index.php?com=order_daily&act=man"><span>Đơn hàng</span></a></li>
              <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>


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
      <input name="com" value="order_daily" type="hidden"  />
      <input name="act" value="man" type="hidden" />
      <input name="p" value="<?=($_GET['p']=='')?'1':$_GET['p']?>" type="hidden" />

      <input class="form_or" name="keyword" placeholder="Nhập mã đơn hàng..." value="<?=$_GET['keyword']?>" type="text" />
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
      
      <select name="tinhtrang">
      <option value="0">Tình trạng</option>
        <?php 
          $sql="select id,trangthai from #_trangthai_order_daily order by id";
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

<form name="f" id="f" method="post">


<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách đơn hàng</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <!-- <td></td> -->
        <td class="sortCol" width="120"><div>Mã đơn hàng<span></span></div></td>     
        <td class="sortCol" width="150"><div>Tên sản phẩm<span></span></div></td>
        <td width="100"><div>Mã sản phẩm<span></span></div></td>
        <td width="60"><div>Hình sản phẩm<span></span></div></td>
        <td width="120">Đơn giá</td>
        <td width="20"><div>Số lượng<span></span></div></td>
        <td width="120">Tổng giá</td>
        <td width="150">Ghi chú</td>
        <td width="100">Trạng thái sản phẩm</td>
        <td width="20">Sửa</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
      <!-- Array ( [username] => admin123 [type] => daily [id_daily] => 69 ) -->
      <?php for($i=0, $count=count($items); $i<$count; $i++){

           $d->reset();
          $sql="select * from table_product where id='".$items[$i]['id_product']."'";
          $d->query($sql);
          $pro_cart=$d->fetch_array();


        ?>
      <tr>
        
        <!-- <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td> -->
        <td align="center">
          <?php
          $d->reset();
          $sql="select madonhang from table_order where id='".$items[$i]['id_order']."'";
          $d->query($sql);
          $result=$d->fetch_array();
          echo $result["madonhang"];
          ?>
        </td> 
        <td align="center">
          <?php
          echo $pro_cart["ten_vi"];
          

          ?>
        </td>

        <td align="center">
          <?=$pro_cart['masp']?>
        </td>

        <td align="center">
          <img src="<?=_upload_product.$pro_cart['photo']?>" height="40">
        </td> 


        <td align="center">
          <?=number_format($items[$i]['gia'],0,'.','.').' VNĐ';?>
        </td>
      
        <td align="center">
           <?=$items[$i]['soluong'];?>
        </td>
       
        <td align="center">
           <?=number_format($items[$i]['gia']*$items[$i]['soluong'],0,'.','.').' VNĐ';?>
        </td>
        
        <td align="center">
           <?=str_replace("\r\n","<br />",$items[$i]['ghichu'])?>
        </td>

        <td align="center">
           <?php
         
           $tthai = $items[$i]['trangthai'];

           $sql = "select trangthai from table_trangthai_order_daily where id=$tthai";
           $d->query($sql);
           $tinhtrang = $d->fetch_array();
           echo $tinhtrang['trangthai'];
           ?>
        </td>

        <td class="actBtns">
            <a href="index.php?com=order_daily&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xem và sửa"><img src="./images/icons/dark/preview.png" alt=""></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</form>

<script type="text/javascript">
function onSearch(evt) {	
		var datefm = document.getElementById("datefm").value;	
		var dateto = document.getElementById("dateto").value;
		var status = document.getElementById("id_tinhtrang").value;		
		//var encoded = Base64.encode(keyword);
		location.href = "index.php?com=order_daily&act=man&datefm="+datefm+"&dateto="+dateto+"&status="+status;
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