<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<?php inc::js('common.js.php');?>
		<?php inc::css('common.css.php')	;?>
	</head>

<div class='box'>

	<h4>Home page</h4>

	<div class='box'>

		<div>Splash page / intro page / whatever</div>

		<a href='<?php echo site::url;?>shopping-list'>Go to shopping list</a>	
	
	</div>
	
</div>

<?php echo render::view('common/nav'); ?>