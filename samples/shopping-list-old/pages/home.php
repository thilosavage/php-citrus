
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<?php inc::js(); // Load all .js files in the modules ?>
		<?php inc::css()	// Load all .css files in the modules ;?>
	</head>

<div class='box'>

	<h4>My shopping list</h4>

	<div id='shopping-list'>
		
		<?php echo render::module('list/show-list'); // ?>
		
	</div>
	
	<a href='<?php echo CR_URL;?>edit-list'>Edit List</a>
	
</div>