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
    <h1 class="title-section"><?php echo $this->lang->line('title_question_update'); ?></h1>
    <?php
    $attributes = array("id" => "addGroupForm",
                        "name" => "addGroupForm");
    echo form_open('Group/form_validate', $attributes);
    ?>        
        <!-- Display buttons and display topic and question type as information -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger col-xs-12 col-sm-4" href="<?=base_url('/Group')?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success col-xs-12 col-sm-4 col-sm-offset-4"'); 
                    echo form_submit('test', '', 'style="visibility: hidden; height:0;"');//for cancel "Enter" key in form 
                ?>
            </div>
            <div class="form-group col-md-8 text-right">
                <h4><?php echo $this->lang->line('group_new'); ?></h4>
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
                <?php echo form_label($this->lang->line('group_name'), 'name'); ?>
                <?php 
                    if(isset($name)){
                        echo form_input('name', $name, 'maxlength="65535" class="form-control" id="name"');
                    } else {
                        echo form_input('name', '', 'maxlength="65535" class="form-control" id="name"');
                    }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_weight'), 'weight'); ?>
                    </div>
                    <div class="col-md-7">
                        <?php 
                            if(isset($weight)){
                                echo form_input('weight', $weight, 'class="form-control" id="weight"');
                            } else {
                                echo form_input('weight', 100, 'class="form-control" id="weight"');
                            }
                        ?>
                    </div>
                    <div class="col-md-1">
                        %
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_eliminatory'), 'eliminatory'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php 
                            if(isset($eliminatory)){
                                echo form_checkbox('eliminatory', 'eliminatory', $eliminatory, 'class="form-control" id="eliminatory"');
                            } else {
                                echo form_checkbox('eliminatory', 'eliminatory', false, 'class="form-control" id="eliminatory"');
                            }
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_position'), 'position'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php 
                            if(isset($position)){
                                echo form_input('position', $position, 'class="form-control" id="position"');
                            } else {
                                echo form_input('position', 1, 'class="form-control" id="position"');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('group_parent_group'), 'parent_group'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php 
                            echo form_dropdown('parent_group', $groups, null, 'class="form-control" id="parent_group"');
                        ?>
                    </div>
                </div>
            </div>
        </div>
            
    <?php echo form_close(); ?>
</div>