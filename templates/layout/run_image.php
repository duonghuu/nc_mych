<?php
  $d->reset();
	$sql_muaban = "select tenkhongdau,ten_$lang,mota_$lang,id,thumb from #_baiviet where hienthi=1 and type='tintuc' and noibat<>0 order by stt";
	$d->query($sql_muaban);
	$nums_bc = $d->result_array();
?>
<?php if (count($nums_bc)>0) {?>
<div id="ctsdivv" style="height:auto;max-height:260px; overflow:hidden;width:100%;margin:0px auto;padding-top:10px;text-align:center;">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" id="ctstblv">
      <?php for($i=0,$count_hg=count($nums_bc);$i<$count_hg;$i++){?>
             <tr>
                <td valign="top">
                  <table width="100%" cellspacing="0" cellpadding="0" border="0">
                     <tr>
                       <td valign="top">
                       <div class="sp_left">
                       <a href="tin-tuc/<?=$nums_bc[$i]['tenkhongdau']?>.html" target="_blank">
                          <h3><?=$nums_bc[$i]['ten_'.$lang]?></h3>
                       	  <img src="<?=_upload_baiviet_l.$nums_bc[$i]['thumb']?>" alt="<?=$nums_bc[$i]['ten_'.$lang]?>" />
                          <p><?=catchuoi($nums_bc[$i]['mota_'.$lang],250)?></p>
                        </a>
                       </div>
                        </td>
                     </tr>                          
                 </table>
              </td>
           </tr>
       <?php }?>
   </table>
   <script type="text/javascript">createScroller("myScrollerv", "ctsdivv", "ctstblv",0,50,1,1,2);</script>   
 </div>
<?php }?>