<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of group's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

<div class="container">
    <h1 class="title-section"><?php if(isset($group)) {echo $this->lang->line('group_modify'); $update = true;} else {echo $this->lang->line('group_new'); $update = false;} ?></h1>
    <?php
    $attributes = array("id" => "addGroupForm",
                        "name" => "addGroupForm");
    echo form_open('Group/form_validation', $attributes);
    ?>
        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/group')?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"'); 
                    //echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-danger"');
                ?>
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
        if (!empty(validation_errors())) {
            echo '<div class="alert alert-danger">'.validation_errors().'</div>';}
        ?>

        <!-- GROUP FIELDS -->
        <?php

        if($update){
            echo form_hidden('id', $group->id);
        }

        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_name'), 'name_group'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('name_group', set_value('name_group', $group->name_group), 'maxlength="65535" class="form-control" id="name_group"');
                        else
                            echo form_input('name_group', set_value('name_group'), 'maxlength="65535" class="form-control" id="name_group"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_weight'), 'weight'); ?>
                    </div>
                    <div class="col-md-7">
                        <?php
                        if($update)
                            echo form_input('weight', set_value('weight', $group->weight), 'class="form-control" id="weight"');
                        else
                            echo form_input('weight', set_value('weight'), 'class="form-control" id="weight"');
                        ?>
                    </div>
                    <div class="col-md-1">
                        %
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_eliminatory'), 'eliminatory'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_checkbox('eliminatory', 'eliminatory', $group->eliminatory, 'class="form-control" id="eliminatory"');
                        else
                            echo form_checkbox('eliminatory', 'eliminatory', set_value('eliminatory'), 'class="form-control" id="eliminatory"');
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_position'), 'position'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('position', set_value('position', $group->position), 'class="form-control" id="position"');
                        else
                            echo form_input('position', set_value('position'), 'class="form-control" id="position"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_parent_group'), 'parent_group'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_dropdown('parent_group', $groups, set_value('parent_group', $group->fk_parent_group), 'class="form-control" id="parent_group"');
                        else
                            echo form_dropdown('parent_group', $groups, set_value('parent_group'), 'class="form-control" id="parent_group"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_formation')); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_dropdown('group_formation', $formations, set_value('group_formation', $group->fk_formation), 'class="form-control" id="group_formation"');
                        else
                            echo form_dropdown('group_formation', $formations, set_value('group_formation'), 'class="form-control" id="group_formation"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php echo form_dropdown('m[]', $modules, $m, 'multiple="multiple" id="group_modules-multiselect"'); ?>
        </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#name_group')[0].focus();
        let filterTC = "<?php echo $this->lang->line('duallistbox_text_clear'); ?>",
        filterPH = "<?php echo $this->lang->line('duallistbox_place_holder'); ?>",
        selectedLL = "<h5><?php echo $this->lang->line('duallistbox_modules_selected'); ?></h5>",
        nonSelectedLL = "<h5><?php echo $this->lang->line('duallistbox_modules_not_selected'); ?></h5>",
        infoT = "{0} <?php echo $this->lang->line('duallistbox_info_text'); ?>",
        infoTE = "<?php echo $this->lang->line('duallistbox_info_text_empty'); ?>",
        infoTF = filterPH + " {0} <?php echo $this->lang->line('out_of'); ?> {1}",
        moveAL = "<?php echo $this->lang->line('duallistbox_move_all'); ?>",
        removeAL = "<?php echo $this->lang->line('duallistbox_remove_all'); ?>";

        $('#group_modules-multiselect').bootstrapDualListbox({
            filterTextClear: filterTC,
            filterPlaceHolder: filterPH,
            selectedListLabel: selectedLL,
            nonSelectedListLabel: nonSelectedLL,
            infoText: infoT,
            infoTextEmpty: infoTE,
            infoTextFiltered: infoTF,
            moveAllLabel: moveAL,
            removeAllLabel: removeAL
        });
    });
</script>
<style type="text/css">
    select {
        max-height: 200px;
    }
</style>