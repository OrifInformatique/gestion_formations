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
        <?php
        echo $this->lang->line($update ? 'grade_edit' : 'grade_new');
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
                    echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-warning"');
                ?>
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
        if (!empty(validation_errors())) {
            echo '<div class="alert alert-danger">'.validation_errors().'</div>';
        }
        ?>

        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <?php echo form_label($this->lang->line('grade_grade'), 'grade_grade'); ?>
                </div>
                <div class="col-md-1">
                    <?php
                    echo form_input(array('type' => 'number', 'name' => 'grade_grade'),
                        set_value('grade_grade', ($update ? $grade->grade : '')),
                        array(
                            'id' => 'grade_grade', 'class' => 'form-control',
                            'maxlength' => 4, 'autofocus' => 'autofocus',
                            'min' => 0, 'max' => 6, 'step' => .5,
                            'required' => 'required'
                        ));
                    ?>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_date_test'), 'grade_date_test'); ?>
                </div>
                <div class="col-md-2">
                    <?php
                    echo form_input(array('type' => 'date', 'name' => 'grade_date_test'),
                        set_value('grade_date_test', ($update ? $grade->date_test : '')),
                        array(
                            'id' => 'grade_date_test', 'class' => 'form-control',
                            'max' => $date_max, 'required' => 'required'
                        ));
                    ?>
                </div>
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_date_inscription'), 'grade_date_inscription'); ?>
                </div>
                <div class="col-md-2">
                    <?php
                    echo form_input(array('type' => 'date', 'name' => 'grade_date_inscription'),
                        set_value('grade_date_inscription', ($update ? $grade->date_inscription : '')),
                        array(
                            'id' => 'grade_date_inscription', 'class' => 'form-control',
                            'max' => $date_max, 'required' => 'required'
                        ));
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_weight'), 'grade_weight'); ?>
                </div>
                <div class="col-md-3">
                    <?php
                    echo form_input(array('type' => 'number', 'name' => 'grade_weight'),
                        set_value('grade_weight', ($update ? $grade->weight : '')),
                        array(
                            'id' => 'grade_weight', 'class' => 'form-control',
                            'min' => 1, 'required' => 'required'
                        ));
                    ?>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <?php echo form_label($this->lang->line('grade_semester'), 'grade_semester'); ?>
                </div>
                <div class="col-md-3">
                    <?php
                    echo form_input(array('type' => 'number', 'name' => 'grade_semester'),
                        set_value('grade_semester', ($update ? $grade->semester : '')),
                        array(
                            'id' => 'grade_semester', 'class' => 'form-control',
                            'min' => 1, 'max' => $semester_max,
                            'required' => 'required'
                        ));
                    ?>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>