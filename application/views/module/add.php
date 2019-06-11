<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of module's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
$update = isset($module);
?>

<div class="container">
    <h1 class="title-section"><?php echo $this->lang->line($update ? 'module_modify' : 'module_new'); ?></h1>
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
                    echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-warning"');
                ?>
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
        if (!empty(validation_errors())) {
            echo '<div class="alert alert-danger">'.validation_errors().'</div>';
        }
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
                        echo form_input('title_module',
                            set_value('title_module', ($update ? $module->title : ''), FALSE),
                            array(
                                'maxlength' => '65535', 'class' => 'form-control',
                                'id' => 'title_module', 'autofocus' => 'autofocus',
                                'required' => 'required', 'pattern' => '^[A-Za-zÀ-ÿ0-9 \-,\.\'\/]+$',
                                'placeholder' => $this->lang->line('placeholder_module_title')
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
                        <?php echo form_label($this->lang->line('module_description'), 'description_module'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_input('description_module',
                            set_value('description_module', ($update ? $module->description : '')),
                            array(
                                'maxlength' => '65535', 'class' => 'form-control',
                                'id' => 'description_module', 'pattern' => '^[A-Za-zÀ-ÿ0-9 \-\.,\?\!:;]+$',
                                'placeholder' => $this->lang->line('placeholder_module_description')
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
                        <?php echo form_label($this->lang->line('module_is_subject'), 'is_subject'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_checkbox('is_subject', 'is_subject',
                            ($update ? $module->number == 0 : set_value('is_subject')),
                            array(
                                'class' => 'form-control', 'id' => 'is_subject',
                                'onchange' => 'setDisplay()'
                            ));
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
                        echo form_input(array('type' => 'number', 'name' => 'number_module'),
                            set_value('number_module', ($update ? $module->number : '')),
                            array(
                                'maxlength' => '65535', 'class' => 'form-control',
                                'id' => 'number_module', 'min' => 0,
                                'required' => 'required', 'placeholder' => $this->lang->line('placeholder_module_number')
                            ));
                        ?>
                    </div>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    let moduleNumberValue = 0;
    /**
     * Changes required values for toggling between module / subject
     */
    function setDisplay() {
        let checkbox = $('#is_subject')[0],
        moduleNumber = $('#div_module_number')[0],
        number = $('#number_module')[0],
        checked = checkbox.checked;
        moduleNumber.hidden = checked;
        if(checked) {
            moduleNumberValue = number.value;
            number.value = 0;
        } else {
            number.value = moduleNumberValue;
        }
    }
</script>