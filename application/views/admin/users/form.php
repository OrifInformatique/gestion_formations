<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of user's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
$update = isset($user);
?>

<div class="container">
    <h1 class="title-section">
        <?php
        echo $this->lang->line($update ? 'user_modify' : 'user_new');
        ?>
    </h1>
    <?php
    $attributes = array("name" => "addFormUser",
        "id" => "addFormUser");
    echo form_open('Admin/user_form_validation', $attributes); ?>
        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/admin/user_index')?>"><?=$this->lang->line('cancel')?></a>
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

        <!-- USER FIELDS -->
        <?php

        if($update) {
            echo form_hidden('id', $user->id);
        }

        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('user_username'), 'user_username'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_input('user_username',
                            set_value('user_username', ($update ? $user->user : '')),
                            array(
                                'maxlength' => '65535', 'class' => 'form-control',
                                'id' => 'user_username', 'autofocus' => 'autofocus',
                                'required' => 'required', 'pattern' => '^[A-Za-z0-9 \-]{'.USERNAME_MIN_LENGTH.',}$',
                                'placeholder' => $this->lang->line('placeholder_user_username')
                            ));
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if(!$update) { ?>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('user_password'), 'user_password'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_password('user_password',
                            set_value('user_password'),
                            array(
                                'maxlength' => '65535', 'class' => 'form-control',
                                'id' => 'user_password', 'required' => 'required',
                                'pattern' => '.{'.PASSWORD_MIN_LENGTH.',}',
                                'placeholder' => $this->lang->line('placeholder_user_password')
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
                        <?php echo form_label($this->lang->line('user_password_again'), 'user_password_again'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_password('user_password_again',
                            set_value('user_password_again'),
                            array(
                                'maxlength' => '65535', 'class' => 'form-control',
                                'id' => 'user_password_again', 'required' => 'required',
                                'pattern' => '.{'.PASSWORD_MIN_LENGTH.',}',
                                'placeholder' => $this->lang->line('placeholder_user_password')
                            ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('user_type'), 'user_type'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_dropdown('user_type', $user_types,
                            set_value('user_type', ($update ? $user->fk_user_type : '')),
                            'class="form-control" id="user_type" required="required"');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>