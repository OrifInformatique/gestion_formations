<?php
$admin_selected = $admin_selected ?? 0;
?>
<div class="container">
    <div class="row">
        <a class="btn <?php echo $admin_selected == 1 ? 'btn-primary' : 'btn-secondary';?>"
            href="<?php echo base_url('admin/user_index'); ?>" style="margin-right: 5px;">
            <?php echo $this->lang->line('nav_admin_users'); ?>
        </a>
        <a class="btn <?php echo $admin_selected == 2 ? 'btn-primary' : 'btn-secondary';?>"
            href="<?php echo base_url('admin/user_type_index'); ?>" style="margin-right: 5px;">
            <?php echo $this->lang->line('nav_admin_user_types'); ?>
        </a>
        <a class="btn <?php echo $admin_selected == 3 ? 'btn-primary' : 'btn-secondary';?>"
            href="<?php echo base_url('admin/teacher_index'); ?>" style="margin-right: 5px;">
            <?php echo $this->lang->line('nav_admin_teachers'); ?>
        </a>
    </div>
</div>