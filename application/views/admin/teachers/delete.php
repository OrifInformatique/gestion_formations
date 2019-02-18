<div class="container">
    <?php if($deletion_allowed) {
    if(isset($teacher) && !is_null($teacher)) { ?>
    <h1><?php echo $this->lang->line('teacher_delete'); ?></h1>

    <?php echo $this->lang->line('teacher_delete_confirm').' <em>'.$teacher->firstname." ".$teacher->last_name.'</em>?'; ?><br>

    <a href="<?php echo base_url().'admin/teacher_delete/'.$teacher->id.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'admin/teacher_index'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>
    <?php } else {
    echo $this->lang->line('teacher_missing'); ?>
    <br><a href="<?php echo base_url().'admin/teacher_index'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } } else { ?>
    <div class="row"><a href="<?php echo base_url().'admin/teacher_index'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a></div>
    <div class="alert alert-warning row"><?php echo $this->lang->line('teacher_delete_not') ?></div>
    <?php } ?>
</div>