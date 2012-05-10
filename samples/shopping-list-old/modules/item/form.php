
<div style='width: 500px;'>

	<div class='lightbox-close-x lightboxClose hand'>X (esc)</div>
	
	<div class='lightbox-title'>
	<?php if ($data['item_id']): $addButton = "Change";?>
	Editing item <?php echo $data['item'];?>
	<?php else: $addButton = "Add" ?>
	Add new item
	<?php endif; ?>
	</div>
	
	<div id='itemError' style='margin-left: 20px; color: red;'></div>
	
	<div style='padding: 20px;' id='itemForm'>
		Item: <?php echo form::input('itemname', $data['item'], 'item-el', 'field="item"');?>
		<span class='fakelink itemEditSubmit'><?php echo $addButton;?></span>
		
		<span class='fakelink lightboxClose'>Cancel</span>
		
		<?php echo form::hidden('item_id', $data['item_id'], 'item-el','field="item_id"');?>
		
	</div>
	
</div>