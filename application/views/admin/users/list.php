<div class="container">
    <h1><?php echo $this->lang->line('user_list'); ?></h1>
    <div class="row">
        <div class="col-md-8"><?php echo $this->lang->line('user_username'); ?></div>
        <div class="col-md-3"><?php echo $this->lang->line('user_type'); ?></div>
        <div class="col-md-1"></div>
    </div>
    <?php if(isset($users) && isset($user_types)) {
        foreach($users as $user) {
            if($user->id == 0) continue; ?>
        <div class="row">
            <!-- Click here to modify -->
            <div class="col-md-8"><a href="<?php echo base_url().'admin/users/form/'.$user->id; ?>"><?php echo $user->user; ?></a></div>
            <div class="col-md-3"><?php echo get_user_type($user->fk_user_type, $user_types); ?></div>
            <!-- Click here to delete -->
            <div class="col-md-1"><a href="<?php echo base_url().'admin/users/delete/'.$user->id; ?>">[x]</a></div>
        </div>
    <?php } } ?>
</div>
<?php
    function get_user_type($id = 0, $user_types) {
        if($id == 0)
            return $this->lang->line('none');
        else {
            foreach($user_types as $user_type) {
                if($user_type->id == 0 && $id == $user_type->id){
                    return $this->lang->line('none');
                } elseif ($user_type->id == $id) {
                    return $user_type->type;
                }
            }
        }
    }
?>