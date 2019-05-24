<div class="container">
    <h1><?php echo $this->lang->line('grade_delete'); ?></h1>
    <div class="row">
        <?php echo $this->lang->line('grade_delete_confirm'); ?><span class="<?php
        if ($grade->grade < 4)
            echo 'grade_bad';
        elseif ($grade->grade >= 5)
            echo 'grade_good';
        else
            echo 'grade_neutral';
        ?>">
            <?php echo $grade->grade; ?>
        </span>?
    </div>
    <a href="<?php echo base_url('grade/delete_grade/'.$grade->id.'/1'); ?>" class="btn btn-danger"><?php echo $this->lang->line('yes'); ?></a>
    <a name="cancel" class="btn btn-primary" href="<?=base_url('/grade/remove_from_module/'.$apprentice_formation->id.'/'.$module->id)?>"><?=$this->lang->line('no')?></a>
</div>
<style type="text/css">
    .grade_bad, .grade_bad:hover {
        background-color: #ffc2c2;
        color: red;
        padding: 0 3px;
        margin: 0 3px;
    }
    .grade_good, .grade_good:hover {
        color: #00c400;
        margin: 0 3px;
    }
    .grade_neutral, .grade_neutral:hover {
        color: #007bff;
        margin: 0 3px;
    }
</style>