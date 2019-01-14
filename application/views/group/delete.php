<div class="container">
    <?php if($deletion_allowed) {
    if(isset($group) && !is_null($group)) { ?>
    <h1><?php echo $this->lang->line('group_delete'); ?></h1>

    <?php echo $this->lang->line('group_delete_confirm')." <em>".$group->name_group."</em>?"; ?><br>

    <a href="<?php echo base_url().'group/delete/'.$group->id.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'group'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>

    <?php } else {
    echo $this->lang->line('group_missing');?>
    <br><a href="<?php echo base_url().'group'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } } else { ?>
    <div class="row"><a href="<?php echo base_url().'group'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a></div>
    <div class="alert alert-warning row"><?php echo $this->lang->line('group_delete_not') ?></div>
    <?php } ?>
</div>