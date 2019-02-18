<div class="container">
    <div class="row">
        <a class="btn" href="<?php echo base_url('admin/user_index'); ?>"><?php echo $this->lang->line('nav_admin_users'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/user_type_index'); ?>"><?php echo $this->lang->line('nav_admin_user_types'); ?></a>
        <a class="btn" href="<?php echo base_url('admin/teacher_index'); ?>"><?php echo $this->lang->line('nav_admin_teachers'); ?></a>
    </div>
    <h1><?php echo $this->lang->line('teacher_list'); ?></h1>
    <a class="btn btn-success" href="<?php echo base_url('admin/teacher_form'); ?>"><?php echo $this->lang->line('teacher_new'); ?></a>
    <div class="row">
        <div class="col-md-8"><strong><?php echo $this->lang->line('teacher_name'); ?></strong></div>
        <div class="col-md-3"><strong><?php echo $this->lang->line('teacher_username'); ?></strong></div>
        <div class="col-md-1"></div>
    </div>
    <?php if(isset($teachers) && isset($users)) {
        foreach($teachers as $teacher) {
            if($teacher->id == 0) continue; ?>
        <div class="row">
            <!-- Click here to modify -->
            <div class="col-md-8"><a href="<?php echo base_url().'admin/teacher_form/'.$teacher->id; ?>"><?php echo $teacher->firstname." ".$teacher->last_name; ?></a></div>
            <div class="col-md-3"><?php echo get_user_name($teacher->fk_user, $users, $this->lang->line('none')); ?></a></div>
            <!-- Click here to delete -->
            <div class="col-md-1"><a href="<?php echo base_url().'admin/teacher_delete/'.$teacher->id; ?>">[x]</a></div>
        </div>
    <?php } }
    function get_user_name($id, $users, $ifempty) {
        if($id == 0)
            return $ifempty;
        else {
            foreach($users as $user) {
                if($user->id == $id) {
                    return $user->user;
                }
            }
        }
    }
    ?>
</div>