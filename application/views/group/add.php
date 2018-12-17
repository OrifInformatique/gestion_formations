<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of question's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

<div class="container">
    <h1 class="title-section"><?php if(isset($group)) {echo $this->lang->line('group_modify');} else {echo $this->lang->line('group_new');} ?></h1>
    <?php
    $attributes = array("id" => "addGroupForm",
                        "name" => "addGroupForm");
    echo form_open('Group/form_validate', $attributes);
    ?>        
        <!-- Display buttons and display topic and question type as information -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/group')?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"'); 
                    echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-danger"');
                ?>
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
        if (!empty(validation_errors())) {
            echo '<div class="alert alert-danger">'.validation_errors().'</div>';}
        ?>

        <!-- QUESTION FIELDS -->
        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_name'), 'name'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php 
                            if(isset($group)){
                                echo form_input('name', $group->name, 'maxlength="65535" class="form-control" id="name"');
                            } else {
                                echo form_input('name', '', 'maxlength="65535" class="form-control" id="name"');
                            }
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
                            if(isset($group)){
                                echo form_input('weight', $group->weight, 'class="form-control" id="weight"');
                            } else {
                                echo form_input('weight', 100, 'class="form-control" id="weight"');
                            }
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
                            if(isset($group)){
                                echo form_checkbox('eliminatory', 'eliminatory', $group->eliminatory, 'class="form-control" id="eliminatory"');
                            } else {
                                echo form_checkbox('eliminatory', 'eliminatory', false, 'class="form-control" id="eliminatory"');
                            }
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
                            if(isset($group)){
                                echo form_input('position', $group->position, 'class="form-control" id="position"');
                            } else {
                                echo form_input('position', 1, 'class="form-control" id="position"');
                            }
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
                            echo form_dropdown('parent_group', $groups, null, 'class="form-control" id="parent_group"');
                        ?>
                    </div>
                </div>
            </div>
        </div>
            
    <?php echo form_close(); ?>
</div>