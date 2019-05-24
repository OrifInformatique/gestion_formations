<div class="container">
    <h1><?php echo $this->lang->line('apprentice_formation_history') ?></h1>
    <a class="btn btn-primary" href="<?php echo base_url('apprentice')?>"><?php echo $this->lang->line('return'); ?></a>
    <?php if (!$formation_in_progress) { ?>
        <a class="btn btn-success" href="<?php echo base_url('apprentice/link_form/'.$id); ?>">
            <?php echo $this->lang->line('formation_new'); ?>
        </a>
    <?php } else { ?>
        <a class="btn btn-outline-secondary" style="cursor: not-allowed;"><?php echo $this->lang->line('formation_new'); ?></a>
    <?php } ?>
    <div class="row">
        <div class="col-md-3"><b><?php echo $this->lang->line('formation_name'); ?></b></div>
        <div class="col-md-3"><b><?php echo $this->lang->line('formation_end'); ?></b></div>
    </div>
    <?php foreach($linked_formations as $linked_formation) {
        $form = $formations[$linked_formation->fk_formation]; ?>
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo base_url().'apprentice/edit_form/'.$linked_formation->id; ?>">
                    <?php echo $form->name_formation; ?>
                </a>
            </div>
            <div class="col-md-3">
                <?php echo $form->duration + $linked_formation->year; ?>
            </div>
            <div class="col-md-1">
                <a href="<?php echo base_url().'grade/list/'.$linked_formation->id; ?>">[🖍]</a>
                <a href="<?php echo base_url().'apprentice/unlink_form/'.$linked_formation->id; ?>">[x]</a>
            </div>
        </div>
    <?php } ?>
</div>