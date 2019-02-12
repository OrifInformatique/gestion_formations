<div class="container">
    <div class="row">
        <a class="btn" href="<?php echo base_url('admin/user_index'); ?>"><?php echo $this->lang->line('nav_admin_users'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/user_type_index'); ?>"><?php echo $this->lang->line('nav_admin_user_types'); ?></a>
    </div>
    <h1><?php echo $this->lang->line('user_type_list'); ?></h1>
    <a class="btn btn-success" href="<?=base_url('admin/user_type_form')?>"><?php echo $this->lang->line('user_type_new'); ?></a>
    <div class="row">
        <div class="col-md-8"><strong><?php echo $this->lang->line('user_type_type'); ?></strong></div>
        <div class="col-md-3"><strong><?php echo $this->lang->line('user_type_access'); ?></strong></div>
        <div class="col-md-1"></div>
    </div>
    <?php if(isset($user_types)) {
        foreach($user_types as $user_type) {
            if($user_type->id == 0) continue; ?>
        <div class="row">
            <!-- Click here to modify -->
            <div class="col-md-8"><a href="<?php echo base_url().'admin/user_type_form/'.$user_type->id; ?>"><?php echo $user_type->type; ?></a></div>
            <div class="col-md-3"><?php echo get_access_level_name($user_type->access_level, $access_levels); ?></div>
            <!-- Click here to delete -->
            <div class="col-md-1"><a href="<?php echo base_url().'admin/user_type_delete/'.$user_type->id; ?>">[x]</a></div>
        </div>
    <?php } } ?>
</div>
<?php
function get_access_level_name($level, $access_levels) {
    return $access_levels[$level];
}
?>