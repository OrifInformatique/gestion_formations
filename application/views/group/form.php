<h1><?php $this->load->helper('form');
if(!is_null($group) && isset($group)) {
    $update = TRUE;
    echo $this->lang->line('group_modify');
} else {
    $update = FALSE;
    echo $this->lang->line('group_new');
} ?>
</h1>
<?php form_open(); ?>
    <table>
        <tr>
            <?php $data = new Array(
                'name'  => 'id',
                'id'    => 'inputID'
            );
            if($update) $data['value'] = $group->id;
            echo form_label($this->lang->line('group_id'), $data['id']);
            echo form_input($data); ?>
        </tr>
        <tr>
            <?php $data = new Array(
                'name'  => 'name_group',
                'id'    => 'inputName'
            );
            if($update) $data['value'] = $group->name_group;
            echo form_label($this->lang->line('group_name'), $data['id']);
            echo form_input($data); ?>
        </tr>
        <tr>
            <?php $data = new Array(
                'name'  => 'weight',
                'id'    => 'inputWeight'
            );
            if($update) $data['value'] = $group->weight;
            echo form_label($this->lang->line('group_weight'), $data['id']);
            echo form_input($data); ?>
        </tr>
        <tr>
            <?php $data = new Array(
                'name'  => 'eliminatory',
                'id'    => 'inputEliminatory'
            );
            if($update) $data['value'] = $group->eliminatory;
            if($update && $group->eliminatory) $data['checked'] = TRUE;
            echo form_label($this->lang->line('group_eliminatory'), $data['id']);
            echo form_checkbox($data); ?>
        </tr>
        <tr>
            <?php $data = new Array(
                'name'  => 'position',
                'id'    => 'inputPosition'
            );
            if($update) $data['value'] = $group->position;
            echo form_label($this->lang->line('group_position'), $data['id']);
            echo form_input($data); ?>
        </tr>
        <tr>
            <?php $data = new Array(
                'name'  => 'fk_parent_group',
                'id'    => 'inputFKParentGroup'
            );
            if($update) $data['value'] = $group->fk_parent_group;
            echo form_label($this->lang->line('group_parent_group'), $data['id']);
            echo form_input($data); ?>
        </tr>
        <tr>
            <td><?php echo form_submit('submit', $this->lang->line('btn_submit')); ?></td>
            <td><?php echo form_reset('reset', $this->lang->line('btn_reset')); ?></td>
        </tr>
    </table>
</form>