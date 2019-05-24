<div class="container">
    <?php
    if($deletion_allowed) {
    if(isset($apprentice) && !is_null($apprentice)) { ?>
    <h1><?php echo $this->lang->line('apprentice_delete'); ?></h1>

    <?php echo $this->lang->line('apprentice_delete_confirm')." <em>".$apprentice->firstname." ".$apprentice->last_name."</em>?"; ?><br>

    <a href="<?php echo base_url().'apprentice/delete/'.$apprentice->id.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'apprentice'; ?>" class="btn btn-secondary"><?php echo $this->lang->line('no'); ?></a>

    <?php } else {
    echo $this->lang->line('apprentice_missing'); ?>
    <br><a href="<?php echo base_url().'apprentice'; ?>" class="btn btn-primary"><?php echo $this->lang->line('return'); ?></a>
    <?php } } else { ?>
    <br><a href="<?php echo base_url().'apprentice'; ?>" class="btn btn-primary"><?php echo $this->lang->line('return'); ?></a>
    <div class="alert alert-warning row"><?php echo $this->lang->line('apprentice_delete_not') ?></div>
    <?php } ?>
</div>