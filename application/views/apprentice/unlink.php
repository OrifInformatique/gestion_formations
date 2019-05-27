<div class="container">
    <h1><?php echo $this->lang->line('apprentice_formation_delete'); ?></h1>
    <?php if($deletion_allowed) { ?>
        <div class="row">
            <?php echo $this->lang->line('link_delete_confirm').'?'; ?>
        </div>
        <div class="row">
            <a href="<?php echo base_url('apprentice/apprentice_formations/'.$link->fk_apprentice); ?>" class="btn btn-primary">
                <?php echo $this->lang->line('no'); ?>
            </a>
            <a href="<?php echo base_url('apprentice/unlink_form/'.$link->id.'/1'); ?>" class="btn btn-danger">
                <?php echo $this->lang->line('yes'); ?>
            </a>
        </div>
    <?php } else { ?>
    <div class="alert alert-warning row"><?php echo $this->lang->line('apprentice_formation_delete_not') ?></div>
    <a href="<?php echo base_url('apprentice/apprentice_formations/'.$link->fk_apprentice); ?>" class="btn btn-primary">
        <?php echo $this->lang->line('return'); ?>
    </a>
    <?php } ?>
</div>