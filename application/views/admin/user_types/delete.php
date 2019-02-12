<div class="container">
    <?php if($deletion_allowed) {
    if(isset($user_type) && !is_null($user_type)) { ?>
    <h1><?php echo $this->lang->line('user_type_delete'); ?></h1>

    <?php echo $this->lang->line('user_type_delete_confirm').' <em>'.$user_type->type.'</em>?'; ?><br>

    <a href="<?php echo base_url().'admin/user_type_delete/'.$user_type->id.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'admin/user_type_index'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>
    <?php } else {
    echo $this->lang->line('user_type_missing'); ?>
    <br><a href="<?php echo base_url().'admin/user_type_index'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } } else { ?>
    <div class="row"><a href="<?php echo base_url().'admin/user_type_index'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a></div>
    <div class="alert alert-warning row"><?php echo $this->lang->line('user_type_delete_not') ?></div>
    <?php } ?>
</div>