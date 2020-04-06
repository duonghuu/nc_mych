<script src="admin/media/scripts/my_script.js" type="text/javascript"></script>
<script language="javascript">
function js_submit1(){
	if(isEmpty(document.getElementById('thanhvien1'), "Xin nhập tên đăng nhập.")){
		document.getElementById('thanhvien1').focus();
		return false;
	}
	if(isEmpty(document.getElementById('password1'), "Xin nhập password.")){
		document.getElementById('password1').focus();
		return false;
	}
	document.frm1.submit();
}
</script>
<link rel="stylesheet" type="text/css" href="css/form_login.css" />
<article id="info" class="col-md-12 col-sm-12 col-xx-12 col-xs-12">
    <div id="sanpham">
        <div class="thanhsp"><h2>Đăng Nhập</h2></div>

        <div class="dieuhuong">
            <ul>
                <li><a href="trang-chu.html"><img src="images/home.png" alt="home" title="trang chủ"> Trang chủ </a></li>
                <li><a href="dang-nhap.html" title="Đăng Nhập"> Đăng Nhập</a></li>
            </ul>
        </div>


          <div class="khung">
                   <form id="login" action="" name="form_dn" method="post">
                        <fieldset id="inputs">
                            <input id="username" name="username" type="text" placeholder="Email đăng nhập" autofocus required>   
                            <input id="password" name="password" type="password" placeholder="Password" required>
                        </fieldset>
                        <fieldset id="actions">
                            <input type="submit" id="submit" value="Đăng nhập">
                            <a href="quen-mat-khau.html">Quên mật khẩu ? </a><a href="dang-ky.html">Đăng ký</a>
                        </fieldset>
                    </form>
                
</div></div></article>