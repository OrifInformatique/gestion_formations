<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of teacher's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

<div class="container">
    <h1 class="title-section">
        <?php
        if(isset($teacher)) {
            echo $this->lang->line('teacher_modify');
            $update = TRUE;
        } else {
            echo $this->lang->line('teacher_new');
            $update = FALSE;
        }
        ?>
    </h1>
    <?php
    $attributes = array("name" => "addFormTeacher",
        "id" => "addFormTeacher");
    echo form_open('Admin/teacher_form_validation', $attributes);
    ?>
        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/admin/teacher_index')?>"><?=$this->lang->line('cancel')?></a>
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

        if($update) {
            echo form_hidden('id', $teacher->id);
        }
        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('teacher_firstname'), 'teacher_firstname'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('teacher_firstname', set_value('teacher_firstname', $teacher->firstname), 'maxlength="65535" class="form-control" id="teacher_firstname"');
                        else
                            echo form_input('teacher_firstname', set_value('teacher_firstname'), 'maxlength="65535" class="form-control" id="teacher_firstname"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('teacher_name'), 'teacher_name'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('teacher_name', set_value('teacher_name', $teacher->last_name), 'maxlength="65535" class="form-control" id="teacher_name"');
                        else
                            echo form_input('teacher_name', set_value('teacher_name'), 'maxlength="65535" class="form-control" id="teacher_name"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('teacher_username'), 'teacher_user'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_dropdown('teacher_user', $users, set_value('teacher_user', $teacher->fk_user), 'class="form-control" id="teacher_user"');
                        else
                            echo form_dropdown('teacher_user', $users, set_value('teacher_user'), 'class="form-control" id="teacher_user"');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    echo form_close();
    ?>
</div>