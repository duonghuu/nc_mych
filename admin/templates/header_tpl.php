<?php
      $d->reset();
      $sql = "SELECT COUNT(*) as num FROM #_contact where view=0 ";
      $d->query($sql);
      $row_lienhe = $d->fetch_array();

      $d->reset();
      $sql = "SELECT COUNT(*) as num FROM #_order where view=0 ";
      $d->query($sql);
      $row_giohang = $d->fetch_array();

      $tong_count = $row_lienhe['num'] + $row_giohang['num'];
?>
<div class="wrapper">
        <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login']['username']?>!</span></div>
        <div class="userNav">
            <ul>
			  <?php if($_SESSION['login_admin']['type']!='daily') { ?>
               
               

				 <li><a href="index.php?com=order&act=man" title="">
				 
				 <span>Đơn hàng</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_giohang['num']?></span>
				 
				 </a></li>

        <li><a href="index.php?com=member&act=man" title=""><span>Quản trị thành viên</span></a></li>

        <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
				 
				 <!-- 
				  <li><a href="index.php?com=contact&act=man" title="">
				         <span>Liên hệ</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_lienhe['num']?></span>
         
         </a></li> -->


                <li class="ddnew"><a title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Thông báo</span><span class="numberTop"><?=$tong_count?></span></a>
                    <ul class="userMessage">
                        <li><a href="index.php?com=contact&act=man" title="" class="sInbox"><span>Liên hệ</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_lienhe['num']?></span></a></li>

                        <!-- <li><a href="index.php?com=order&act=man" title="" class="sInbox"><span>Đơn hàng</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_giohang['num']?></span></a></li> -->

                    </ul>
                </li>
				
				
                <li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
				
			  <?php } else {?>
			  
			   <li><a href="index.php?com=user&act=logout_daily" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
			  
			  <?php }?>
				
                <!-- <li><a href="../sitemap.php" title="" target="_blank"><span>Cập nhật sitemap</span></a></li> -->
            </ul>
        </div>
        <div class="clear"></div>
    </div>
<?php echo $_SESSION['login']['role']; ?>