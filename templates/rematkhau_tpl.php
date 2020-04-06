<script language="javascript" src="admin/media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){

	if(!check_email(document.frm.email.value)){
		alert("Email không hợp lệ");
		document.frm.email.focus();
		return false;
	}
	
	document.frm.submit();
}
</script>


<article id="info" class="col-lg-12 col-md-12 col-sm-12 col-xx-12 col-xs-12">
		<div id="sanpham">
		<div class="title_content"><h2>Quên Mật Khẩu</h2></div>
        <div class="dieuhuong">
            <ul>
                <li><a href="trang-chu.html"><img src="images/home.png" alt="home" title="trang chủ"> Trang chủ </a></li>
                <li><a href="quen-mat-khau.html" title="Quên Mật Khẩu"> Quên Mật Khẩu </a></li>
            </ul>
        </div>
		<div class="khung">
        <?php if($_GET['thanhvien']==''){?>
                    <p style="font-size:16px; line-height:20px; padding:10px 20px 20px 20px; color:#999999; text-align:center;">
					Bạn Quên Mật Khẩu ? . Bạn hãy nhập Email mà bạn đã đăng ký thành viên vào đây để nhận  Password thông qua mail của bạn .</p>
					<form method="post" name="frm" action="quen-mat-khau.html" style="max-width:520px; margin:auto;">
						<div class="col-md-3 col-sm-3 col-xx-3 col-xs-12">
                            <label>Email : <span> * </span></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xx-9 col-xs-12">
                            <div class="flex_qmk">
                            <input type="email" name="email" id="email" required="required" placeholder="Nhập email của bạn" class="form-control" value="<?=$thanhvien ['email']?>" /><br />
                            </div>
                            <button type="submit" class="btn btn-primary dangbai" data-toggle="button" aria-pressed="false" autocomplete="off" style="float:right;" onclick="js_submit()">Gửi Email</button></div>

					</form>
	
                           <?php }  else { ?>
                          	<?php if($thongbao=='true'){?>
                            <div style="text-align:center; margin-top:30px; margin-bottom:30px;">
                            	<p  style="padding-bottom:20px;">Lấy password thành công . Thông tin đăng nhập của bạn là !</p>
                                <p><b>Email&nbsp;&nbsp;&nbsp; : </b> <?=$email_thanhvien[0]['email']?></p>
                                <p><b>Password : </b> <?=$mathanhvien?></p>
                            </div>
                            <?php } else {?>
                            <div style="text-align:center; margin-top:30px; margin-bottom:30px;">
                           		<p>Lấy password không thành công . vui lòng lấy lại password !</p>
                                </div>
                            <?php } ?>
                           <?php } ?>
					</div>

</div>
			
</article>
 