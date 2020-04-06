<div id="doitac">
        <div class="thanhdoitac">
          <div class="dt_t"></div>
          
          <div class="dt_g">
            <div class="tieudedoitac">Tư vấn kiến trúc</div>
            <div class="linhweb">
            <ul>
            <li class="linkweb"><a href="?com=knews&id=1" style="color:#CC6600; font-weight:bold;">Đặt câu hỏi</a></li>
            </ul>
            </div>
          </div>
          <div class="dt_p"></div>
        </div>
        <div id="khungdoitac">
       <table width="100%" cellpadding="2" cellspacing="2" border="0">
      <?php foreach($tintuc as $row_tintuc){?>
       <tr>
       <td valign="top" style="border:1px solid #CCCCCC; padding:5px;"> 
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
      
       
         <tr>
        <td>
        <span style="color:#999999;"><img src="images/hoi.jpg" align="absmiddle" />Hỏi:&nbsp;<?=$row_tintuc['ten']?>(<?=make_date($row_tintuc['ngaytao'])?>)</span>
        </td>
        </tr>
          <tr>
        <td style="padding-left:40px;">
        <span style="color:#999999;"> <?=$row_tintuc['mota']?></span>
        </td>
        </tr>
       
        <tr><td height="5px" style="border-bottom:1px thin dotted #999999;"></td></tr>
     
        <tr>
        <td>
        <span style="color:#999999;"><img src="images/traloi.jpg" align="absmiddle" />Trả lời&nbsp;(<?=make_date($row_tintuc['ngaytao'])?>)</span>
        </td>
        </tr>
          <tr>
        <td style="padding-left:40px;" valign="top" align="left">
         <?=$row_tintuc['noidung']?>
        </td>
        </tr>
      
        </table>
 		</td></tr>
          <?php }?>
         <tr><td><div align="center" ><div class="paging"><?=$paging['paging']?></div></div>  </td></tr> 
        </table>
        </div>
        
        <div class="bong3"></div>
      </div>