<?php
    $d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='logo'";
    $d->query($sql_banner_top);
    $logo_top = $d->fetch_array();
	
	
	$d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='icon_top' and id='107'";
    $d->query($sql_banner_top);
    $icon_cart = $d->fetch_array();
	
	
		$d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='icon_top' and id='108'";
    $d->query($sql_banner_top);
    $icon_login = $d->fetch_array();
	
			$d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='icon_top' and id='109'";
    $d->query($sql_banner_top);
    $icon_register = $d->fetch_array();
	
	$d->reset();
  $sql = "select ten_$lang,thumb,link from #_photo where hienthi=1 and type='facebook' order by stt,id limit 0,2";
  $d->query($sql);
  $lienket = $d->result_array();

  $d->reset();
  $sql = "select ten_$lang,tenkhongdau from #_tags where hienthi=1 and type='product' order by stt,id limit 0,15";
  $d->query($sql);
  $tagtukhoa = $d->result_array();
	
?>

<script type='text/javascript'>
$(function(){$(window).scroll(function(){
      if($('body').width() > 992) {           
        if ($(this).scrollTop() > 80) {
          $(".nav-header-top").addClass("header-fixed");
        } else {
          $(".nav-header-top").removeClass("header-fixed");
        }              
      }            
                     
        if($(this).scrollTop()!=0){$('#bttop1').fadeIn();}
        else { $('#bttop1').fadeOut();}
        });
        
         $('#bttop1').click(function(){$('body,html').animate({scrollTop:0},800);
         });
});
</script>


<div id="middle_header" class="nav-header-top clearfix">
    <div class="margin-auto">
  
    		<div class="silogan_header">
    		    <img src="images/hotline.png"><?=$row_setting["slogan_$lang"]?>
    		</div>
  	
    	  <div id="banner_middle">
            <div class="bn_mid_left">
                <a href="trang-chu.htm" title="Siêu thị đồ gia dụng My Châu"><img src="<?=_upload_hinhanh_l.$logo_top['photo_vi']?>" alt="MyChau"></a>
            </div>
      	    <div class="r_head">
                <div class="bn_mid_center">
              	  <div id="timkiem">
              		   <form action="index.php"  method="" name="frm2" class="form_search">
              			  <input type="hidden" name="com" value="tim-kiem" />
              				<input type="text" name="keywords" id="name_tk"  class="input"  placeholder="Tìm kiếm sản phẩm trên Mych.vn" />
              				<div class="button_tim"><button type="submit" value="" class="nut_tim"><i class="fa fa-search" aria-hidden="true"></i></button></div>
              			</form>
              		</div><!--end timkiem-->
                  <div class="w_timkiem">
                    <marquee onMouseOver="this.stop()" onMouseOut="this.start()" scrollamount="4">
                      <?php foreach($tagtukhoa as $k){?>
                        <a href="tag-tu-khoa.html&<?=$k['tenkhongdau']?>"><?=$k['ten_'.$lang]?></a>
                      <?php } ?>
                    </marquee>
                  </div>
                </div>
          	  
                <div class="bn_top_right <?php if($_SESSION['login']['thanhvien']!='') echo'ss_login';?>">
                  <div class="flex_tt">
                     
                        <div class="w_login">
                          <?php if($_SESSION['login']['thanhvien']==''){ ?>
                            <a class="btn_login" href="#pop-login" title="Đăng nhập" >
                        			<img src="images/icon_login.png">
                        			<span>Đăng nhập</span>
                            </a> 
                          <?php }else{ ?>
                            <a class="user_info" href="don-hang.htm"><img src="images/icon_login.png"><?=$_SESSION['login']['email']?></a>
                            <a class="logout" href="dang-xuat.htm" title="Đăng xuất"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                          <?php } ?>
                        </div>
                        <div class="lienket_w">
                            <div class="cart cart_img">
                              <a class="cart" href="thanh-toan.htm" title="Xem giỏ hàng">
                                <span class="num_cart"><?=get_total();?></span>
                                <img src="images/icon_gh.png">
                              </a>
                              <?php include _template."layout/giohang_mini.php";?> 
                            </div>
                            <a href="javascript:void(0)">Kết nối</a>
                            <?php foreach($lienket as $k){?>
                              <a href="<?=$k['url']?>" target="_blank"><img src="<?=_upload_hinhanh_l?><?=$k['thumb']?>" alt="<?=$k['ten']?>" /></a>
                            <?php } ?>
                        </div>
                    
                  </div>
                </div>
            </div>
        </div>
  	
    </div>
</div>


<script language="javascript" src="js/my_script.js"></script>
<script language="javascript">
function js_submit(){
  if(isEmpty(document.getElementById('email'), "Xin nhập email.")){
    document.getElementById('email').focus();
    return false;
  }
  
  if(isEmpty(document.getElementById('pass'), "Xin nhập Password .")){
    document.getElementById('pass').focus();
    return false;
  }
    
  if(!isEmpty(document.dangky.password) && document.dangky.password.value.length<5){
    alert("Mật khẩu phải nhiều hơn 4 ký tự.");
    document.dangky.password.focus();
    return false;
  }
  
  if(!isEmpty(document.dangky.password) && document.dangky.password.value!=document.dangky.renew_pass.value){
    alert("Nhập lại mật khẩu mới không chính xác.");
    document.dangky.renew_pass.focus();
    return false;
  }
            
  if(isEmpty(document.getElementById('ten'), "Xin nhập họ tên .")){
    document.getElementById('ten').focus();
    return false;
  }

  if(isEmpty(document.getElementById('dienthoai'), "Xin nhập Số điện thoại.")){
    document.getElementById('dienthoai').focus();
    return false;
  }
  
  if(!isPhone(($('#dienthoai').val()), "Số điện thoại không hợp lệ.")){
    document.getElementById('dienthoai').focus();
    return false;
  }

  if(isEmpty(document.getElementById('diachi'), "Xin nhập địa chỉ .")){
    document.getElementById('diachi').focus();
    return false;
  }
          
  document.dangky.submit();
}
function js_submit_dn(){
  if(isEmpty(document.getElementById('username'), "Xin nhập tên đăng nhập.")){
    document.getElementById('username').focus();
    return false;
  }
  if(isEmpty(document.getElementById('password'), "Xin nhập password.")){
    document.getElementById('password').focus();
    return false;
  }
  document.form_login.submit();
}
</script>
<!-- Modal -->
<div class="pop" id="pop-login" style="display: none;">
    <div class="box-login w_user"> 
        <form id="login" action="dang-nhap.htm" name="form_login" method="post">
              <div class="tithead_login">Đăng nhập</div>
              <div class="form-field register mb-10">
                  <input id="username" class="input_website input100" name="username" type="text" placeholder="E-mail" value="<?=$_POST["username"]?>" autofocus required>
              </div>
              <div class="form-field register mb-10">       
                  <input id="password" class="input_website input100" name="password" type="password" placeholder="Password" value="<?=$_POST["password"]?>" required>
              </div>
              
              <div class="form-field register fogot_pass text-right">
                 <a href="javascript:void(0)" class="pop-signup"><span><?=_dangky?></span> </a><a href="quen-mat-khau.htm"><span><?=_quenmatkhau?></span> ?</a>
              </div>

              <div class="form-field register mg-t-15 text-right">
                  <input class="fix-button" onclick="js_submit_dn();" type="button" value="<?=_dangnhap?>"/>
              </div>
        </form>  
    </div>
    <div class="box-singup w_user">
        <form method="post" name="dangky" action="dang-ky.htm" class="dangnhaptv" enctype="multipart/form-data">
            <div class="tithead_login">Đăng ký</div>
            <div class="form-field register mb-10">
                <input type="text" name="email" id="email"  placeholder="E-mail" class="input_website input100"/>
            </div>
            <div class="form-field register mb-10">
                <input id="pass" type="password" name="password" onchange="toggle_pass('pass')" placeholder="<?=_matkhau?>" class="input_website input100"/>
            </div>
             <div class="form-field register mb-10">
                <input type="password" name="renew_pass"  size="35" placeholder="<?=_nhaplaimatkhau?>" class="input_website input100" />
            </div>
            <div class="form-field register mb-10">
                <input type="text" value="<?=$_POST["ten"]?>" name="ten" id="ten" size="35"   placeholder="<?=_hovaten?>" class="input_website input100"/>
            </div>
            <div class="form-field register mb-10">
                <input type="text" value="<?=$_POST["dienthoai"]?>" name="dienthoai" id="dienthoai"  size="35"  placeholder="<?=_dienthoai?>" class="input_website input100" />
            </div>
            <div class="form-field register mb-10">
                <input type="text" value="<?=$_POST["diachi"]?>" name="diachi" id="diachi"  size="35"  placeholder="<?=_diachi?>" class="input_website input100" />
            </div>
           
            <div class="form-field register fogot_pass text-right">
               <a href="javascript:void(0)" class="pop-login"><span><?=_dangnhap?></span> </a><a href="quen-mat-khau.htm"><span><?=_quenmatkhau?></span> ?</a>
            </div>

            <div class="form-field register mg-t-15 text-right">
                <input class="fix-button" onclick="js_submit();" type="button" value="<?=_dangky?>"/>
            </div>
            <input type="hidden" name="recaptcha_response_dk" id="recaptchaResponse_dk">      
        </form>
    </div>
</div>



<?php /*
 <div class="form-field register mb-10">
                <label >
                   <input type="radio" name="sex" value="1" checked="checked" <?php if($_POST['sex']=='Nam'){ echo "checked='checked'";}?> />
                    &nbsp;&nbsp;&nbsp; <span><?=_nam?></span> &nbsp;&nbsp;&nbsp; 
                </label>
                  <label>
                  <input type="radio" name="sex" value="0" <?php if($_POST['sex']=='Nu'){ echo "checked='checked'";}?>/>
                  &nbsp;&nbsp;&nbsp; <span><?=_nu?></span>
                </label>
            </div>
<div class="modal-dialog" style="display: none;">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Đăng ký thành viên</h4>
      </div>
      <div class="modal-body">
        <form method="post" name="dangky" action="dang-ky.htm" class="dangnhaptv" enctype="multipart/form-data">
            <div class="panel-body"> 
                   
                <div class="form-field register row">
                  <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register">E-mail</span></div>
                    <div class="col-sm-6 col-xs-12"><input type="text" name="email" id="email"  size="35"  placeholder="E-mail" class="input_website" /></div>     
                </div>
                 
                <div class="form-field register row">       
                  <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_matkhau?></span></div>
                    <div class="col-sm-6 col-xs-12"><input id="pass" type="password" name="password" onchange="toggle_pass('pass')" placeholder="<?=_matkhau?>" class="form-control input_website"/></div>          
                </div>
                
                <div class="form-field register row">     
                  <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_nhaplaimatkhau?></span></div>
                    <div class="col-sm-6 col-xs-12"><input type="password" name="renew_pass"  size="35" placeholder="<?=_nhaplaimatkhau?>" class="form-control input_website" /></div>  
                      
                </div>
                
                <div class="form-field register row">
                <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_hovaten?></span></div>        
                <div class="col-sm-6 col-xs-12"><input type="text" value="<?=$_POST["ten"]?>" name="ten" id="ten" size="35"   placeholder="<?=_hovaten?>" class="form-control input_website"/></div>
                
                
                </div>
                
                
                <div class="form-field register row">
                <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_dienthoai?></span></div>        
                <div class="col-sm-6 col-xs-12"><input type="text" value="<?=$_POST["dienthoai"]?>" name="dienthoai" id="dienthoai"  size="35"  placeholder="<?=_dienthoai?>" class="form-control input_website" /></div>
                
                
                </div>
                
                <div class="form-field register row">
                <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_diachi?></span></div>        
                <div class="col-sm-6 col-xs-12"><input type="text" value="<?=$_POST["diachi"]?>" name="diachi" id="diachi"  size="35"  placeholder="<?=_diachi?>" class="form-control input_website" /></div>
                
                
                </div>
                
                <div class="form-field register row">
                <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_sex?> :</span></div>        
                <div class="col-sm-6 col-xs-12 sex">
                  <label>
                    <input type="radio" name="sex" value="1" checked="checked" <?php if($_POST['sex']=='Nam'){ echo "checked='checked'";}?> />
                    &nbsp;&nbsp;&nbsp; <span><?=_nam?></span> &nbsp;&nbsp;&nbsp; 
                    </label>
                    
                    <label>
                    <input type="radio" name="sex" value="0" <?php if($_POST['sex']=='Nu'){ echo "checked='checked'";}?>/>
                    &nbsp;&nbsp;&nbsp; <span><?=_nu?></span>
                    </label>
                  
                    
                </div>
                
  
                
                
                </div>
                
                
                <div class="form-field register row">
                <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_maxacnhan?></span></div>        

                <div class="col-sm-3 col-xs-8">
                  <input type="text" name="txtCaptcha" id="txtCaptcha" maxlength="10" size="12" placeholder="<?=_maxacnhan?>" class="form-control pull-left input_website"/>
                </div>
                
                <div class="col-sm-3 col-xs-4 capcha_txt text-left"><img src="capcha.php" style="" /></div>
                
                
                </div>
                
                 <div class="form-field register row mg-t-15">
                    <div class="col-sm-offset-3 col-sm-6 col-xs-12 text-left">
                        <input class="fix-button" onclick="js_submit();" type="button" value="<?=_dangky?>"/>
                        <input class="fix-button" type="button" value="<?=_nhaplai?>" onclick="document.dangky.reset();" /> 
                    </div>
                </div>
                
            </div>
          </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal_dn" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Đăng nhập</h4>
      </div>
      <div class="modal-body">
          <form id="login" action="dang-nhap.htm" name="form_login" method="post">
            <div class="panel-body"> 
                   
                <div class="form-field register row">
                  <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register">E-mail</span></div>
                    <div class="col-sm-6 col-xs-12"><input id="username" class="form-control input_website" name="username" type="text" placeholder="E-mail" value="<?=$_POST["username"]?>" autofocus required></div>
                    
                          
                </div>
                 
                <div class="form-field register row">       
                  <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_matkhau?></span></div>
                    <div class="col-sm-6 col-xs-12"><input id="password" class="form-control input_website" name="password" type="password" placeholder="Password" value="<?=$_POST["password"]?>" required></div>
                    <div class="col-sm-3 col-xs-12"><div id="password_strength"></div></div>
                              
                </div>
                
                <div class="form-field register row fogot_pass">
                    <div class="col-sm-offset-3 col-sm-6 col-xs-12 text-left">
                        <a href="quen-mat-khau.htm"><span><?=_quenmatkhau?></span> ? </a><a href="dang-ky.htm"><span><?=_dangky?></span> </a>
                    </div>
                </div>
                
                
                
                <div class="form-field register row mg-t-15">
                    <div class="col-sm-offset-3 col-sm-6 col-xs-12 text-left">
                        <input class="fix-button" onclick="js_submit_dn();" type="button" value="<?=_dangnhap?>"/>
                         
                    </div>
                </div>
                
              </div>
          </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>*/ ?>