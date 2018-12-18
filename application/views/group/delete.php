<div class="container">
<?php if(isset($group) && !is_null($group)) { ?>
<h1><?php echo $this->lang->line('group_delete'); ?></h1>

<?php echo $this->lang->line('group_delete_confirm')." ".$group->Name_Group."?"; ?><br>

<a href="<?php echo base_url().'group/delete/'.$group->ID.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
<a href="<?php echo base_url().'group'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>

<?php } else {
echo $this->lang->line('group_missing'); } ?>
</div>