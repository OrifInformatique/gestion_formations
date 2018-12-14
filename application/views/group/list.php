<h1><?php echo $this->lang->line('group_list') ?></h1>
<table>
    <tr>
        <th><?php echo $this->lang->line('group_id') ?></th>
        <th><?php echo $this->lang->line('group_name') ?></th>
        <th><?php echo $this->lang->line('group_weight') ?></th>
        <th><?php echo $this->lang->line('group_eliminatory') ?></th>
        <th><?php echo $this->lang->line('group_position') ?></th>
        <th><?php echo $this->lang->line('group_parent_group') ?></th>
    </tr>
    <?php foreach ($groups as $group) { ?>
    <tr>
        <td><?php echo $group->id; ?></td>
        <td><?php echo $group->name_group; ?></td>
        <td><?php echo $group->weight; ?></td>
        <td><?php echo $group->eliminatory; ?></td>
        <td><?php echo $group->position; ?></td>
        <td><?php echo $group->fk_parent_group; ?></td>
    </tr>
    <?php } ?>
</table>