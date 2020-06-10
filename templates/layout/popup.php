<?php 
    $d->reset();
    $sql_banner_top= "select photo_vi,link from #_photo where type='popup' and hienthi!=0";
    $d->query($sql_banner_top);
    $popup = $d->fetch_array();
    
?>
<?php /* 
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script> 
*/?>
<script type="text/javascript">
	$().ready(function(){
    if($('body').width() > 992){
      $('#popup').modal('show');
    }   
})
</script>
<?php if($_SESSION['popup']!='true'){?>
<?php if(!empty($popup)) {?>
	<div id="popup" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-body">
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
					<a href="<?=$popup['link']?>" >
						<img src="<?=_upload_hinhanh_l.$popup['photo_vi']?>" alt="<?=$popup['photo_vi_'.$lang]?>" class="img-responsive" />
					</a>
				</div>      
			</div>
	    </div>
	</div>
	<style type="text/css">.modal.in .modal-dialog{z-index: 99999999999!important;top: 70px;}</style>

<?php $_SESSION['popup']='true';} }?>