<script src="js/my_script.js" type="text/javascript"></script>
<script language="javascript">
function js_submit(){
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


<div class="main_content">
        
 
        <div class="title_index"><h2><?=$title_tcat?></h2></div>
                    
        <div class="khung_login">     
    	<form id="login" action="" name="form_login" method="post">
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
                        <input class="fix-button" onclick="js_submit();" type="button" value="<?=_dangnhap?>"/>
                         
                    </div>
                </div>
                
                </div>
            </form>	
    </div>

      </div>
      