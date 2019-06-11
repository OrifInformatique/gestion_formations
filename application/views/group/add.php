<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of group's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
$update = isset($group);
?>

<div class="container">
    <h1 class="title-section"><?php echo $this->lang->line($update ? 'group_modify' : 'group_new'); ?></h1>
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
                    echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-warning"');
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
                        echo form_input('name_group',
                            set_value('name_group', ($update ? $group->name_group : '')),
                            array(
                                'maxlength' => 65535, 'class' => 'form-control',
                                'id' => 'name_group', 'autofocus' => 'autofocus',
                                'required' => 'required', 'pattern' => '^[A-Za-zÀ-ÿ0-9 \-\(\)]+$',
                                'placeholder' => $this->lang->line('placeholder_group_name')
                            ));
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
                        echo form_input(array('type' => 'number', 'name' => 'weight'),
                            set_value('weight', ($update ? $group->weight : 0)),
                            array(
                                'class' => 'form-control', 'id' => 'weight',
                                'required' => 'required', 'min' => 0,
                                'max' => 100
                            ));
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
                        echo form_checkbox('eliminatory', 'eliminatory',
                            ($update ? $group->eliminatory : set_value('eliminatory')),
                            'class="form-control" id="eliminatory"');
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
                        echo form_input(array('type' => 'number', 'name' => 'position'),
                            set_value('position', ($update ? $group->position : 0)),
                            'class="form-control" id="position" required="required"');
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
                        echo form_dropdown('parent_group', $groups,
                            set_value('parent_group', ($update ? $group->fk_parent_group : '')),
                            'class="form-control" id="parent_group" required="required"');
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
                        echo form_dropdown('group_formation', $formations,
                            set_value('group_formation', ($update ? $group->fk_formation : '')),
                            'class="form-control" id="group_formation" required="required"');
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
        /*
        In case of problem, see this link
        https://www.virtuosoft.eu/code/bootstrap-duallistbox/
        */
        let obj = {
            filterTextClear: "<?php echo $this->lang->line('duallistbox_text_clear'); ?>",
            filterPlaceHolder: "<?php echo $this->lang->line('duallistbox_place_holder'); ?>",
            selectedListLabel: "<h5><?php echo $this->lang->line('duallistbox_modules_selected'); ?></h5>",
            nonSelectedListLabel: "<h5><?php echo $this->lang->line('duallistbox_modules_not_selected'); ?></h5>",
            infoText: "{0} <?php echo $this->lang->line('duallistbox_info_text'); ?>",
            infoTextEmpty: "<?php echo $this->lang->line('duallistbox_info_text_empty'); ?>",
            infoTextFiltered: "<?php echo $this->lang->line('duallistbox_info_text_filtered'); ?>",
            moveAllLabel: "<?php echo $this->lang->line('duallistbox_move_all'); ?>",
            removeAllLabel: "<?php echo $this->lang->line('duallistbox_remove_all'); ?>"
        };

        $('#group_modules-multiselect').bootstrapDualListbox(obj);
    });
</script>
<style type="text/css">
    select {
        height: 200px;
    }
    .clear1, .clear2 {
        margin-top: 0;
    }
</style>