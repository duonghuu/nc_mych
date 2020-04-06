<script type="text/javascript">
   function doEnter(evt){
     if(evt.keyCode == 13 || evt.which == 13){
      onSearchsp(evt);
    }
  }
   function onSearchsp(evt) {
     var keyword = $('.timkiem input[type=text]').val();
     window.location.href="index.php?com=product&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
    }
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'product';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});
    
		// $('.timkiem button').click(function(event) {
		// 	var keyword = $(this).parent().find('input').val();
		// 	window.location.href="index.php?com=product&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
		// });
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=product&act=delete&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});

  function select_list()
  {
    var a=document.getElementById("id_list");
    window.location ="index.php?com=product&act=man&type=<?=$_GET['type']?>&id_list="+a.value; 
    return true;
  }

  function select_cat()
  {
    var a=document.getElementById("id_list");
    var b=document.getElementById("id_cat");
    window.location ="index.php?com=product&act=man&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value; 
    return true;
  }
   function select_item()
  {
    var a=document.getElementById("id_list");
    var b=document.getElementById("id_cat");
    var c=document.getElementById("id_item");
    window.location ="index.php?com=product&act=man&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value+"&id_item="+c.value; 
    return true;
  }
  function select_sub()
  {
    var a=document.getElementById("id_list");
    var b=document.getElementById("id_cat");
    var c=document.getElementById("id_item");
    var d=document.getElementById("id_sub");
    window.location ="index.php?com=product&act=man&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value+"&id_item="+c.value+"&id_sub="+d.value; 
    return true;
  }

</script>
<?php
  function get_main_list()
  {
	 
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where_daily.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}	
	  
    $sql="select * from table_product_list where type='".$_GET['type']."' $where_daily order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_list" name="id_list" onchange="select_list()" class="main_select">
      <option value="">Chọn danh mục 1</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_list"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }

  function get_main_cat()
  {
	 if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where_daily.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}	 
	  
    $sql="select * from table_product_cat where id_list='".$_GET['id_list']."' and type='".$_GET['type']."' $where_daily order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_cat" name="id_cat" onchange="select_cat()" class="main_select">
      <option value="">Chọn danh mục 2</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_cat"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }

  function get_main_item()
  {
    $sql="select * from table_product_item where id_cat='".$_GET['id_cat']."' and id_list='".$_GET['id_list']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_item" name="id_item" onchange="select_item()" class="main_select">
      <option value="">Chọn danh mục 3</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_item"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
 function get_main_sub()
  {
    $sql="select * from table_product_sub where id_item='".$_GET['id_item']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_sub" name="id_sub" onchange="select_sub()" class="main_select">
      <option value="">Chọn danh mục 4</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_sub"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
?>
<link rel="stylesheet" type="text/css" href="datetimepicker/jquery.datetimepicker.css"/>
<script src="datetimepicker/jquery.datetimepicker.full.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#thoigiantu,#thoigianden').datetimepicker({
      timepicker:true, 
      format:'d-m-Y H:i'
    });
  });
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=product&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main ?></span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php if($_GET['type']=='deal-gia-soc'){?>
  <?php 
    $sql = "select thoigiantu,thoigianden from #_setting limit 0,1";
    $d->query($sql);
    $row_setting = $d->fetch_array();
  ?>
<form action="" name="form_thoigian" method="POST">
    <div class="box-thoigian">
          <div class="item_thoigian">
            <label>Thời gian bắt đầu Deal</label>
            <div class="formRight">
              <input type="text" id="thoigiantu" value="<?=@$row_setting['thoigiantu']?>" name="thoigiantu" title="Nhập thời gian" class="tipS" />
            </div>
            <div class="clear"></div>
          </div>  

          <div class="item_thoigian">
            <label>Thời gian kết thúc Deal</label>
            <div class="formRight">
              <input type="text" id="thoigianden" value="<?=@$row_setting['thoigianden']?>" name="thoigianden" title="Nhập thời gian" class="tipS" />
            </div>
            <div class="clear"></div>
          </div>  
          <input type="hidden" value="timedeal" name="checktime"/>
          <button class="btn-luuthoigian" type="submit">Cập Nhật</button>
    </div>
</form>

  <style type="text/css">
  .box-thoigian{display: flex;width: 100%;box-sizing:border-box;background: #fff;border:1px solid #eee;padding: 15px;margin-bottom: 15px;align-items: flex-end;}
  .item_thoigian{margin-right: 15px;width: 200px;}
  .item_thoigian label{font-weight: bold;font-size: 13px;margin-bottom: 5px;display: block;}
  .item_thoigian input{width: 100%;height: 30px;padding-left: 15px;box-sizing: border-box;font-size:13px;color: #2b6893;font-weight: bold;}
  .btn-luuthoigian{padding:5px 15px;background: #3672A0;box-sizing: border-box;color: #fff;cursor: pointer;border:none;height: 42px;}
  </style>

<?php } ?>

<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=product&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />

    </div>  
</div>

<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Chọn tất cả</h6>
    <div class="timkiem">
	    <input type="text" value="" onkeypress="doEnter(event)" placeholder="Nhập từ khóa tìm kiếm ">
	    <button type="button" class="blueB" onclick="onSearchsp($(this));return false;" value="">Tìm kiếm</button>
    </div>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>     
        <?php if($config_list=='true'){ ?>
        <td class="tb_data_small"><?=get_main_list()?></td>
        <?php } ?>
        <?php if($config_cat=='true'){ ?> 
        <td class="tb_data_small"><?=get_main_cat()?></td>
        <?php } ?>
         <?php if($config_item=='true'){ ?> 
        <td class="tb_data_small"><?=get_main_item()?></td>
        <?php } ?>
         <?php if($config_sub=='true'){ ?> 
        <td class="tb_data_small"><?=get_main_sub()?></td>
        <?php } ?>
        <td class="sortCol"><div>Tên sản phẩm<span></span></div></td>
        <td style="width: 170px">Hình</td>
        <?php if($_GET['type']!='deal-gia-soc'){?>
         <td class="tb_data_small">Trang chủ</td>
		 
         <td class="tb_data_small">Nổi bật</td>
         <td class="tb_data_small">GG shopping</td>
        <?php } ?>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>

    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>

       
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        <?php if($config_list=='true'){ ?>
         <td align="center">
          <?php
            $d->reset();
            $sql = "select ten_vi from table_product_list where id='".$items[$i]['id_list']."'";
            $result=mysql_query($sql);
            $name_danhmuc =mysql_fetch_array($result);
            echo @$name_danhmuc['ten_vi'];
          ?>  
         </td>
         <?php } ?> 
         <?php if($config_cat=='true'){ ?>
         <td align="center">
          <?php
            $d->reset();
            $sql = "select ten_vi from table_product_cat where id='".$items[$i]['id_cat']."'";
            $result=mysql_query($sql);
            $name_danhmuc =mysql_fetch_array($result);
            echo @$name_danhmuc['ten_vi'];
          ?>  
         </td>
        <?php } ?> 
         <?php if($config_item=='true'){ ?>
         <td align="center">
          <?php
            $d->reset();
            $sql = "select ten_vi from table_product_item where id='".$items[$i]['id_item']."'";
            $result=mysql_query($sql);
            $name_danhmuc =mysql_fetch_array($result);
            echo @$name_danhmuc['ten_vi'];
          ?>  
         </td>
        <?php } ?> 
        <?php if($config_sub=='true'){ ?>
         <td align="center">
          <?php
            $d->reset();
            $sql = "select ten_vi from table_product_sub where id='".$items[$i]['id_sub']."'";
            $result=mysql_query($sql);
            $name_danhmuc =mysql_fetch_array($result);
            echo @$name_danhmuc['ten_vi'];
          ?>  
         </td>
        <?php } ?> 
        <td class="title_name_data">
            <a target="_blank" href="index.php?com=product&act=edit&id_tggiao=<?=$items[$i]['id_tggiao']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
        </td>
        <td align="center" style="padding: 4px;width: 70px">
        <a href="index.php?com=product&act=edit&id_tggiao=<?=$items[$i]['id_tggiao']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><img src="<?=_upload_product.$items[$i]['thumb']?>" alt="<?=$items[$i]['ten_vi']?>"></a>
        </td>
        <?php if($_GET['type']!='deal-gia-soc'){?>
          <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
          </td>

           <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['banchay']?>" data-val3="banchay" class="diamondToggle <?=($items[$i]['banchay']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
          </td>
           <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['ggsp']?>" data-val3="ggsp" class="diamondToggle <?=($items[$i]['ggsp']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
          </td>
         <?php } ?>
	  
	   
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
       
        <td class="actBtns">
            <a href="index.php?com=product&act=edit&id_tggiao=<?=$items[$i]['id_tggiao']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=product&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>  

<div class="paging"><?=$paging?></div>