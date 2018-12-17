<div class="container">
    <h1><?php echo $this->lang->line('group_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('group/add')?>"><?=$this->lang->line('group_new')?></a>
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
            <td><?php echo $group->ID; ?></td>
            <td><a href="<?php echo base_url().'view/'.$group->ID; ?>"><?php echo $group->Name_Group; ?></a></td>
            <td><?php echo $group->Weight; ?></td>
            <td><?php echo $group->Eliminatory; ?></td>
            <td><?php echo $group->Position; ?></td>
            <td><?php echo $group->FK_Parent_Group; ?></td>
            <!-- Click here to delete -->
            <td><a href="#">[x]</a></td>
        </tr>
        <?php } } ?>
    </table>
</div>