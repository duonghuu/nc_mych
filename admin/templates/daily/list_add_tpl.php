<?php
function get_main_category()
    {
        $sql="select ten_vi,id from table_city_list order by stt";
        $stmt=mysql_query($sql);
        $str='
            <select id="id_tinhthanh" name="id_tinhthanh" class="main_font">
            <option>Chọn Tỉnh/Thành</option>          
            ';
        while ($row=@mysql_fetch_array($stmt)) 
        {
            if($row["id"]==(int)@$_REQUEST["id_tinhthanh"])
                $selected="selected";
            else 
                $selected="";
            $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';         
        }
        $str.='</select>';
        return $str;
    }
    
	
	
	
	
?>
<script type="text/javascript">
	$(document).ready(function() {

			jQuery(document).ready(function(){
			
			// DANH MUC CAP 1
			
			   jQuery('.btn-group-cap1').on("click", function(){
				 
					if ( $('.dropdown-list-cap1').css('display') == 'none' ) {
					$('.dropdown-list-cap1').animate({height: 'show'}, 400);
					} else {
					$('.dropdown-list-cap1').animate({height: 'hide'}, 200);
					}
			   });
			   
				jQuery(document).on("click touchstart", function(){
					$('.dropdown-list-cap1').animate({height: 'hide'}, 200);
				});
					jQuery('.dropdown-list-cap1').on("click touchstart", function(event){
					event.stopPropagation();
				});
				jQuery('.btn-group-cap1').on("click touchstart", function(event){
					event.stopPropagation();
				});
				
				
				
				// DANH MUC CAP 2
				
				
				jQuery('.btn-group-cap2').on("click", function(){
					if ( $('.dropdown-list-cap2').css('display') == 'none' ) {
					$('.dropdown-list-cap2').animate({height: 'show'}, 400);
					} else {
					$('.dropdown-list-cap2').animate({height: 'hide'}, 200);
					}
			   });
			   
				jQuery(document).on("click touchstart", function(){
					$('.dropdown-list-cap2').animate({height: 'hide'}, 200);
				});
					jQuery('.dropdown-list-cap2').on("click touchstart", function(event){
					event.stopPropagation();
				});
				jQuery('.btn-group-cap2').on("click touchstart", function(event){
					event.stopPropagation();
				});
				
				
			// DANH MUC CAP 3
			
			jQuery('.btn-group-cap3').on("click", function(){
					if ( $('.dropdown-list-cap3').css('display') == 'none' ) {
					$('.dropdown-list-cap3').animate({height: 'show'}, 400);
					} else {
					$('.dropdown-list-cap3').animate({height: 'hide'}, 200);
					}
			   });
			   
				jQuery(document).on("click touchstart", function(){
					$('.dropdown-list-cap3').animate({height: 'hide'}, 200);
				});
					jQuery('.dropdown-list-cap3').on("click touchstart", function(event){
					event.stopPropagation();
				});
				jQuery('.btn-group-cap3').on("click touchstart", function(event){
					event.stopPropagation();
				});
			
			 
			});
			
			
			
			$("#chontatca_cap1").click(function(){
				var status=this.checked;
				$("input[name='id_list[]']").each(function(){this.checked=status;})
			});
			
			$("#chontatca_cap2").click(function(){
				var status=this.checked;
				$("input[name='id_cat[]']").each(function(){this.checked=status;})
			});
			
			$("#chontatca_cap3").click(function(){
				var status=this.checked;
				$("input[name='id_item[]']").each(function(){this.checked=status;})
			});
			
			
			});
	  
	  </script>

	
	  
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=daily&act=man_list"><span>Thêm Đại lý</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=daily&act=save_list" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
        
        

          
        <div class="formRow">
        
        
        <div class="group-catalog-product"> 
     
<div class="btn-group dropdown btn-group-cap1">
          <button type="button" class="btn-cap1 size-cap1 order-location dropdown-toggle" data-toggle="dropdown">Chọn cấp 1</button>
             <button type="button" class="btn-cap1 order-location dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only"></span>
            </button>
            
             
          
           <ul class="dropdown-menu dropdown-list-cap1" role="menu">
                <li class="pull-left">
               <input type="checkbox" id="chontatca_cap1">Chọn tất cả 
                    <ul class="sub-location-drop clearfix">
                    
                    
      <?php
		$sql_size= "select ten_vi,ten_en,id from #_product_list where hienthi=1  order by stt desc";
		$d->query($sql_size);
		$row_cap1 = $d->result_array();
		$lay_cap1=explode(',',$item['id_list']);
		for($j = 0, $count_cap1 = count($row_cap1); $j < $count_cap1; $j++){
	?>
    	 <li><input type="checkbox" name="id_list[]" id="choncap1" value="<?=$row_cap1[$j]['id']?>" class="chon" <?php if(in_array($row_cap1[$j]['id'],$lay_cap1)) echo 'checked';?> /><?=$row_cap1[$j]['ten_vi']?></li>
      <?php }?> 

                <div class="clear"></div>
   					
                      </ul>

                  </li>
           </ul><!--end  dropdown-menu-->                
        </div><!--end btn-group dropdown-->
        
     
    
    <div class="btn-group dropdown btn-group-cap2">
          <button type="button" class="btn-cap2 size-cap2 order-location dropdown-toggle" data-toggle="dropdown">Chọn cấp 2</button>
             <button type="button" class="btn-cap2 order-location dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only"></span>
            </button>
            
            
          
           <ul class="dropdown-menu dropdown-list-cap2" role="menu">
                <li class="pull-left">
            <input type="checkbox" id="chontatca_cap2">Chọn tất cả          
                    <ul class="sub-location-drop clearfix">
                    
                    
      <?php
		$sql_size= "select ten_vi,ten_en,id from #_product_cat where hienthi=1  order by stt desc";
		$d->query($sql_size);
		$row_cap2 = $d->result_array();
		$lay_cap2=explode(',',$item['id_cat']);
		for($j = 0, $count_cap2 = count($row_cap2); $j < $count_cap2; $j++){
	?>
    	 <li><input type="checkbox" name="id_cat[]" id="choncap2" value="<?=$row_cap2[$j]['id']?>" class="chon" <?php if(in_array($row_cap2[$j]['id'],$lay_cap2)) echo 'checked';?> /><?=$row_cap2[$j]['ten_vi']?></li>
      <?php }?> 

                <div class="clear"></div>
   					
                      </ul>

                  </li>
           </ul><!--end  dropdown-menu-->                
        </div>
    
    
      
    <div class="btn-group dropdown btn-group-cap3">
          <button type="button" class="btn-cap3 size-cap3 order-location dropdown-toggle" data-toggle="dropdown">Chọn cấp 3</button>
             <button type="button" class="btn-cap3 order-location dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only"></span>
            </button>
            
            
          
           <ul class="dropdown-menu dropdown-list-cap3" role="menu">
                <li class="pull-left">
            <input type="checkbox" id="chontatca_cap3">Chọn tất cả          
                    <ul class="sub-location-drop clearfix">
                    
                    
      <?php
		$sql_size= "select ten_vi,ten_en,id from #_product_item where hienthi=1  order by stt desc";
		$d->query($sql_size);
		$row_cap3 = $d->result_array();
		$lay_cap3=explode(',',$item["id_item"]);
		for($j = 0, $count_cap2 = count($row_cap3); $j < $count_cap2; $j++){
	?>
    	 <li><input type="checkbox" name="id_item[]" id="choncap3" value="<?=$row_cap3[$j]['id']?>" class="chon" <?php if(in_array($row_cap3[$j]['id'],$lay_cap3)) echo 'checked';?> /><?=$row_cap3[$j]['ten_vi']?></li>
      <?php }?> 

                <div class="clear"></div>
   					
                      </ul>

                  </li>
           </ul><!--end  dropdown-menu-->                
        </div>
        
        
    
     
</div><!--end group-catalog-product-->     
     
          
        
        </div><!--END formRow-->  
          
        
        
		
        <div class="formRow">
            <label>Logo đại diện: </label>
            <div class="formRight">
                 <?php if ($_REQUEST['act']=='edit_list' && $item['photo']!='' ) { ?>
                  <img style="width: 50px; height: 37px;" src="<?=_upload_hinhanh.$item['photo']?>">
                    
                    <br>
                    <?php }?>
                    
                <input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho Đại lý (ảnh JPEG, GIF , JPG , PNG)"> &nbsp;&nbsp;&nbsp;&nbsp;  width: 50px; heigth: 37px;
                               
            </div>
            <div class="clear"></div>
        </div>   

        <?php if($act!='add_list') { ?>
        <div class="formRow">
            <label>Mã đại lý</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['madaily']?>" name="madaily" title="Nhập mã đại lý" class="tipS" style="width: 150px;" />

                <input type="hidden" value="<?=@$item['madaily']?>" name="madaily_old"/>
            </div><!--end formRight-->
            
            <div class="clear"></div>           
        </div><!--end formRow-->  
        <?php } ?>
		
		
	
             <div class="formRow">
    			<label>Tên đại lý VI</label>
    			<div class="formRight">
    				<input type="text" value="<?=@$item['ten_vi']?>" name="ten_vi" title="Nội dung tiêu đề VI" class="tipS" />
    			</div><!--end formRight-->
                
    			<div class="clear"></div>           
    		</div><!--end formRow-->
			
			
			 <div class="formRow">
    			<label>Họ Tên chủ đại lý VI</label>
    			<div class="formRight">
    				<input type="text" value="<?=@$item['hoten_vi']?>" name="hoten_vi" title="Nhập họ tên chủ đại lý VI" class="tipS" />
    			</div><!--end formRight-->
                
    			<div class="clear"></div>           
    		</div><!--end formRow-->	
		

		     
        <div class="formRow">
            <label>Số điện thoại</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập số điện thoại" class="tipS" />
            </div><!--end formRight-->
            
            <div class="clear"></div>           
        </div><!--end formRow-->
		
		
		


	<div class="formRow">
            <label>Email đại lý</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['email']?>" name="email" title="Nhập Email" class="tipS" />
            </div>
            
            <div class="clear"></div>           
        </div>

    


        <div class="formRow">
            <label>Tỉnh thành</label>
            <div class="formRight">
                <div class="selector">
                    
                    <?=get_main_category();?>
                
                </div>
            </div>
            <div class="clear"></div>           
        </div><!--end formRow-->
		
		
		  <?php if($_SESSION['login_admin']['type']!='daily'){ ?>
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>

          <div class="formRight">
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=($item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>            
          </div>

          
          <div class="clear"></div>
        </div>
         <?php } ?>

        <?php if($_SESSION['login_admin']['type']!='daily'){ ?>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
		
     
		<div class="formRow">
			<div class="formRight">
            
   
                
                
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=daily&act=man_list'" class="blueB" />
                

			</div>
			<div class="clear"></div>
		</div>
		
		
	</div>  
	
</form>



</div><!--end wrapper-->