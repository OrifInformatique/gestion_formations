<div class="container">
    <div class="row">
        <a class="btn" href="<?php echo base_url('admin/user_index'); ?>"><?php echo $this->lang->line('nav_admin_users'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/user_type_index'); ?>"><?php echo $this->lang->line('nav_admin_user_types'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/teacher_index'); ?>"><?php echo $this->lang->line('nav_admin_teachers'); ?></a>
    </div>
    <h1><?php echo $this->lang->line('teacher_list'); ?></h1>
    <a class="btn btn-success" href="<?php echo base_url('admin/teacher_form'); ?>"><?php echo $this->lang->line('teacher_new'); ?></a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('teacher_name'); ?></th>
                <th><?php echo $this->lang->line('teacher_username'); ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($teachers) && isset($users)) {
            foreach($teachers as $teacher) {
                if($teacher->id == 0) continue; ?>
                <tr>
                    <td><a href="<?php echo base_url().'admin/teacher_form/'.$teacher->id; ?>"><?php echo $teacher->firstname." ".$teacher->last_name; ?></a></td>
                    <td><?php echo get_user_name($teacher->fk_user, $users, $this->lang->line('none')); ?></td>
                    <td><a href="<?php echo base_url().'admin/teacher_delete/'.$teacher->id; ?>" class="btn btn-danger">x</a></td>
                </tr>
            <?php } } ?>
        </tbody>
    </table>
    <?php
    /**
     * Returns the username
     * @param integer $id
     *      The id of the user
     * @param array $users
     *      The array of users
     * @param string $ifempty
     *      The text returned if the $id is 0
     */
    function get_user_name($id, $users, $ifempty = '') {
        if($id == 0)
            return $ifempty;
        else {
            foreach($users as $user) {
                if($user->id == $id) {
                    return $user->user;
                }
            }
        }
        return $ifempty;
    }
    ?>
</div>