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
    <h1><?php echo $this->lang->line('user_create'); ?></h1>
    <?php
    $attributes = array("id" => "addUser",
                        "name" => "addUser");
    echo form_open('auth/form_validation', $attributes);
    ?>

    <!-- Display buttons and display topic and question type as information -->
    <div class="row">
        <div class="form-group">
            <a name="cancel" class="btn btn-danger" href="<?=base_url('/user')?>"><?=$this->lang->line('cancel')?></a>
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
    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-group row">
                <div class="col-md-4">
                    <?php echo form_label($this->lang->line('user_username'), 'username'); ?>
                </div>
                <div class="col-md-8">
                    <?php echo form_input('username', set_value('username'), 'class="form-control" id="username"'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-group row">
                <div class="col-md-4">
                    <?php echo form_label($this->lang->line('user_password'), 'password'); ?>
                </div>
                <div class="col-md-8">
                    <?php echo form_password('password', set_value('password'), 'class="form-control" id="password"'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-group row">
                <div class="col-md-4">
                    <?php echo form_label($this->lang->line('user_type'), 'user_type'); ?>
                </div>
                <div class="col-md-8">
                    <?php echo form_dropdown('user_type', $user_types, set_value('user_type'), 'class="form-control" id="user_type"'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>