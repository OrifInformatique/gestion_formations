<div class="container">
    <?php
    if(isset($formation) && !is_null($formation)) { ?>
    <h1><?php echo $this->lang->line('formation_delete'); ?></h1>

    <?php echo $this->lang->line('formation_delete_confirm')." <em>".$formation->name_formation."</em>?"; ?><br>

    <a href="<?php echo base_url().'formation/delete/'.$formation->ID.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'formation'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>

    <?php } else {
    echo $this->lang->line('formation_missing');?>
    <br><a href="<?php echo base_url().'formation'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } ?>
</div>