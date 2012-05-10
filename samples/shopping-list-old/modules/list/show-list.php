<?php

/**
 * If there's no Controller, business logic goes at the top of the module
 *
 */
$itemsObj = new Items;
$itemsObj->getAll();
foreach ($itemsObj->rows as $item) {
	$items[] = $item['item'];
}
?>


<?php
/**
 * View goes below
 *
 */
?>

<?php if (!$items) :?>

	<div>You have no items!</div>

<?php endif ?>

<?php foreach ($items as $item) { ?>

	<li><?php echo $item;?></li>

<?php } ?>