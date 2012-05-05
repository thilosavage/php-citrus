<?php
/////////////////////////////////////////////////////////////////
//////   	  This is just an ad-hoc scaffolding        	//////
//////  	   Do not make your pages like this or			//////
//////  	   They will get extremely confusing			//////
//////														//////
//////		  Use proper _forms/ and _buttons/				//////
//////////////////////////////////////////////////////////////////

if (isset($code)) {
	"Success.";
}
echo "<h3>Editing ".$tableName." table</h3>";
echo "<h4><a href='".site::url."scaffolding/edit/?table=".$tableName."'>New Row</a></h4>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";

// column headers
echo "<tr><td></td><td></td>";
$i = 1;
foreach ($fields as $field => $dataType) {
	if ($i) {
		$idField = $field;
	}
	echo "<td><strong>".$field;
	$i = 0;
}
echo "</tr>";
if ($rows) {
	foreach ($rows as $row) {
		echo "<tr>";
		echo "<td><a href='".site::url."scaffolding/edit/".$row[$idField]."?table=".$tableName."'>Edit</td>";
		echo "<td><a href='".site::url."scaffolding/delete/".$row[$idField]."?table=".$tableName."'>Delete</td>";
		foreach ($fields as $field => $dataType) {
			echo "<td>".$row[$field]."</strong></td>";
		}
		echo "</tr>";
	}
}
else {
	echo "<tr><td>No rows found</td></tr>";
}

echo "</table>";
echo "<a href='".site::url."scaffolding'>Return to Tables List</a>";
?>