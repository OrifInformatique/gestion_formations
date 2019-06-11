<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of apprentice's details
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
$update = isset($apprentice);
$attributes = array("id" => "apprenticeForm",
                    "name" => "apprenticeForm");
?>

<div class="container">
    <h1 class="title-section">
        <?php echo $this->lang->line($update ? "apprentice_modify" : "apprentice_new"); ?>
    </h1>
    <?php echo form_open('Apprentice/form_validation', $attributes); ?>

    <div class="row">
        <div class="form-group">
            <a name="cancel" class="btn btn-danger" href="<?=base_url('/apprentice')?>"><?=$this->lang->line('cancel')?></a>
            <?php
                echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"');
                echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-warning"');
            ?>
        </div>
    </div>

    <?php
    if (!empty(validation_errors()))
        echo '<div class="alert alert-danger">'.validation_errors().'</div>';

    if($update)
        echo form_hidden('id', $apprentice->id );
    ?>

    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-group row">
                <div class="col-md-4">
                    <?php echo form_label($this->lang->line('apprentice_firstname'), 'firstname'); ?>
                </div>
                <div class="col-md-8">
                    <?php
                    echo form_input('firstname',
                        set_value('firstname', ($update ? $apprentice->firstname : '')),
                        array(
                            'maxlength' => 65535, 'class' => 'form-control',
                            'id' => 'firstname', 'autofocus' => 'autofocus',
                            'required' => 'required', 'pattern' => '^[A-Za-zÀ-ÿ0-9 \-]+$',
                            'placeholder' => $this->lang->line('placeholder_apprentice_firstname')
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
                    <?php echo form_label($this->lang->line('apprentice_lastname'), 'lastname'); ?>
                </div>
                <div class="col-md-8">
                    <?php
                    echo form_input('lastname',
                        set_value('lastname', ($update ? $apprentice->last_name : '')),
                        array(
                            'maxlength' => 65535, 'class' => 'form-control',
                            'id' => 'lastname', 'autofocus' => 'autofocus',
                            'required' => 'required', 'pattern' => '^[A-Za-zÀ-ÿ0-9 \-]+$',
                            'placeholder' => $this->lang->line('placeholder_apprentice_lastname')
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
                    <?php echo form_label($this->lang->line('apprentice_datebirth'), 'datebirth'); ?>
                </div>
                <div class="col-md-8">
                    <?php
                    echo form_input(array('type' => 'date', 'name' => 'datebirth'),
                        set_value('datebirth', ($update ? $apprentice->date_birth : '')),
                        array(
                            'class' => 'form-control', 'id' => 'datebirth',
                            'required' => 'required', 'max' => $max_date
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
                    <?php echo form_label($this->lang->line('apprentice_teacher'), 'teacher'); ?>
                </div>
                <div class="col-md-8">
                    <?php
                    echo form_dropdown('teacher', $teachers,
                        set_value('teacher', ($update ? $apprentice->fk_teacher : '')),
                        'class="form-control" id="teacher" required="required"');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-group row">
                <div class="col-md-4">
                    <?php echo form_label($this->lang->line('apprentice_user'), 'user'); ?>
                </div>
                <div class="col-md-8">
                    <?php
                    echo form_dropdown('user', $users,
                        set_value('user', ($update ? $apprentice->fk_user : '')),
                        'class="form-control" id="user" required="required"');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>