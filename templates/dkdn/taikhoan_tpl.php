<link type="text/css" rel="stylesheet" href="js/datetimepicker/jquery.datetimepicker.css" />
<script type="text/javascript" src="js/datetimepicker/jquery.datetimepicker.full.min.js"></script>
<?php
$stringphone  = $_SESSION['login']['dienthoai'];
$str_phone1 = substr($stringphone,1,8);
$str_phone2 = substr($stringphone,8,10);
$str_mahoa="********";
?>
<script  type="text/javascript" charset="utf-8">
$(document).ready(function() {


    jQuery('.pick_date').datetimepicker({
        i18n:{
            de:{
                months:[
                'Januar','Februar','März','April',
                'Mai','Juni','Juli','August',
                'September','Oktober','November','Dezember',
                ],
                dayOfWeek:[
                "So.", "Mo", "Di", "Mi", 
                "Do", "Fr", "Sa.",
                ]
            }
        },
        timepicker:false,
        format:'d/m/Y'
    });

});
</script>
<script language="javascript">
$(document).ready(function($) {
    $('.no_update').click(function(event) {
        $(this).addClass('none-click');
        $('.input-phone').addClass('block_up');
    });
    $('.file_input').click(function (){
      $( ".taihinhanh" ).trigger( "click" );
      //$('.ten_hinh').text($('.taihinhanh').val());
      //$file_name = images_name($_FILES['file']['name']);
    });
});
function js_submit_up(){
	// if(isEmpty(document.getElementById('email'), "Xin nhập email.")){
	// 	document.getElementById('email').focus();
	// 	return false;
	// }
	
	if(isEmpty(document.getElementById('ten_up'), "Xin nhập họ tên .")){
		document.getElementById('ten_up').focus();
		return false;
	}

    // if(isEmpty(document.getElementById('pass_up'), "Xin nhập Password .")){
    //     document.getElementById('pass_up').focus();
    //     return false;
    // }
    
    // if(!isEmpty(document.dangky_up.password_up) && document.dangky_up.password_up.value.length<5){
    //     alert("Mật khẩu phải nhiều hơn 4 ký tự.");
    //     document.dangky.password_up.focus();
    //     return false;
    // }
    
    // if(!isEmpty(document.dangky_up.password_up) && document.dangky_up.password_up.value!=document.dangky_up.renew_pass_up.value){
    //     alert("Nhập lại mật khẩu mới không chính xác.");
    //     document.dangky_up.renew_pass_up.focus();
    //     return false;
    // }

    if(document.getElementsByClassName('block_up').length > 0){
    	if(isEmpty(document.getElementById('dienthoai_up'), "Xin nhập Số điện thoại.")){
    		document.getElementById('dienthoai_up').focus();
    		return false;
    	}
    	
    	if(!isPhone(($('#dienthoai_up').val()), "Số điện thoại không hợp lệ.")){
    		document.getElementById('dienthoai_up').focus();
    		return false;
    	}
    }

	if(isEmpty(document.getElementById('diachi_up'), "Xin nhập địa chỉ .")){
		document.getElementById('diachi_up').focus();
		return false;
	}
       
	 
	document.dangky_up.submit();
}
</script>
 
 
<div class="main_content pa_top">
        
    <div class="flex_taikhoan">
        <div class="l_taikhoan"> 
            <div class="box-img-name-user">
                <div class="img-user">
                    <img src="<?=_upload_member_l?><?=$row_thanhvien['photo']?>" alt="<?=$row_thanhvien['username']?>" onerror="this.src='http://placehold.it/70x70';">
                </div> 
                <div class="name-user">
                    <div class="ten_user"><?=$row_thanhvien['ten']?></div>   
                    <p onclick="window.location.href='tai-khoan.htm'"><i class="fa fa-pencil"></i> Sửa hồ sơ</p> 
                </div>
            </div>
            <div class="box-info-donmua">
                <div class="info_user item-info-user <?php if($com=='tai-khoan') echo 'active';?>"><img src="images/info_user.png"><a href="tai-khoan.htm">Tài khoản của tôi</a></div>
                <div class="donmua_user item-info-user <?php if($com=='don-hang') echo 'active';?>"><img src="images/donmua.png"> <a href="don-hang.htm">Đơn Mua</a></div>
            </div>
        </div>
        <div class="r_taikhoan">
            <div class="box-head-user">
                <h3>Hồ sơ của tôi</h3>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            </div>
            <div class="box-update-user">     
            	<form method="post" name="dangky_up" action="" class="dangnhaptv" enctype="multipart/form-data">
                    <input type="hidden" name="recaptcha_response_cn" id="recaptchaResponse_cn">   
                    <div class="flex-box-update">
                        <div class="box-l-update">

                            <div class="row-update">
                            	<span class="txt_register">E-mail</span>
                                <div class="row-input-update">
                                    <input type="text" disabled="disabled" value="<?=$_SESSION['login']['email']?>" name="email" id="email"  size="35"  placeholder="E-mail" class="input-update input-100 none-input" autocomplete="false" />
                                    <div class="col-sm-12 col-xs-12"><span class="kiemmail"></span></div>    
                                </div>
                            </div>

                             <div class="row-update">
                                <span class="txt_register"><?=_dienthoai?></span>        
                                <div class="row-input-update">
                                    <span class="no_update"><?=$str_mahoa?><?=$str_phone2?> <i>Thay đổi</i></span>
                                    <input type="text" value="" name="dienthoai_up" id="dienthoai_up"  size="35"  placeholder="Số điện thoại" class="input-update input-100  input-phone" autocomplete="false" />
                                </div>
                            </div>
                             
                            
                            <div class="row-update">
                                <span class="txt_register"><?=_hovaten?></span>       
                                <div class="row-input-update"><input type="text" value="<?=$_SESSION['login']['ten']?>" name="ten_up" id="ten_up" size="35" placeholder="<?=_hovaten?>" class="input-update input-100"/></div>
                            </div>


                            <div class="row-update">      
                                <span class="txt_register"><?=_matkhau?></span>
                                <div class="row-input-update"><input id="pass_up" type="password" name="password_up" value="" placeholder="<?=_matkhau?>" class="input-update input-100"/>
                                </div>              
                            </div>

                            
                            <div class="row-update">
                                <span class="txt_register"><?=_diachi?></span> 
                                <div class="row-input-update"><input type="text" value="<?=$_SESSION['login']["diachi"]?>" name="diachi_up" id="diachi_up"  size="35"  placeholder="<?=_diachi?>" class="input-update input-100" /></div>
                            </div>

                             <div class="row-update">
                                <span class="txt_register">Ngày sinh</span> 
                                <div class="row-input-update">
                                    <input type="text" value="<?=($row_thanhvien['ngaysinh'])?date("d/m/Y",@$row_thanhvien['ngaysinh']):date("d/m/Y",time())?>" name="ngaysinh_up" id="ngaysinh_up" title="Vui lòng chọn ngày sinh" class="pick_date input-update input-100" />
                                </div>
                            </div>
                            
                            <div class="row-update">
                                <span class="txt_register"><?=_sex?> :</span>     
                                <div class="row-input-update sex">
                                	<label>
                                    <input type="radio" name="sex_up" value="1" checked="checked" <?php if($_SESSION['login']['sex']=='1'){ echo "checked='checked'";}?> />
                                    &nbsp;&nbsp;&nbsp; <span><?=_nam?></span> &nbsp;&nbsp;&nbsp; 
                                    </label>
                                    
                                    <label>
                                    <input type="radio" name="sex_up" value="0" <?php if($_SESSION['login']['sex']=='0'){ echo "checked='checked'";}?>/>
                                    &nbsp;&nbsp;&nbsp; <span><?=_nu?></span>
                                    </label>
                                </div>
                            </div>
                            
            				<div class="form-field register row mg-t-15">
                                <div class="col-sm-offset-3 input-update text-left">
                                    <input class="fix-button" onclick="js_submit_up();" type="button" value="<?=_capnhat?>"/>
                                    
                                </div>
                            </div>

                        </div>
                        <div class="box-r-update">
                            <div class="anhdaidien">
                                <img src="<?=_upload_member_l?><?=$row_thanhvien['photo']?>" alt="<?=$row_thanhvien['ten']?>" onerror="this.src='http://placehold.it/110x110';">
                            </div>
                            <div class="chonanh">
                                <input type="file" name="file" class="taihinhanh" style="position: absolute;left: -9999px;top: -9999px;z-index: -9999;">
                                <a class="file_input"><i class="fa fa-paperclip"></i> Chọn ảnh</a>
                            </div>
                            <div class="note-hinhdaidien">
                                <p>Dung lượng file tối đa 1 MB</p>
                                <p>Định dạng: JPEG, PNG, JPG</p>
                            </div>
                        </div>  
                    </div>
                </form>	
            </div>
        </div>
    </div>

</div>

<style type="text/css">


</style>


<!-- <div class="thanh_title"><h2><?=$title_tcat?></h2><a class="xemthem" href="don-hang.htm">Xem đơn hàng của bạn</a> </div><div class="clear" style="height:20px;"></div>
   -->

