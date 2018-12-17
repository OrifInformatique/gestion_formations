<h1><?php echo $this->lang->line('group_list') ?></h1>
<table>
    <tr>
        <th><?php echo $this->lang->line('group_id') ?></th>
        <th><?php echo $this->lang->line('group_name') ?></th>
        <th><?php echo $this->lang->line('group_weight') ?></th>
        <th><?php echo $this->lang->line('group_eliminatory') ?></th>
        <th><?php echo $this->lang->line('group_position') ?></th>
        <th><?php echo $this->lang->line('group_parent_group') ?></th>
        <th></th>
    </tr>
    <?php if(isset($groups)) {
        foreach ($groups as $group) { ?>
    <tr>
        <!-- Click here to modify -->
        <td><a href="#"><?php echo $group->id; ?></a></td>
        <td><?php echo $group->name_group; ?></td>
        <td><?php echo $group->weight; ?></td>
        <td><?php echo $group->eliminatory; ?></td>
        <td><?php echo $group->position; ?></td>
        <td><?php echo $group->fk_parent_group; ?></td>
        <!-- Click here to delete -->
        <td><a href="#">[x]</a></td>
    </tr>
    <?php } } ?>
</table>