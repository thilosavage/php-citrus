<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<?php inc::js('common.js.php');?>
		<?php inc::css('common.css.php')	;?>
	</head>

<div class='box'>

	<h4>asdf</h4>

	<div id='list'>
		<div id='items'>
			<?php echo render::view('item/items');?>
		</div>
	</div>

	<div><a class='ajax itemLoadForm' href='seo'>Add item</a></div>
		
</div>

<?php echo render::view('common/nav'); ?>

<div id='lightboxContainer' style='display: none;'>
	<div style='background-color: white; border: 2px solid black;'></div>
</div>