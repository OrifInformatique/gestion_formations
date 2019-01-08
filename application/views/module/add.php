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
    <h1 class="title-section"><?php if(isset($module)) {echo $this->lang->line('module_modify'); $update = true;} else {echo $this->lang->line('module_new'); $update = false;} ?></h1>
    <?php
    $attributes = array("id" => "addModuleForm",
                        "name" => "addModuleForm");
    echo form_open('Module/form_validation', $attributes);
    ?>        
        <!-- Display buttons and display topic and question type as information -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/module')?>"><?=$this->lang->line('cancel')?></a>
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

        <!-- QUESTION FIELDS -->
        <?php

        if($update){
            echo form_hidden('id', $module->ID);
        }

        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('module_title'), 'title_module'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('title_module', set_value('title_module', $module->Title), 'maxlength="65535" class="form-control" id="title_module"');
                        else
                            echo form_input('title_module', set_value('title_module'), 'maxlength="65535" class="form-control" id="title_module"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('module_group'), 'group_module'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_dropdown('group_module', $groups, set_value('group_module', $module->FK_Group), 'class="form-control" id="group_module"');
                        else
                            echo form_dropdown('group_module', $groups, set_value('group_module'), 'class="form-control" id="group_module"');
                        ?>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('module_description'), 'description_module'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('description_module', set_value('description_module', $module->Description), 'maxlength="65535" class="form-control" id="description_module"');
                        else
                            echo form_input('description_module', set_value('description_module'), 'maxlength="65535" class="form-control" id="description_module"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('module_is_subject'), 'is_subject_module'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_checkbox('is_subject_module', 'is_subject_module', $module->Is_Subject, 'class="form-control" id="is_subject_module"');
                        else
                            echo form_checkbox('is_subject_module', 'is_subject_module', set_value('is_subject_module'), 'class="form-control" id="is_subject_module"');
                        ?>
                    </div>

                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>