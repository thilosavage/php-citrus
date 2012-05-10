<html>
	<head>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<?php inc::js('common.js.php');?>
		<?php inc::css('common.css.php')	;?>
	</head>

<div class='box'>

	<h4>Edit your shopping list</h4>

	<div id='list'>
		<div id='items'>
			<?php echo render::module('item/items');?>
		</div>
	</div>

	<div><a class='ajax itemLoadForm' href='#'>Add item</a></div>
		
</div>

<?php echo render::shells('misc');?>