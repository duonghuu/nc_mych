<h3>Quản lý hình ảnh</h3>
<form name="frm" method="post" action="index.php?com=img&act=save" enctype="multipart/form-data" class="nhaplieu">
<?php for($i=0; $i<5; $i++){?>	
    <b>Hình ảnh <?=$i+1?></b> <input type="file" name="file<?=$i?>" /> <strong>.jpg&nbsp;|&nbsp;.gif&nbsp;|&nbsp;png</strong><br />
    <br />
	<b>Tiêu đề</b> <input name="ten<?=$i?>" type="text" size="40"   />	
	<br />
    <br />   
<b>Số thứ tự </b> <input type="text" name="stt<?=$i?>" value="1" style="width:30px" />	<br />
	<b>Hiển thị</b> <input type="checkbox" name="hienthi<?=$i?>" checked="checked" /> <br /><br />
	
<? }?>
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=img&act=man'" class="btn" />
</form>