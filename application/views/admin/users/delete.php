<div class="container">
    <?php if($deletion_allowed) {
    if(isset($user) && !is_null($user)) { ?>
    <h1><?php echo $this->lang->line('user_delete'); ?></h1>

    <?php echo $this->lang->line('user_delete_confirm').' <em>'.$user->user.'</em>?'; ?><br>

    <a href="<?php echo base_url().'admin/user_delete/'.$user->id.'/1'; ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a href="<?php echo base_url().'admin/user_index'; ?>" class="btn"><?php echo $this->lang->line('no'); ?></a>
    <?php } else {
    echo $this->lang->line('user_missing'); ?>
    <br><a href="<?php echo base_url().'admin/user_index'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } } else { ?>
    <div class="row"><a href="<?php echo base_url().'admin/user_index'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a></div>
    <div class="alert alert-warning row"><?php echo $this->lang->line('user_delete_not') ?></div>
    <?php } ?>
</div>