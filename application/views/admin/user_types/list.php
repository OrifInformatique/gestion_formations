<div class="container">
    <h1><?php echo $this->lang->line('user_type_list'); ?></h1>
    <a class="btn btn-success" href="<?=base_url('admin/user_type_form')?>"><?php echo $this->lang->line('user_type_new'); ?></a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('user_type_type'); ?></th>
                <th><?php echo $this->lang->line('user_type_access'); ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($user_types)) {
            foreach($user_types as $user_type) {
                if($user_type->id == 0) continue; ?>
                <tr>
                    <td><a href="<?php echo base_url().'admin/user_type_form/'.$user_type->id; ?>"><?php echo $user_type->type; ?></a></td>
                    <td><?php echo get_access_level_name($user_type->access_level, $access_levels); ?></td>
                    <td><a href="<?php echo base_url().'admin/user_type_delete/'.$user_type->id; ?>" class="btn btn-danger">x</a></td>
                </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>
<?php
/**
 * Returns the name of the access level
 * @param integer $level
 *      The access level in question
 * @param array $access_levels
 *      The array of all access levels
 */
function get_access_level_name($level, $access_levels) {
    return $access_levels[$level];
}
?>