<script language="javascript" src="js/my_script.js"></script>
<script language="javascript">
function js_submit_dangky(){
	if(isEmpty(document.getElementById('email_dky'), "Xin nhập email.")){
		document.getElementById('email_dky').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('pass_dky'), "Xin nhập Password .")){
		document.getElementById('pass_dky').focus();
		return false;
	}
    
	if(!isEmpty(document.dangky_form.pass_dky) && document.dangky_form.pass_dky.value.length<5){
		alert("Mật khẩu phải nhiều hơn 4 ký tự.");
		document.dangky_form.pass_dky.focus();
		return false;
	}
	
	if(!isEmpty(document.dangky_form.pass_dky) && document.dangky_form.pass_dky.value!=document.dangky_form.renewpass_dky.value){
		alert("Nhập lại mật khẩu mới không chính xác.");
		document.dangky_form.renewpass_dky.focus();
		return false;
	}
            
	if(isEmpty(document.getElementById('ten_dangky'), "Xin nhập họ tên .")){
		document.getElementById('ten_dangky').focus();
		return false;
	}

	if(isEmpty(document.getElementById('dienthoai_dky'), "Xin nhập Số điện thoại.")){
		document.getElementById('dienthoai_dky').focus();
		return false;
	}
	
	if(!isNumber(document.getElementById('dienthoai_dky'), "Số điện thoại không hợp lệ.")){
		document.getElementById('dienthoai_dky').focus();
		return false;
	}

	if(isEmpty(document.getElementById('diachi_dgky'), "Xin nhập địa chỉ .")){
		document.getElementById('diachi_dgky').focus();
		return false;
	}
            
	if(isEmpty(document.getElementById('txtCaptcha_dky'), "Xin nhập mã xác nhận .")){
		document.getElementById('txtCaptcha_dky').focus();
		return false;
	}
	document.dangky_form.submit();
}
</script>
 
 
<div class="main_content">
        
 
        <div class="title_index"><h2><?=$title_tcat?></h2> </div>

        
        <div class="khung_login">     
    	<form method="post" name="dangky_form" action="dang-ky.htm" class="dangnhaptv" enctype="multipart/form-data">
            <div class="panel-body"> 
                   
                <div class="form-field register row">
                	<div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register">E-mail</span></div>
                    <div class="col-sm-6 col-xs-12"><input type="text" name="email" id="email_dky"  size="35"  placeholder="E-mail" class="form-control input_website" /></div>	    
                </div>
                 
                <div class="form-field register row">       
                	<div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_matkhau?></span></div>
                    <div class="col-sm-6 col-xs-12"><input id="pass_dky" type="password" name="password" onchange="toggle_pass('pass')" placeholder="<?=_matkhau?>" class="form-control input_website"/></div>					
                </div>
                
                <div class="form-field register row">     
                	<div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_nhaplaimatkhau?></span></div>
                    <div class="col-sm-6 col-xs-12"><input id="renewpass_dky" type="password" name="renew_pass"  size="35" placeholder="<?=_nhaplaimatkhau?>" class="form-control input_website" /></div>	
                    	
                </div>
                
                <div class="form-field register row">
                <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_hovaten?></span></div>        
                <div class="col-sm-6 col-xs-12"><input  type="text" value="<?=$_POST["ten"]?>" name="ten" id="ten_dangky" size="35"   placeholder="<?=_hovaten?>" class="form-control input_website"/></div>
                
                
                </div>
                
                
                <div class="form-field register row">
                <div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_dienthoai?></span></div>        
                <div class="col-sm-6 col-xs-12"><input type="text" value="<?=$_POST["dienthoai"]?>" name="dienthoai" id="dienthoai_dky"  size="35"  placeholder="<?=_dienthoai?>" class="form-control input_website" /></div>
                
                
                </div>
                
                <div class="form-field register row">
                
				<div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register"><?=_diachi?></span></div>        
                <div class="col-sm-6 col-xs-12"><input type="text" value="<?=$_POST["diachi"]?>" name="diachi" id="diachi_dgky"  size="35"  placeholder="<?=_diachi?>" class="form-control input_website" /></div>
                
                
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
                	<input type="text" name="txtCaptcha" id="txtCaptcha_dky" maxlength="10" size="12" placeholder="<?=_maxacnhan?>" class="form-control pull-left input_website"/>
                </div>
                
                <div class="col-sm-3 col-xs-4 capcha_txt text-left"><img src="capcha.php" style="" /></div>
                
                
                </div>
                
				<div class="form-field register row mg-t-15">
                    <div class="col-sm-offset-3 col-sm-6 col-xs-12 text-left">
                        <input class="fix-button" onclick="js_submit_dangky();" type="button" value="<?=_dangky?>"/>
                        <input class="fix-button" type="button" value="<?=_nhaplai?>" onclick="document.dangky.reset();" /> 
                    </div>
                </div>
                
                </div>
            </form>	
    </div>

      </div>
  

