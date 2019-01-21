<div class="container">
    <?php
    if($deletion_allowed) {
    if(isset($module) && !is_null($module)) { ?>
    <h1><?php echo $this->lang->line('module_delete'); ?></h1>

    <?php echo $this->lang->line('module_delete_confirm')." <em>".$module->title."</em>?"; ?><br>

    <a href="<?php echo base_url().'module/delete/'.$module->id.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'module'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>

    <?php } else {
    echo $this->lang->line('group_missing');?>
    <br><a href="<?php echo base_url().'module'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } } else { ?>
    <div class="row"><a href="<?php echo base_url().'group'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a></div>
    <div class="alert alert-warning row"><?php echo $this->lang->line('module_delete_not'); ?></div>
    <?php } ?>
</div>