<div class="container">
    <h1><?php echo $this->lang->line('grade_list'); ?></h1>
    <a class="btn btn-primary" href="<?=base_url('apprentice/apprentice_formations/'.$apprentice_formation->fk_apprentice)?>"><?=$this->lang->line('return')?></a>
    <div class="row">
        <div class="col-md-2"><b><?php echo $this->lang->line('grade_module'); ?></b></div>
        <div class="col-md-2"><b><?php echo $this->lang->line('grade_median'); ?></b></div>
        <div class="col-md-8"><b><?php echo $this->lang->line('grade_grades'); ?></b></div>
    </div>
    <?php foreach($modules as $module) { ?>
        <div class="row">
            <div class="col-md-2"><b>
                <?php echo $module->title; ?>
            </b></div>
            <div class="col-md-2"><b>
                <span class="<?php if(!empty($medians[$module->id])) {
                        if ($medians[$module->id] < 4)
                            echo 'grade_bad';
                        elseif ($medians[$module->id] >= 5)
                            echo 'grade_good';
                        else
                            echo 'grade_neutral';} ?>">
                    <?php if(!empty($medians[$module->id]))
                        echo round($medians[$module->id], 1); ?>
                </span>
            </b></div>
            <div class="col-md-7">
                <?php foreach($grades[$module->id] as $grade) { ?>
                    <a href="<?php echo base_url('grade/edit_grade/'.$grade->id); ?>"
                        class="<?php
                        if($grade->grade < 4)
                            echo 'grade_bad';
                        elseif($grade->grade >= 5)
                            echo 'grade_good';
                        else
                            echo 'grade_neutral';
                        ?>">
                        <?php echo trim($grade->grade); ?><!--
                    --></a>;
                <?php } ?>
            </div>
            <div class="col-md-1">
                <a href="<?php echo base_url('grade/add_to_module/'.$apprentice_formation->id.'/'.$module->id); ?>">
                [+]</a>
                <a href="<?php echo base_url('grade/remove_from_module/'.$apprentice_formation->id.'/'.$module->id); ?>">
                    [<span style="padding: 0 2px;">-</span>]
                </a>
            </div>
        </div>
    <?php } ?>
</div>
<style type="text/css">
    .grade_bad, .grade_bad:hover {
        background-color: #ffc2c2;
        color: red;
        padding: 0 3px;
    }
    .grade_good, .grade_good:hover {
        color: #00c400;
    }
    .grade_neutral, .grade_neutral:hover {
        color: #007bff;
    }
</style>