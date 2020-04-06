<script language="javascript" src="admin/media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit65(){
	if(isEmpty(document.getElementById('email'), "Xin nhập Email Nhận Thông Tin.")){
		document.getElementById('email').focus();
		return false;
	}
	document.frm2.submit();
}
</script>
<div id="info">
<div id="sanpham">
                        		<div class="thanhsp">Đăng Ký Dịch Vụ</div>
                             
                            <form action="?com=nhanmail"  method="post" name="frm2" onSubmit="return js_submit65();">
                               <fieldset>
                                <legend>Điền Thông Tin Dịch Vụ</legend>
                                		<label>Tiêu Đề  :</label>
                                            <input type="text" name="tieude" size="20" id="tieude"/><br /><br />
                                            <label>Nội Dung : </label><textarea cols="50" rows="10" name="noidung" id="noidung"></textarea><br />
                                          
                                            <input type="submit" name="nhanmail" value="Đăng Ký" class="nhann" />
                                     
                             </fieldset>
                              </form>
                        </div>
                        </div>