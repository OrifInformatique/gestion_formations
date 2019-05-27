<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of apprentice's details
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
if(isset($apprentice))
    $update = TRUE;
else
    $update = FALSE;
$attributes = array("id" => "apprenticeForm",
                    "name" => "apprenticeForm");
?>

<div class="container">
    <h1 class="title-section">
        <?php
        if($update)
            echo $this->lang->line("modify");
        else
            echo $this->lang->line("new");
        ?>
    </h1>
    <?php echo form_open('Apprentice/form_validation', $attributes); ?>

    <div class="row">
        <div class="form-group">
            <a name="cancel" class="btn btn-danger" href="<?=base_url('/apprentice')?>"><?=$this->lang->line('cancel')?></a>
            <?php
                echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"');
                //echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-danger"');
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
                    if($update)
                        echo form_input('firstname', set_value('firstname', $apprentice->firstname), 'maxlength="65535" class="form-control" id="firstname"');
                    else
                        echo form_input('firstname', set_value('firstname'), 'maxlength="65535" class="form-control" id="firstname"');
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
                    if($update)
                        echo form_input('lastname', set_value('lastname', $apprentice->last_name), 'maxlength="65535" class="form-control" id="lastname"');
                    else
                        echo form_input('lastname', set_value('lastname'), 'maxlength="65535" class="form-control" id="lastname"');
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
                    if($update)
                        echo form_input(array('type' => 'date', 'name' => 'datebirth'), set_value('datebirth', $apprentice->date_birth), 'maxlength="65535" class="form-control" id="datebirth"');
                    else
                        echo form_input(array('type' => 'date', 'name' => 'datebirth'), set_value('datebirth'), 'maxlength="65535" class="form-control" id="datebirth"');
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
                    if($update)
                        echo form_dropdown('teacher', $teachers, set_value('teacher', $apprentice->fk_teacher), 'class="form-control" id="teacher"');
                    else
                        echo form_dropdown('teacher', $teachers, set_value('teacher'), 'class="form-control" id="teacher"');
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
                    //Find a way to load the users
                    if($update)
                        echo form_dropdown('user', $users, set_value('user', $apprentice->fk_user), 'class="form-control" id="user"');
                    else
                        echo form_dropdown('user', $users, set_value('user'), 'class="form-control" id="user"');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#firstname')[0].focus();
    });
</script>