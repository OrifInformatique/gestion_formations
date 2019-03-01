<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of module's details to update
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
        <!-- Display buttons -->
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

        <!-- MODULE FIELDS -->
        <?php

        if($update){
            echo form_hidden('id', $module->id);
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
                            echo form_input('title_module', set_value('title_module', $module->title), 'maxlength="65535" class="form-control" id="title_module"');
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
                        <?php echo form_label($this->lang->line('module_description'), 'description_module'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('description_module', set_value('description_module', $module->description), 'maxlength="65535" class="form-control" id="description_module"');
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
                        <?php echo form_label($this->lang->line('module_is_subject'), 'is_subject'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_checkbox('is_subject', 'is_subject', $module->number == 0, 'class="form-control" id="is_subject" onclick="setDisplay()"');
                        else
                            echo form_checkbox('is_subject', 'is_subject', set_value('is_subject'), 'class="form-control" id="is_subject" onclick="setDisplay()"');
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" id="div_module_number">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('module_number'), 'number_module'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('number_module', set_value('number_module', $module->number), 'maxlength="65535" class="form-control" id="number_module"');
                        else
                            echo form_input('number_module', set_value('number_module'), 'maxlength="65535" class="form-control" id="number_module"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/module_add.js'); ?>"></script>