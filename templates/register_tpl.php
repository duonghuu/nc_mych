<script language="javascript">
function js_submit444(){

	if(isEmpty(document.getElementById('email'), "Xin nhập email.")){
		document.getElementById('email').focus();
		return false;
	}
	if(!check_email(document.dangky.email.value)){
		alert("Email không hợp lệ");
		document.dangky.email.focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('pass'), "Xin nhập Password .")){
		document.getElementById('pass').focus();
		return false;
	}
	
	if(!isEmpty(document.dangky.password) && document.dangky.password.value.length<5){
		alert("Mật khẩu phải nhiều hơn 6 ký tự.");
		document.dangky.password.focus();
		return false;
	}
	
	if(!isEmpty(document.dangky.password) && document.dangky.password.value!=document.dangky.renew_pass.value){
		alert("Nhập lại mật khẩu mới không chính xác.");
		document.dangky.renew_pass.focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('hoten'), "Xin nhập họ tên .")){
		document.getElementById('hoten').focus();
		return false;
	}
	if(isEmpty(document.getElementById('diachi'), "Xin nhập địa chỉ .")){
		document.getElementById('diachi').focus();
		return false;
	}
	if(isEmpty(document.getElementById('dienthoai'), "Xin nhập điện thoại .")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	if(isEmpty(document.getElementById('captcha-code'), "Xin nhập mã xác nhận .")){
		document.getElementById('captcha-code').focus();
		return false;
	}
	document.dangky.submit();
}
</script>
<link href="reCaptcha/style.css" rel="stylesheet" type="text/css">
<script>
$(document).ready(function() { 
// refresh captcha
$('img#captcha-refresh').click(function() {  	
	change_captcha();
});
function change_captcha()
{
	document.getElementById('captcha').src="reCaptcha/get_captcha.php?rnd=" + Math.random();
}
});
</script>
 
<article id="info" class="col-md-12 col-sm-12 col-xx-12 col-xs-12">
    <div id="sanpham">
        <div class="thanh_title"><h2>Đăng ký thành viên</h2></div>
        <div class="dieuhuong">
            <ul>
                <li><a href="trang-chu.html"><img src="images/home.png" alt="home" title="trang chủ"> Trang chủ </a></li>
                <li><a href="dang-ky.html" title="Đăng ký thành viên"> Đăng ký thành viên </a></li>
            </ul>
        </div>

          <div class="khung">
            <div class="noidung">
                <form method="post" name="dangky" action="dang-ky.html" class="dangnhaptv" enctype="multipart/form-data">
                    		
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">
                            <label>Email : <span>*</span></label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">
                            <input type="text" name="email" id="email"    placeholder="Nhập email của bạn" class="form-control" value="<?=$_POST['email']?>" /><br />
                            </div>
                          	<div class="clear"></div>
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">
                            <label>Mật Khẩu : <span>*</span></label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">
                            <input id="pass" type="password" name="password" onchange="toggle_pass('pass')" placeholder="Nhập password" class="form-control"/>
                            <strong>Mật khẩu ít nhất 6 ký tự .</strong><br /><br />
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">
                            <label>Nhập Lại Mật Khẩu : <span>*</span></label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">
                            <input type="password" name="renew_pass"   placeholder="Nhập lại mật khẩu trên" class="form-control" /><br />
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">
                            <label>Họ Và Tên : <span>*</span></label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">
                            <input type="text" name="hoten" id="hoten"   placeholder="Nhập họ tên" class="form-control" value="<?=$_POST['hoten']?>" /><br />
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">
                            <label>Giới Tính : </label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">
                                                    <input type="radio" name="gioitinh" value="Nam" <?php if($_POST['gioitinh']=='Nam'){ echo "checked='checked'";}?> />&nbsp;&nbsp;&nbsp;Nam&nbsp;&nbsp;&nbsp; 
                                                    <input type="radio" name="gioitinh" value="Nữ" <?php if($_POST['gioitinh']=='Nữ'){ echo "checked='checked'";}?>/>&nbsp;&nbsp;&nbsp; Nữ
                            </div> 
                                    <div class="clear"></div>               
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">                       
                            <label>Địa Chỉ : <span>*</span></label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">
                            <input type="text" name="diachi" id="diachi"  size="35"  placeholder="Nhập địa chỉ" class="form-control" value="<?=$_POST['diachi']?>"  /><br />
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">  
                            <label>Ảnh Đại Diện : </label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">  
                            <input type="file" name="file"/><br /><br />
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">  
                            <label>Điện Thoại : <span>*</span></label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xx-8 col-xs-12">  
                            <input type="text" name="dienthoai" id="dienthoai"  size="35"  placeholder="Nhập Số điện thoại" class="form-control" value="<?=$_POST['dienthoai']?>" /><br />
                            </div>
                      <div class="clear"></div>
                           
                            <label>&nbsp;</label><span style="color:rgba(255,0,0,1);"><?=$loi?></span><br />
                            <div class="clear"></div>
                           <div class="capchaaaa">
                               <div id="captcha-wrap">
                                    <div class="captcha-box">
                                        <img src="reCaptcha/get_captcha.php" alt="" id="captcha" />
                                    </div>
                                    <div class="text-box">
                                        <label>Type the two words:</label>
                                        <input name="captcha-code" type="text" id="captcha-code" required="required">
                                    </div>
                                    <div class="captcha-action">
                                        <img src="reCaptcha/refresh.jpg"  alt="" id="captcha-refresh" />
                                    </div>
                                </div>
                           </div>
                           <br /><br />
                           <div class="clear"></div>
                            <div class="dangky_icon"><img src="images/icon_dangky.gif" border="0" style="cursor:pointer;" onclick="js_submit444();" class="dkt" /></div>
                   
                         
                </form>
               
                
           </div>
           </div>

    </div>		
</article>
        	