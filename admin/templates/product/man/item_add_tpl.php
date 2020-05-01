<script type="text/javascript">     

    $(document).ready(function() {
        $('.chonngonngu li a').click(function(event) {
            var lang = $(this).attr('href');
            $('.chonngonngu li a').removeClass('active');
            $(this).addClass('active');
            $('.lang_hidden').removeClass('active');
            $('.lang_'+lang).addClass('active');
            return false;
        });

        $('.update_stt').keyup(function(event) {
            var id = $(this).attr('rel');
            var table = 'product_photo';
            var value = $(this).val();
            $.ajax ({
                type: "POST",
                url: "ajax/update_stt.php",
                data: {id:id,table:table,value:value},
                success: function(result) {
                }
            });
        });

        $('.delete_images').click(function(){
          if (confirm('Bạn có muốn xóa hình này ko ? ')) {
            var id = $(this).attr('title');
            var table = 'product_photo';
            var links = "../upload/product/";
            $.ajax ({
              type: "POST",
              url: "ajax/delete_images.php",
              data: {id:id,table:table,links:links},
              success: function(result) { 
              }
            });
            $(this).parent().slideUp();
          }
          return false;
        });

        $('.themmoi').click(function(e) {
            $.ajax ({
                type: "POST",
                url: "ajax/khuyenmai.php",
                success: function(result) { 
                    $('.load_sp').append(result);
                }
            });
        });

        $('.delete').click(function(e) {
            $(this).parent().remove();
        });
        

    });

    $(function(){
         $("#states").select2();
        ///
        $("#states").change(function(){
            $tags = $(this).val();
            if($tags>0){
            $("#tags_name").append("<p class='delete_tags'>"+$("#states option:selected").text()+"<input name='tags[]' value='"+$tags+"'  type='hidden' /> <span></span> </p>");
            }

            $(".delete_tags span").click(function(){
                $(this).parent().remove();
            });
        });
        //
        $(".delete_tags span").click(function(){
            $(this).parent().remove();
        });
    });
    
</script>
<?php

 function get_main_list()
  {
    global $item,$where_daily;
    if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
        $where_daily.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
    }
    $sql="select * from table_product_list where type='".$_GET['type']."' $where_daily order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_list" name="id_list" data-level="0" data-type="'.$_GET['type'].'" data-table="table_product_cat" data-child="id_cat" class="main_select select_danhmuc">
      <option value="">Chọn danh mục 1</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$item["id_list"])
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
    global $item;
    if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
        $where_daily.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
    }
    $sql="select * from table_product_cat where id_list='".$item['id_list']."' and type='".$_GET['type']."' $where_daily order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_cat" name="id_cat" data-level="1" data-type="'.$_GET['type'].'" data-table="table_product_item" data-child="id_item" class="main_select select_danhmuc">
      <option value="">Chọn danh mục 2</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$item["id_cat"])
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
    global $item;
    if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
        $where_daily.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
    }
    $sql="select * from table_product_item where id_cat='".$item['id_cat']."' and id_list='".$item['id_list']."' and type='".$_GET['type']."' $where_daily order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_item" name="id_item" data-level="2"  data-type="'.$_GET['type'].'" data-table="table_product_sub" data-child="id_sub" class="main_select select_danhmuc">
      <option value="">Chọn danh mục 3</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$item["id_item"])
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
    global $item;
    $sql="select * from table_product_sub where  id_item='".$_item['id_item']."' and id_list='".$_item['id_list']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_sub" name="id_sub" class="main_select">
      <option value="">Chọn danh mục 3</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$item["id_sub"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
  function get_main_tggiao()
    {
      global $item;
      $sql="select * from table_baiviet where type='tggiao' order by stt asc";
      $stmt=mysql_query($sql);
      $str='
        <select id="id_tggiao" name="id_tggiao" class="main_select">
        <option value="">Chọn thời gian</option>';
      while ($row=@mysql_fetch_array($stmt)) 
      {
        if($row["id"]==(int)@$item["id_tggiao"])
          $selected="selected";
        else 
          $selected="";
        $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
      }
      $str.='</select>';
      return $str;
    }
    $d->reset();
    $sql="select id,ten_vi from table_baiviet where hienthi=1 and type='mausp' order by stt,id asc";
    $d->query($sql);
    $row_size = $d->result_array();


  //------------ tags-------------------------
  if($item['tags']!=''){
        $tags = explode(",", $item['tags']) ;
        $sql = "select id,ten_vi from #_tags where type='product' and id<>".$tags[0];
        for ($i=1,$count = count($tags); $i < $count ; $i++) { 
            $sql .=" and id<> ".$tags[$i];
        }
    }else{
        $sql = "select id,ten_vi from #_tags where type='product'";
    }
        $d->query($sql);
        $tags_arr = $d->result_array();


  //------------end tags---------------

?>
    <style type="text/css">
            .w_danhmuc{display: flex;padding: 10px 14px;border-bottom: 1px solid #E2E2E2}
            .item_danhmuc{width:calc((100% / 4) - 15px);margin-right:10px;}
            .item_danhmuc .main_select{width: 100%!important;max-width: 100%}
            .item_danhmuc > label{padding: 4px 0;  font-weight: bold; white-space: nowrap;}
            .custom_hinhanh .uploader span.action{
                width: 100px;
                background: #fff url(images/image_add.png) no-repeat;
                background-size: contain;
                height: 100px;
                font-size: 11px;
                font-weight: bold;
                cursor: pointer;
                float: right;
                text-indent: -9999px;
                display: inline;
                overflow: hidden;
                cursor: pointer;
            }
            .custom_hinhanh div.uploader{padding: 0px;box-shadow: none;}
            .custom_hinhanh .uploader span.action:hover,.custom_hinhanh div.uploader:active span.action,.custom_hinhanh div.uploader:hover span.action{background-position: 0}
            .custom_hinhanh div.uploader input{width: auto;}
            .custom_hinhanh div.uploader{width: 100px;height: 100%;}
            .custom_hinhanh div.uploader span.filename{padding: 3px 5px;}
            .custom_hinhanh div.uploader input{height: 100px;}
        </style>
<div class="wrapper">

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=product&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
    <div class="widget">

        <div class="title chonngonngu">
        <ul>
            <li><a href="vi" class="active tipS validate[required]" title="Chọn tiếng việt "><img src="./images/vi.png" alt="" class="tiengviet" />Tiếng Việt</a></li>
            <li><a href="en" class="tipS validate[required]" title="Chọn tiếng anh "><img src="./images/en.png" alt="" class="tienganh" />Tiếng Anh</a></li>
        </ul>
        </div>  
    
        <div class="w_danhmuc">
             <?php if($config_list=='true'){ ?>
            <div class="item_danhmuc">
                <label>Chọn danh mục 1</label>
                <div class="formRight">
                <?=get_main_list()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <?php if($config_cat=='true'){ ?>
            <div class="item_danhmuc">
                <label>Chọn danh mục 2</label>
                <div class="formRight">
                <?=get_main_cat()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <?php if($config_item=='true'){ ?>
            <div class="item_danhmuc">
                <label>Chọn danh mục 3</label>
                <div class="formRight">
                <?=get_main_item()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <?php if($config_sub=='true'){ ?>
            <div class="item_danhmuc">
                <label>Chọn danh mục 4</label>
                <div class="formRight">
                <?=get_main_sub()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <div class="item_danhmuc">
                <label>Chọn thời gian</label>
                <div class="formRight">
                <?=get_main_tggiao()?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="formRow custom_hinhanh">
            <label>Tải hình ảnh:</label>
            <div class="formRight">
                <input type="file" id="file" name="file" />
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                <div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php if($_GET['act']=='edit'){?>
        <div class="formRow">
            <label>Hình Hiện Tại :</label>
            <div class="formRight">
            
            <div class="mt10"><img src="<?=_upload_product.$item['thumb']?>"  alt="NO PHOTO" width="100" /></div>

            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
        
         <div class="formRow">
      <label>Hình ảnh kèm theo: </label>
      <div class="formRight">
          <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><img src="images/image_add.png" alt="" width="100"></a>                
         
     
    <?php if($act=='edit'){?>
      <?php if(count($ds_photo)!=0){?>       
            <?php for($i=0;$i<count($ds_photo);$i++){?>
              <div class="item_trich">
                  <img class="img_trich" width="140px" height="110px" src="<?=_upload_product.$ds_photo[$i]['photo']?>" />
                  <input type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
                  <a class="delete_images" title="<?=$ds_photo[$i]['id']?>"><img src="images/delete.png"></a>
              </div>
            <?php } ?>
        
      <?php }?> 

    <?php }?>
      </div>
          <div class="clear"></div>
        </div> 
        
        <div class="formRow lang_hidden lang_vi active">
            <label>Tiêu đề</label>
            <div class="formRight">
                <input type="text" name="ten_vi" title="Nhập tên danh mục" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
            </div>
            <div class="clear"></div>
        </div>
        
        

        <div class="formRow lang_hidden lang_en">
            <label>Tiêu đề (Tiếng anh)</label>
            <div class="formRight">
                <input type="text" name="ten_en" title="Nhập tên danh mục" id="ten_en" class="tipS validate[required]" value="<?=@$item['ten_en']?>" />
            </div>
            <div class="clear"></div>
        </div>
        
        
        <div class="formRow">
            <label>Khối lượng  (gram) </label>
            <div class="formRight">
                <input type="text" name="Weight" title="Nhập khối lượng" id="Weight" value="<?=@$item['Weight']?>" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>Mã SP</label>
            <div class="formRight">
                <input type="text" name="masp" title="Nhập mã sản phẩm" id="masp" value="<?=@$item['masp']?>" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>Giá bán</label>
            <div class="formRight">
                <input type="text" name="giaban" title="Nhập giá bán" id="giaban" class="conso tipS validate[required]" value="<?=@$item['giaban']?>" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>Giá cũ (Nếu có)</label>
            <div class="formRight">
                <input type="text" name="giacu" title="Nhập giá cũ" id="giacu" class="conso tipS validate[required]" value="<?=@$item['giacu']?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php if($_GET['type']=='product'){?>
            <div class="formRow">
                <label>Lượt xem thật</label>
                <div class="formRight">
                    <input type="text" name="luotxem" title="Nhập tên danh mục" id="luotxem" class="" value="<?=@$item['luotxem']?>"  readonly style="background: #eee"/>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Lượt xem ảo</label>
                <div class="formRight">
                    <input type="text" name="luotxem2" title="Nhập tên danh mục" id="luotxem2" class="tipS" value="<?=@$item['luotxem2']?>" />
                    <div class="note">Lượt xem thật cộng lượt xem ảo.</div>
                </div>
                <div class="clear"></div>
            </div>
        <?php } ?>
        <?php if($_GET['type']=='deal-gia-soc-xxx'){?>
            <div class="formRow lang_hidden lang_vi active">
                <label>Tags </label>
                <div class="formRight">
                    <select style="width:300px" id="states">
                        <option value="0">
                            Thêm Tags 
                        </option>
                        <?php for ($i=0,$countt = count($tags_arr); $i < $countt ; $i++) { ?>
                            <option value="<?=$tags_arr[$i]["id"]?>"><?=$tags_arr[$i]["ten_vi"]?></option>
                        <?php }?>
                    </select>
                    <div class="clear"></div>
                    <div id="tags_name">
                    <?php  for ($i=0,$count = count($tags); $i < $count ; $i++) { 
                        $d->query("select id,ten_vi from #_tags where id=".$tags[$i]);
                        $tags_name = $d->fetch_array();
                        ?>
                            <p value="<?=$tags_name["id"]?>" class="delete_tags"><?=$tags_name["ten_vi"]?> <span ></span> 
                                <input name="tags[]" value="<?=$tags_name["id"]?>"  type="hidden" />
                            </p>
                            
                    <?php }?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        <?php } ?>

        <?php if($_GET['type']=='deal-gia-soc'){?>
            <div class="formRow">
                <label>Số lượng deal</label>
                <div class="formRight">
                    <input type="text" name="soluongdeal" title="Nhập" id="soluongdeal" value="<?=@$item['soluongdeal']?>"  class="conso"/>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <label>Số lượng bán</label>
                <div class="formRight">
                    <input type="text" name="soluongban" title="Nhập" id="soluongban" value="<?php if($item['soluongban'] > 0){?> <?=@$item['soluongban']?> <?php }else{?>0<?php } ?>"  class="conso" readonly="readonly" style="background:#eee"/>
                </div>
                <div class="clear"></div>
            </div>
        <?php }else{?>
            <div class="formRow">
                <label>Số lượng tồn</label>
                <div class="formRight">
                    <input type="text" name="soluongton" title="Nhập" id="soluongton" value="<?=@$item['soluongton']?>"  class="conso"/>
                </div>
                <div class="clear"></div>
            </div>

        <?php } ?>


        <div class="formRow">
            <label>Size - Giá</label> 
            <div class="formRight formRight-flex">
                <div class="loadgia">
                <?php 
                    $slgia = explode('|',$item['gia']);
                    $sl= explode('|',$item['size']);
                    $slhinh= explode('|',$item['hinhsize']);
                    for($j=0;$j<count($slgia);$j++){
                ?>
                <?php if($j>0){?><b>&nbsp;</b> <?php }?>
                <?php if($j==0){?><img class="plus plus_size" src="images/plus.png" alt="plus" width="20" height="20" /><?php }?>
                <div class="gia ">
                    <img class="del" src="images/delete1.png" alt="delete" width="20" height="20" />
                    <input type="text" name="size[]" autocomplete="off" value="<?=$sl[$j]?>" class="input2" 
                    placeholder="Nhập size" style="width:100px;float:left;"/> 
                    <input type="text" autocomplete="off" name="gia[]" value="<?=$slgia[$j]?>" class="input1"
                     placeholder="Nhập giá" style="width:100px;float:left;"/>
                    <div class="icon-mau" style="    margin-right: 1em;"><img style="width: 40px;height: 40px;" src="<?= !empty($slhinh[$j]) ? _upload_baiviet.$slhinh[$j] : '1x1.png' ?>" alt="icon"></div>
                    <input type="file" name="fileupsize[]" style="width:100px;" />
                    <input type="hidden" name="fileupsizename[]" value="<?= $slhinh[$j] ?>" />
                </div>
                <div class="clear"></div>
                <?php }?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
<script type="text/javascript">
    $(document).ready(function() {  
        $('#all_bangsize').parent().parent().parent().find('.checker').removeClass();   
        $('#all_bangsize').parent().parent().parent().find('input').css({'opacity':'1'});
        $('#uniform-all_bangsize,#uniform-undefined').css({'display':'inline-block'});
        $("#all_bangsize").click(function(){          
                var status=this.checked;
            $("input[name='team_bangsize[]']").each(function(){this.checked=status;})
        });
    });
</script>
<?php /*
    $d->reset();
    $sql="select id,ten_vi from table_baiviet where hienthi=1 and type='mausp' order by stt,id asc";
    $d->query($sql);
    $row_size = $d->result_array();
    function get_main_mucsp($id){
        global $d;
        if($id){
            $sql="select id_color from table_mausp where id_product=$id";
            $d->query($sql);
            $team = $d->result_array();
            
            for($i=0;$i<count($team);$i++){
                $temp[$i]=$team[$i]['id_color'];    
            }
        }
        $d->reset();
        $sql="select id,ten_vi from table_baiviet where hienthi=1 and type='mausp' order by stt asc,id desc";
        $d->query($sql);
        $row = $d->result_array();
        
        $str='';
        for($i=0;$i<count($row);$i++) {
            if($temp){  
                if(in_array($row[$i]['id'],$temp)){ $check = 'checked="checked"';}else{$check='';}
            }
            $str.=' | <input name="team_bangsize[]" type="checkbox" value="'.$row[$i]["id"].'" '.$check.' /> '.$row[$i]["ten_vi"];          
        }
        return $str;
    }
?>
        <div class="formRow">
            <label>Màu SP</label> 
            <div class="formRight">
                <?php if($item['id'] != 3) { ?>
                    <input type="checkbox" name="size" id="all_bangsize" />All <?=get_main_mucsp($item['id']);?>
                <?php }?><br /><br />
            </div>
            <div class="clear"></div>
        </div>*/?>
        <div class="formRow fieldGroup">
            <label>Màu sắc</label> 
            <div class="formRight">
                <a href="javascript:void(0)" class="addMore"><img class="plus plus_color" src="images/plus.png" alt="plus" width="20" height="20" /></a>
             </div>
             <div class="clear"></div>
        </div>    
        <?php foreach ($add_data as $key => $value) {  ?>
            <div class="formRow formRow-flex form-group fieldGroup">
             <label style="color: #f00">Màu: </label>
             <div class="formRight formRight-flex">
                 <input type="hidden" name="idgoi[]" value="<?= $value["id"] ?>"   />
                 <input type="text" name="tengoi[]" style="width: 100px" value="<?= $value["ten_vi"] ?>"  title="Tên" class="tipS"  />
                 <div class="icon-mau" style="    margin-right: 1em;"><img style="width: 40px;height: 40px;" src="<?= _upload_baiviet.$value["photo"] ?>" alt="icon"></div>
                 <input type="file" name="fileuptaptin[]" style="width: 100px" />
                 <a href="javascript:void(0)" data-links="upload/baiviet/" data-table="baiviet" data-id="<?= $value["id"] ?>" class="remove"><img src="images/delete1.png" alt="delete" width="20" height="20"></a>
             </div>
             <div class="clear"></div>
         </div>    
     <?php } ?>
        <?php /* <div class="formRow">
                    <label>Màu sắc</label> 
                    <div class="formRight">
                        <div class="loadcolor">
                        <?php 
                            if($item['id']){
                                $arr_color = explode('|', $item['mausac']);
                            }
                        ?>
                       <img class="plus plus_color" src="images/plus.png" alt="plus" width="20" height="20" />
                        <?php for($i=0;$i<count($arr_color);$i++) {?>
                            <div class="wcolor" style="margin-bottom: 10px;display: flex;">
                                
                                <input type="text" name="mausac[]" autocomplete="off" value="<?=$arr_color[$i]?>" class="input2" placeholder="Nhập màu" style="width:100px;float:left;"/> 
                                <img class="del" src="images/delete1.png" alt="delete" width="20" height="20" />
                                <!-- <input type="text" autocomplete="off" name="gia[]" value="<?=$slgia[$j]?>" class="input1" placeholder="Nhập giá" style="width:100px;float:left;"/> -->
                                
                            </div>
                            <div class="clear"></div>
                        <?php }?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div> */?>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('.del').click(function(e){
            $(this).parent().remove();
        });

        $('.plus_size').click(function(e) {
            $('.loadgia').append("<div class='gia'><img class='del' src='images/delete1.png' alt='delete' width='20' height='20' /><input type='text' name='size[]' autocomplete='off' value='<?=$sl[$j]?>' class='input2' placeholder='Nhập size' style='width:100px;float:left;'/><input type='text' autocomplete='off' name='gia[]' value='<?=$slgia[$j]?>' class='input1' placeholder='Nhập giá' style='width:100px;float:left;'/><input type='file' name='fileupsize[]' /> <input type='hidden' name='fileupsizename[]' value='' /></div><div class='clear'></div>");
            $('.del').click(function(e){
                $(this).parent().remove();
            });
        }); 

    //  $('.plus_color').click(function(e) {
    //         $('.loadcolor').append("<div style='margin-bottom: 10px;display:flex' class='wcolor'><input type='text' name='mausac[]' autocomplete='off' value='' class='input2' placeholder='Nhập màu' style='width:100px;float:left;'/><img class='del' src='images/delete1.png' alt='delete' width='20' height='20' /></div><div class='clear'></div>");
    //         $('.del').click(function(e){
                // $(this).parent().remove();
    //      });
    //  }); 
    });
</script>
        <div class="formRow lang_hidden lang_vi active">
            <label>Mô tả</label>
            <div class="formRight">
                <textarea rows="4" cols="" title="Nhập mô tả . " class="tipS" name="mota_vi"><?=@$item['mota_vi']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow lang_hidden lang_vi active none">
            <label>Vận chuyển</label>
            <div class="ck_editor">
                <textarea id="thongtinthem_vi" name="thongtinthem_vi"><?=@$item['thongtinthem_vi']?></textarea>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>Chi tiết</label>
        <div class="ck_editor">
                <textarea rows="4" cols="" title="Nhập  " class="tipS" name="thuoctinh" id="thuoctinh"><?=@$item['thuoctinh']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        
    
<!-- 
        <div class="formRow lang_hidden lang_en">
            <label>Mô tả (Tiếng anh)</label>
            <div class="formRight">
                <textarea rows="4" cols="" title="Nhập mô tả . " class="tipS" name="mota_en"><?=@$item['mota_en']?></textarea>
            </div>
            <div class="clear"></div>
        </div>


        <div class="formRow lang_hidden lang_vi active">
            <label>Nội Dung</label>
            <div class="ck_editor">
                <textarea id="noidung_vi" name="noidung_vi"><?=@$item['noidung_vi']?></textarea>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow lang_hidden lang_en">
            <label>Nội Dung (Tiếng anh)</label>
            <div class="ck_editor">
                <textarea id="noidung_en" name="noidung_en"><?=@$item['noidung_en']?></textarea>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow lang_hidden lang_vi active">
            <label>Thông số kỹ thuật</label>
            <div class="ck_editor">
                <textarea id="thongsokythuat" name="thongsokythuat"><?=@$item['thongsokythuat']?></textarea>
            </div>
            <div class="clear"></div>
        </div>

                



        <div class="formRow lang_hidden lang_en">
            <label>Thông số kỹ thuật (Tiếng anh)</label>
            <div class="ck_editor">
                <textarea id="thongtinthem_en" name="thongtinthem_en"><?=@$item['thongtinthem_en']?></textarea>
            </div>
            <div class="clear"></div>
        </div> -->


        <div class="formRow">
          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
             <label>Số thứ tự: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>
        
    </div>  
    <div class="widget">
        <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nội dung seo</h6>
        </div>
        
        <div class="formRow">
            <label>Title</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['title']?>" name="title" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Từ khóa</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho danh mục" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Description:</label>
            <div class="formRight">
                <textarea rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description"><?=@$item['description']?></textarea>
                <input readonly="readonly" type="text" style="width:25px; margin-top:10px; text-align:center;" name="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <div class="formRight">
                <input type="hidden" name="id_user" id="id_user" value="<?=$_SESSION['login']['id']?>" />
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
                <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                <a href="index.php?com=product&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
            </div>
            <div class="clear"></div>
        </div>

    </div>
</form>        </div>



<script>
  $(document).ready(function() {
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>
<style type="text/css">
div.uploader input{opacity: 0!important}
.delete_tags{
    background: #E4BC24;
    display: inline-block;
    padding: 0px 5px;
    line-height: 25px;
    color: #fff;
    padding-right: 15px;
    margin-bottom: 5px;
    margin-top: 10px;
    margin-right:5px;
    position: relative;
}
.delete_tags:before{
        content: '';
    height: 0px;
    width: 0px;
    position: absolute;
    top: 0px;
    left: -10px;
    border-top: 13px solid transparent;
    border-bottom: 12px solid transparent;
    border-right: 10px solid #E4BC24;
}
.delete_tags:after{
        content: '';
    height: 0px;
    width: 0px;
    position: absolute;
    top: 0px;
    right: 0px;
    border-top: 13px solid transparent;
    border-bottom: 12px solid transparent;
    border-right: 10px solid #f9f9f9;
}
.delete_tags span{ content: ''; width: 12px; height: 12px; float: left; background: url(images/disabled.png) no-repeat; background-size: 12px 12px; margin: 5px 5px 0px 0px; cursor: pointer;opacity: 0.6 }
.delete_tags:hover span{ opacity: 1 }

</style>
<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <label style="color: #f00">Màu: </label>
    <div class="formRight formRight-flex">
        <input type="hidden" name="idgoi[]" value=""   />
        <input type="text" name="tengoi[]" style="width: 100px" value=""  placeholder="Tên" title="Tên" class="tipS"  />
        <input type="file" name="fileuptaptin[]" style="width: 100px" />
        <a href="javascript:void(0)" class="remove"><img src="images/delete1.png" alt="delete" width="20" height="20"></a>
    </div>
    <div class="clear"></div>
</div>
<script>
    $(document).ready(function() {
        //add more fields group
            $(".addMore").click(function(){
                var fieldHTML = '<div class="formRow formRow-flex form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
                $('body').find('.fieldGroup:last').after(fieldHTML);
            });
            
            //remove fields group
            $("body").on("click",".remove",function(){ 
                var id=$(this).data("id");
                var table=$(this).data("table");
                var links=$(this).data("links");
                $.ajax({
                    type: "POST",
                    url: "ajax/delete_images.php",
                    data: {id:id, table:table, links:links},
                    success:function(data){
                        
                    }
                })
                $(this).parents(".fieldGroup").remove();
            });
    });
</script>