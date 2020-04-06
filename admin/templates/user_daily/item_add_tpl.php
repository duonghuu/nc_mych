<script type="text/javascript" src="js/script_gaconit.js"></script>
<script type="text/javascript">
// Đại lý
<?php if(@$_REQUEST['act']=='edit' and $item['id_daily']!=0) {?>
		load_daily_edit(<?=$item['id_daily']?>);
<?php }  else {?>
		load_daily();
<?php } ?>
</script>

<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=dskhorder&act=man"><span>Xem Thành Viên</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->


<form name="frm" id="validate" class="form" method="post" action="index.php?com=user_daily&act=save&curPage=<?=@$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Dữ liệu</h6>
		</div>		

		<div class="formRow">
			<label>Đại lý</label>
			<div class="formRight">
            	<div class="selector">
            		<?php if($_SESSION['login_admin']['type']=='daily') { 
            			echo getNameDaily($_SESSION['login_admin']['id_daily'],'vi');
            		}else{ ?>
						<select id="id_daily" name="id_daily" class="main_font">
	                        <option value="">Chọn Đại lý</option>
	                    </select>
                    <?php } ?>
                </div>
			</div>
			<div class="clear"></div>
		</div>
      	
		
        <div class="formRow">
			<label>Tên đăng nhập (để quản trị)</label>
			<div class="formRight">
                <input type="text" name="username" title="Nhập tên đăng nhập" id="hoten" class="tipS validate[required]" value="<?=@$item['username']?>" <?php if($_SESSION['login_admin']['type']=='daily') echo 'readonly="readonly"' ?> />
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->

		<?php if($_GET['act']=='edit') { ?>
		 <div class="formRow">
			<label>Nhập mật khẩu mới</label>
			<div class="formRight">
                <input type="password" id="txt_pass" name="matkhau" title="Nhập mật khẩu mới" id="hoten" class="tipS" value="<?=@$item['matkhau']?>" />

                <?php if($_SESSION['login_admin']['type']!='daily') { ?>
                <div style="margin-top: 10px;"><a style="font-weight: bold" href="javascript:void(0)" id="random_char">Tạo ngẫu nhiên</a></div>
                <?php } ?>
			</div><!--end formRight-->
			<div class="clear"></div>
			<script type="text/javascript">
                $().ready(function(){
                    $("#random_char").on("click",function(){
                        $("#txt_pass").val(randomChar());
                    })
                    function randomChar(){
                        var text = "";
                        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                        for( var i=0; i < 6; i++ )
                            text += possible.charAt(Math.floor(Math.random() * possible.length));

                        return text;
                    }
                })
            </script>
		</div><!--end formRow-->
		<?php } ?>


		<div class="formRow">
            <label>Email (để đăng nhập website)</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['email']?>" name="email" title="Nhập Email" class="tipS validate[required]" />
                <?php if($act=='edit') { ?>
                    <input type="hidden" id="txt_email_old" name="email_old" value="<?=@$item['email']?>" />
                <?php } ?>
            </div>
            <div class="clear"></div>           
        </div>
        
       
    <div class="formRow">
			<div class="formRight">
            
            <?php if($_SESSION['login_admin']['type']=='daily') { ?>
            	<input type="hidden" name="id_daily" value="<?=@$_SESSION['login_admin']['id_daily']?>" />
            <?php } ?>
       
			    <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
				<input type="submit" value="Lưu" class="blueB" />
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=user_daily&act=man'" class="blueB" />        
            
            
			</div>
			<div class="clear"></div>
		</div>	
		
		
	</div>  
	
</form>



</div><!--end wrapper-->
