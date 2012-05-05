<?php
/////////////////////////////////////////////////////////////////
//////   	  This is just an ad-hoc scaffolding        	//////
//////  	   Do not make your pages like this or			//////
//////  	   They will get extremely confusing			//////
//////														//////
//////		  Use proper _forms/ and _buttons/				//////
//////////////////////////////////////////////////////////////////
$i = 1;
echo form::start(site::url."scaffolding/save/".$id."?table=".$table);

if ($fields){
	foreach ($fields as $name => $field) {
		if (!$id){
			//unset($field);
			$field = '';
		}
		if ($i == 1) {
			if ($id){
				echo $name.": ".$field."<br>";
			}
		}
		else {
			echo $name.": ".form::input('data['.$name.']',$field)."<br>";	
		}
		$i = 0;
	}
	
	echo form::submit('submit','submit');
	echo "</form>";

	
}
else {
	echo "There was an error.. are you sure this table exists in the database?";
}

echo "<p><a href='".site::url."scaffolding/table/".$table."'>Return to ".$table." table</a></p>";
echo "<p><a href='".site::url."scaffolding'>Return to Tables List</a></p>";	
?>