<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of formation's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
$update = isset($formation);
?>

<div class="container">
    <h1 class="title-section"><?php
    echo $this->lang->line($update ? 'formation_modify' : 'formation_new');
    ?></h1>
    <?php
    $attributes = array("id" => "addFormationForm",
                        "name" => "addFormationForm");
    echo form_open('Formation/form_validation', $attributes);
    ?>
        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/formation')?>"><?=$this->lang->line('cancel')?></a>
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

        <!-- FORMATION FIELDS -->
        <?php

        if($update){
            echo form_hidden('id', $formation->id);
            unset($formation->id);
        }
        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('formation_name'), 'name_formation'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo form_input('name_formation',
                            set_value('name_formation', ($update ? $formation->name_formation : ''), FALSE),
                            array(
                                'maxlength' => 65535, "class" => 'form-control',
                                'id' => 'name_formation', 'autofocus' => 'autofocus',
                                'required' => 'required', 'pattern' => '^[A-Za-zÀ-ÿ0-9 \-\']+$',
                                'placeholder' => $this->lang->line('placeholder_formation_name')
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
                        <?php echo form_label($this->lang->line('formation_duration'), 'duration_formation'); ?>
                    </div>
                    <div class="col-md-7">
                        <?php
                        echo form_input(array('type' => 'number', 'name' => 'duration_formation'),
                            set_value('duration_formation', ($update ? $formation->duration : 0)),
                            array(
                                'class' => 'form-control', 'id' => 'duration_formation',
                                'required' => 'required', 'min' => 0
                            ));
                        ?>
                    </div>
                    <div class="col-md-1">
                        <?php echo $this->lang->line('years'); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>