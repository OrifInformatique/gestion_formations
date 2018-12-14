<h1><?php if(!is_null($group) && isset($group)) {
    $update = TRUE;
    echo $this->lang->line('group_modify');
} else {
    $update = FALSE;
    echo $this->lang->line('group_new');
} ?>
</h1>
<form>
    <table>
        <tr>
            <td><label for="inputID">
                <?php echo $this->lang->line('group_id') ?>
            </label></td>
            <td><input type="number" name="id" id="inputID" readonly
                <?php if($update) echo 'value="'.$group->id.'"'; ?>></td>
        </tr>
        <tr>
            <td><label for="inputName">
                <?php echo $this->lang->line('group_name') ?>
            </label></td>
            <td><input type="text" name="name_group" id="inputName"
                <?php if($update) echo 'value="'.$group->name_group.'"'; ?>></td>
        </tr>
        <tr>
            <td><label for="inputWeight">
                <?php echo $this->lang->line('group_weight') ?>
            </label></td>
            <td><input type="number" name="weight" id="inputWeight"
                <?php if($update) echo 'value="'.$group->weight.'"'; ?>></td>
        </tr>
        <tr>
            <td><label for="inputEliminatory">
                <?php echo $this->lang->line('group_eliminatory') ?>
            </label></td>
            <td><input type="checkbox" name="eliminatory" id="inputEliminatory"
                <?php if($update && $group->eliminatory) echo 'checked'; ?>></td>
        </tr>
        <tr>
            <td><label for="inputPosition">
                <?php echo $this->lang->line('group_position') ?>
            </label></td>
            <td><input type="number" name="position" id="inputPosition"
                <?php if($update) echo 'value="'.$group->position.'"'; ?>></td>
        </tr>
        <tr>
            <td><label for="inputFKParentGroup">
                <?php echo $this->lang->line('group_parent_group') ?>
            </label></td>
            <td><input type="number" name="fk_parent_group" id="inputFKParentGroup"
                <?php if($update) echo 'value="'.$group->fk_parent_group.'"'; ?>></td>
        </tr>
        <tr>
            <td><input type="submit" name="<?php echo $this->lang->line('btn_submit') ?>"></td>
            <td><input type="reset" name="<?php echo $this->lang->line('btn_reset') ?>"></td>
        </tr>
    </table>
</form>