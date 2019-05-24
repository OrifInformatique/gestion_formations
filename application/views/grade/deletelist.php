<div class="container">
    <h1><?php echo $this->lang->line('grade_list_delete'); ?></h1>
    <a name="cancel" class="btn btn-primary" href="<?=base_url('/grade/list/'.$apprentice_formation->id)?>"><?=$this->lang->line('return')?></a>
    <div class="row"><b>
        <div class="col-md-4"><?php echo $this->lang->line('grade_grade'); ?></div>
    </b></div>
    <?php foreach($grades as $grade) { ?>
        <div class="row">
            <div class="col-md-4">
                <span class="<?php
                if($grade->grade < 4)
                    echo 'grade_bad';
                elseif ($grade->grade >= 5)
                    echo 'grade_good';
                else
                    echo 'grade_neutral';
                ?>">
                    <?php echo $grade->grade; ?>
                </span>
            </div>
            <div class="col-md-1">
                <a href="<?php echo base_url('grade/delete_grade/'.$grade->id); ?>">[x]</a>
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