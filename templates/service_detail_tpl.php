<div id="info" class="">
<div id="sanpham">
    <div class="khung">
    <div class="thanhsp"><h2><?=$tintuc_detail[0]['ten_'.$lang]?></h2></div>
    <div class="noidung">
         <?=$tintuc_detail[0]['noidung_'.$lang]?>
    </div>
        
<div style="clear:left;"></div><br /><br />
<span style=" padding-left:10px; text-transform:uppercase; font-weight:bold;"><?=_othernews?></span>

                    <?php foreach($tintuc_khac as $tinkhac){?>
                    <div style="padding-left:10px; height:auto;"><a href="dich-vu/<?=$tinkhac['tenkhongdau']?>.html" style="text-decoration:none;"><img src="images/sao.png" border="0" />&nbsp;&nbsp;<span style="font-size:14px; color:#666;"><?=$tinkhac['ten_'.$lang]?></span></a><span style="color:#0099FF;"> (<?=make_date($tinkhac['ngaytao'])?>)</span></div>
                    
                    <?php }?>
                      </div>      
        
        </div>
            <div class="bong_btda"></div>     
</div>
     