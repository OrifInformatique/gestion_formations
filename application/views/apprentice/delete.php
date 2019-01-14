<div class="container">
    <?php if(isset($apprentice) && !is_null($apprentice)) { ?>
    <h1><?php echo $this->lang->line('apprentice_delete'); ?></h1>

    <?php echo $this->lang->line('apprentice_delete_confirm')." <em>".$apprentice->firstname." ".$apprentice->last_name."</em>?"; ?><br>

    <a href="<?php echo base_url().'apprentice/delete/'.$apprentice->id.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'apprentice'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>

    <?php } else {
    echo $this->lang->line('group_missing');?>
    <br><a href="<?php echo base_url().'apprentice'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } ?>
</div>