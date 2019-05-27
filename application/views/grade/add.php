<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of formation's details to update
 *
 * @author      Orif, section informatique (BuYa, MeSa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
$update = isset($grade);
?>

<div class="container">
    <h1>
        <?php if($update)
            echo $this->lang->line('grade_edit');
        else
            echo $this->lang->line('grade_new');
        ?>
    </h1>
    <?php
    $attributes = array("id" => "gradeForm",
                        "name" => "gradeForm");
    echo form_open('Grade/grade_validation', $attributes);

    echo form_hidden('app_for_id', $apprentice_formation->id);
    echo form_hidden('mod_id', $module->id);
    if($update) {
        echo form_hidden('grade_id', $grade->id);
    }
    ?>
        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/grade/list/'.$apprentice_formation->id)?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"');
                    //echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-warning"');
                ?>
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
        if (!empty(validation_errors())) {
            echo '<div class="alert alert-danger">'.validation_errors().'</div>';}
        ?>

        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <?php echo form_label($this->lang->line('grade_grade'), 'grade_grade'); ?>
                </div>
                <div class="col-md-1">
                    <?php
                    if($update)
                        echo form_input('grade_grade', set_value('grade_grade', $grade->grade), 'id="grade_grade" class="form-control"');
                    else
                        echo form_input('grade_grade', set_value('grade_grade'), 'id="grade_grade" class="form-control" maxlength="4"');
                    ?>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_date_test'), 'grade_date_test'); ?>
                </div>
                <div class="col-md-2">
                    <input type="date" name="grade_date_test" id="grade_date_test" value="<?php
                    if($update)
                        echo $grade->date_test;
                    ?>" class="form-control">
                </div>
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_date_inscription'), 'grade_date_inscription'); ?>
                </div>
                <div class="col-md-2">
                    <input type="date" name="grade_date_inscription" id="grade_date_inscription" value="<?php
                    if($update)
                        echo $grade->date_inscription;
                    ?>" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_weight'), 'grade_weight'); ?>
                </div>
                <div class="col-md-3">
                    <?php
                    if($update)
                        echo form_input('grade_weight', set_value('grade_weight', $grade->weight), 'id="grade_weight" class="form-control"');
                    else
                        echo form_input('grade_weight', set_value('grade_weight'), 'id="grade_weight" class="form-control"');
                    ?>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_semester'), 'grade_semester'); ?>
                </div>
                <div class="col-md-3">
                    <?php
                    if($update)
                        echo form_input('grade_semester', set_value('grade_semester', $grade->semester), 'id="grade_semester" class="form-control"');
                    else
                        echo form_input('grade_semester', set_value('grade_semester'), 'id="grade_semester" class="form-control"');
                    ?>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#grade_grade')[0].focus();
    });
</script>