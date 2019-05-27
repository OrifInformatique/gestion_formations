<div class="container">
    <h1><?php echo $this->lang->line('group_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('group/form')?>"><?=$this->lang->line('group_new')?></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('group_position') ?></th>
                <th><?php echo $this->lang->line('group_name') ?></th>
                <th><?php echo $this->lang->line('group_weight') ?></th>
                <th><?php echo $this->lang->line('group_eliminatory') ?></th>
                <th><?php echo $this->lang->line('group_parent_group') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no_group = $this->lang->line('none');
            if(isset($groups)) {
            foreach($groups as $group) { if($group->id == 0) continue; ?>
                <tr>
                    <td><?php echo $group->position; ?></td>
                    <td><a href="<?php echo base_url().'group/form/'.$group->id; ?>"><?php echo $group->name_group; ?></a></td>
                    <td><?php echo $group->weight . ' %'; ?></td>
                    <td><?php echo $group->eliminatory?$this->lang->line('yes'):$this->lang->line('no'); ?></td>
                    <td><?php echo getParentGroup($groups, $group->fk_parent_group, $no_group); ?></td>
                    <td>
                        <a href="<?php echo base_url().'group/delete/'.$group->id; ?>" class="btn btn-danger">x</a>
                    </td>
                </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>
<?php
    /**
     * Returns the parent group
     * @param array $groups
     *      The entirety of groups
     * @param integer $id
     *      The id of the parent group
     * @return string
     *      The name of the parent group
     */
    function getParentGroup($groups, $id, $ifempty){
        if($id == 0){
            return $ifempty;
        } else {
            foreach ($groups as $group) {
                if($group->id === $id){
                    return $group->name_group;
                }
            }
        }
    }
?>