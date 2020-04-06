<?php
	
	$d->reset();
	$sql = "select photo,ten,id,mota from #_product where hienthi=1 order by stt,id desc limit 10";
	$d->query($sql);
	$xemnhieu = $d->result_array();
	
	$d->reset();
	$sql = "select dienthoai from #_hotline";
	$d->query($sql);
	$hotline = $d->fetch_array();
	

	$d->reset();
	$sql = "select * from #_yahoo where hienthi=1 order by stt";
	$d->query($sql);
	$row_yahoo = $d->result_array();
	
	$d->reset();
	$sql_lkweb = "select ten,url,id from #_lkweb order by id desc";
	$d->query($sql_lkweb);
	$row_lienket = $d->result_array();
?>

<div id="right">
  			
            
            <div class="danhmuc">
                         <div class="thanh"><img src="images/icon_hotro.png" alt="support" /><h4>Hổ trợ Trực Tuyến</h4></div>
                         <div class="left">
                         		<div class="hotline">Hotline : <?=$hotline['dienthoai']?></div>
                                <?php for($i=0,$count_ya=count($row_yahoo);$i<$count_ya;$i++){?>
                                <div class="yahoo">
                                    <p><span><?=$row_yahoo[$i]['ten']?></span> 
                                    <a href="Skype:<?=$row_yahoo[$i]['skyper']?>?chat"><img src="images/skyper.png" title="skyper" alt=""></a>
                                    <a href="ymsgr:sendIM?<?=$row_yahoo[$i]['yahoo']?>"><img title="" src="images/yahoo.png" alt="yahoo" border="0"></a>
                                    </p>
                                 </div>
                                <?php }?>
                        </div>
            </div>
                                      
                       <div class="danhmuc">
                         <div class="thanh"><img src="images/icon_thongke.png" alt="support" /><h4>Thống kê truy cập</h4></div>
                         <div class="thongke">
                         		<ul>
                                     <li><span>Lượt truy cập :</span>  <?php $count=count_online();echo $tong_xem=$count['dangxem'];?></li>
                                     <li><span>Hôm nay : </span> <?=$today_visitors?></li>
                                     <li><span>Tổng truy cập : </span><?php $count = count_online(); echo $count['daxem']?> </li>
                                     <li><span>Liên kết web : </span>
                                     <select  name="lienkett" onChange="window.open(this.value,'_blank')">
                                        <option value=""> - Liên Kết Website </option>
                                        		<?php foreach($row_lienket as $lienket){?>
                                               			 <option value="<?=$lienket['url']?>"><?=$lienket['ten']?></option>
                                                <?php }?>
                                     </select>
                                     </li>
                                </ul>
                        </div>
            </div>
               
                        
</div>