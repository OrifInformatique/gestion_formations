<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of user type's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
$update = isset($user_type);
?>

<div class="container">
    <h1 class="title-section">
        <?php
        echo ($update ? $this->lang->line('user_type_modify') : $this->lang->line('user_type_new'));
        ?>
    </h1>
    <?php
    $attributes = array('name' => 'addFormUserType',
        'id' => 'addFormUserType');
    echo form_open('admin/user_type_form_validation', $attributes); ?>

        <!-- Display buttons and display topic and user type as information -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/admin/user_type_index')?>"><?=$this->lang->line('cancel')?></a>
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

        <!-- USER TYPE FIELDS -->
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
                        echo form_input('user_type_type',
                            set_value('user_type_type', ($update ? $user_type->type : '')),
                            array(
                                'maxlength' => 65535, 'class' => 'form-control',
                                'id' => 'user_type_type', 'autofocus' => 'autofocus',
                                'required' => 'required', 'pattern' => '^[A-Za-zÀ-ÿ ]+$',
                                'placeholder' => $this->lang->line('placeholder_user_type_type')
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
                        <?php echo form_label($this->lang->line('user_type_access_level'), 'user_type_access_level'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_dropdown('user_type_access_level', $access_levels,
                            set_value('user_type_access_level', ($update ? $user_type->access_level : '')),
                            'class="form-control" id="user_type_access_level" required="required"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>