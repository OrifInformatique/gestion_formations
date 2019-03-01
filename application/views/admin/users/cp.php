<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of user's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

<div class="container">
    <?php if(!isset($user) || is_null($user)) { ?>
    <div class="row alert alert-warning"><?php echo $this->lang->line('user_missing'); ?></div>
    <?php } else { ?>
    <h1><?php echo $this->lang->line('user_change_password'); ?></h1>
    <?php
    $attributes = array("name" => "changeFormPassword",
                        "id" => "changeFormPassword");
    echo form_open('Admin/user_change_password_validation', $attributes);
    ?>

        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/admin/user_index')?>"><?=$this->lang->line('cancel')?></a>
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

        <!-- USER FIELDS -->
        <?php

        echo form_hidden('id', $user->id);

        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4"><?php echo $this->lang->line('user_password_old'); ?></div>
                    <div class="col-md-8">
                        <?php echo form_password('user_password_old', set_value('user_password_old'), 'maxlength="65535" class="form-control" id="user_password_old"'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4"><?php echo $this->lang->line('user_password_new'); ?></div>
                    <div class="col-md-8">
                        <?php echo form_password('user_password_new', set_value('user_password_new'), 'maxlength="65535" class="form-control" id="user_password_new"'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4"><?php echo $this->lang->line('user_password_again'); ?></div>
                    <div class="col-md-8">
                        <?php echo form_password('user_password_again', set_value('user_password_again'), 'maxlength="65535" class="form-control" id="user_password_again"'); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
    <?php } ?>
</div>