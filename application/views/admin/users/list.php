<div class="container">
    <div class="row">
        <a class="btn" href="<?php echo base_url('admin/user_index'); ?>"><?php echo $this->lang->line('nav_admin_users'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/user_type_index'); ?>"><?php echo $this->lang->line('nav_admin_user_types'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/teacher_index'); ?>"><?php echo $this->lang->line('nav_admin_teachers'); ?></a>
    </div>
    <h1><?php echo $this->lang->line('user_list'); ?></h1>
    <a class="btn btn-success" href="<?=base_url('admin/user_form')?>"><?php echo $this->lang->line('user_new'); ?></a>
    <div class="row">
        <div class="col-md-8"><strong><?php echo $this->lang->line('user_username'); ?></strong></div>
        <div class="col-md-3"><strong><?php echo $this->lang->line('user_type'); ?></strong></div>
        <div class="col-md-1"></div>
    </div>
    <?php if(isset($users) && isset($user_types)) {
        foreach($users as $user) {
            if($user->id == 0) continue; ?>
        <div class="row">
            <!-- Click here to modify -->
            <div class="col-md-8"><a href="<?php echo base_url().'admin/user_form/'.$user->id; ?>"><?php echo $user->user; ?></a></div>
            <div class="col-md-3"><?php echo get_user_type($user->fk_user_type, $user_types, $this->lang->line('none')); ?></div>
            <!-- Click here to delete -->
            <div class="col-md-1"><a href="<?php echo base_url().'admin/user_delete/'.$user->id; ?>">[x]</a></div>
        </div>
    <?php } }
    /**
     * Returns the usertype
     * @param integer $id
     *      ID of the user type
     * @param array $user_types
     *      The array containing all user types
     * @param string $ifempty
     *      The string to return if the id is 0
     */
    function get_user_type($id, $user_types, $ifempty) {
        if($id == 0)
            return $ifempty;
        else {
            foreach($user_types as $user_type) {
                if ($user_type->id == $id) {
                    return $user_type->type;
                }
            }
        }
        return $ifempty;
    }
?>
</div>