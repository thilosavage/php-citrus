<?php
/////////////////////////////////////////////////////////////////
//////   	  This is just an ad-hoc scaffolding        	//////
//////  	   Do not make your pages like this or			//////
//////  	   They will get extremely confusing			//////
//////														//////
//////		  Use proper _forms/ and _buttons/				//////
//////////////////////////////////////////////////////////////////

if ($models){
	echo "<h4>Select table to edit</h4>";
	foreach ($models as $name => $file) {
		echo "<a href='".site::url."scaffolding/table/".$name."'>".$name."</a><br>";
	}
}
else {
	echo "<h4>You have no tables in the database.</h4>";
}
?>

<a href='<?php echo site::url;?>admin'>Admin Home</a>

