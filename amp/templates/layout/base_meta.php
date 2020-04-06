<meta charset="utf-8">
<title itemprop='name'><?php if($title_bar!='') echo $title_bar; else echo $row_setting['title']; ?></title>
<meta name="description" content="<?=($description_bar!='')? seo_entities($description_bar):$row_setting['description']?>" />
<meta name="keywords" content="<?=($keyword_bar!='')? seo_entities($keyword_bar):$row_setting['keywords']?>" />
<meta name="robots" content="index, follow" />
<meta name="author" content="<?=$row_setting['ten_'.$lang]?> [<?=$row_setting['email']?>]" />
<meta http-equiv="content-language" content="vi" />
<link rel="canonical" href="<?=getCurrentPageURL()?>" />
<link href="images/logo.png" rel="shortcut icon" type="image/x-icon" />
<?=$share_facebook?>
<!-- <meta property="fb:app_id" content="917571318303635" />-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />