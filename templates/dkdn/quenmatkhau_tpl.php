<style>
    .contentpaneopen, .contentpaneopen tr , .contentpaneopen td{
        text-align: left;
    }
</style>
<script language="javascript" src="js/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(!check_email(document.frm_forgot.email.value)){
		alert("Email không hợp lệ");
		document.frm_forgot.email.focus();
		return false;
	}
	document.frm_forgot.submit();
}
</script>

<div class="main_content">
	<div class="title_index"><h2><?=_quenmatkhau?></h2></div>
 
    <div class="khung_sp_all">     
    	<form method="post" name="frm_forgot" action="quen-mat-khau.htm" class="dangnhaptv">
            <div class="panel-body"> 
            	
                <div class="form-field register row">
                	
                    <div class="col-sm-12 col-xs-12 text-center text-nhapemail"><?=_vuilongnhap?> <span style="color:#f00; text-decoration:underline;">E-mail</span> <?=_denhanlaimatkhautuchungtoi?>.</div>
                    
                    	    
                </div>
                
            
                   
                <div class="form-field register row">
                	<div class="col-sm-3 col-xs-12 hidden-xs text-right"><span class="txt_register">E-mail</span></div>
                    <div class="col-sm-6 col-xs-12"><input name="email" type="text" class="tflienhe form-control" size="50" class="input" height="30" placeholder="E-mail" /></div>
                    
                    	    
               
                    <div class="col-sm-3 col-xs-12 hidden-xs text-left">
                        <input type="button" class="fix-button" onclick="js_submit();" value="&nbsp;<?=_gui?>&nbsp;" />
                    </div>
                </div>
                
				
                
                </div>
            </form>	
    </div>

</div>




