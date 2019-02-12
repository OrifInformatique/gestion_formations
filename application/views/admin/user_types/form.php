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
    <h1 class="title-section">
        <?php if(isset($user_type)) {
            echo $this->lang->line('user_type_modify');
            $update = TRUE;
        } else {
            echo $this->lang->line('user_type_new');
            $update = FALSE;
        } ?>
    </h1>
    <?php
    $attributes = array('name' => 'addFormUserType',
        'id' => 'addFormUserType');
    echo form_open('admin/user_type_form_validation', $attributes); ?>

        <!-- Display buttons and display topic and question type as information -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/admin/user_type_index')?>"><?=$this->lang->line('cancel')?></a>
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

        if($update) {
            echo form_hidden('id', $user_type->id);
        }

        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('user_type_type'), 'user_type_type'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('user_type_type', set_value('user_type_type', $user_type->type), 'maxlength="65535" class="form-control" id="user_type_type"');
                        else
                            echo form_input('user_type_type', set_value('user_type_type'), 'maxlength="65535" class="form-control" id="user_type_type"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('user_type_access_level'), 'user_type_access_level'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_dropdown('user_type_access_level', $access_levels, set_value('user_type_access_level', $user_type->access_level), 'class="form-control" id="user_type_access_level"');
                        else
                            echo form_dropdown('user_type_access_level', $access_levels, set_value('user_type_access_level'), 'class="form-control" id="user_type_access_level"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>