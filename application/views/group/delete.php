<?php if(isset($group) && !is_null($group)) { ?>
<h1><?php echo $this->lang->line('group_delete'); ?></h1>

<?php echo $this->lang->line('group_delete_confirm')." ".$group->name_group."?"; ?>

<button><?php echo $this->lang->line('btn_yes'); ?></button>
<button><?php echo $this->lang->line('btn_no'); ?></button>

<?php } else {
echo $this->lang->line('group_missing'); } ?>