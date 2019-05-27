<div class="container">
    <div class="row">
        <a class="btn" href="<?php echo base_url('admin/user_index'); ?>"><?php echo $this->lang->line('nav_admin_users'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/user_type_index'); ?>"><?php echo $this->lang->line('nav_admin_user_types'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/teacher_index'); ?>"><?php echo $this->lang->line('nav_admin_teachers'); ?></a>
    </div>
    <h1><?php echo $this->lang->line('user_list'); ?></h1>
    <a class="btn btn-success" href="<?=base_url('admin/user_form')?>"><?php echo $this->lang->line('user_new'); ?></a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('user_username'); ?></th>
                <th><?php echo $this->lang->line('user_type'); ?></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($users) && isset($user_types)) {
            foreach($users as $user) {
                if($user->id == 0) continue; ?>
                <tr>
                    <td><a href="<?php echo base_url().'admin/user_form/'.$user->id; ?>"><?php echo $user->user; ?></a></td>
                    <td><?php echo get_user_type($user->fk_user_type, $user_types, $this->lang->line('none')); ?></td>
                    <td><a href="<?php echo base_url().'admin/user_change_password/'.$user->id; ?>"
                        title="<?php echo $this->lang->line('user_change_password'); ?>">[🖍]</a></td>
                    <td><a href="<?php echo base_url().'admin/user_delete/'.$user->id; ?>" class="btn btn-danger">x</a></td>
                </tr>
            <?php } } ?>
        </tbody>
    </table>
    <?php if(isset($users) && isset($user_types)) {
        foreach($users as $user) {
            if($user->id == 0) continue; ?>
        <div class="row">
            <!-- Click here to modify -->
            <div class="col-md-8"></div>
            <div class="col-md-2"></div>
            <div class="col-md-1"></div>
            <!-- Click here to delete -->
            <div class="col-md-1"></div>
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