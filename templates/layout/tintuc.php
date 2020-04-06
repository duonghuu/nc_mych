<div id="info">
	<div class="khung">
		<div class="tintuc_left">
			<div class="title_tt"><h3>Fanpage Facebook</h3></div><div class="clear"></div>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-page" data-href="<?=$row_setting['facebook']?>" data-tabs="timeline" data-width="100%" data-height="250" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?=$row_setting['facebook']?>"><a href="<?=$row_setting['facebook']?>">Facebook</a></blockquote></div></div>
		</div>
		<div class="tintuc_right">
			<div class="title_tt"><h3>Tin tức nổi bật</h3></div><div class="clear"></div>
			<div style="over-flow:hidden;">
				<?php include _template."layout/run_image.php"; ?>
			</div>
		</div>
	</div>
</div>