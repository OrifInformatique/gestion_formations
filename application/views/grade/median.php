<div class="container">
    <h1><?php echo $this->lang->line('grade_list'); ?></h1>
    <a name="cancel" class="btn btn-primary" href="<?=base_url('/grade/list/'.$apprentice_formation->id)?>"><?=$this->lang->line('return')?></a>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <b><?php echo $this->lang->line('grade_median'); ?></b>
        </div>
        <div class="col-md-8">
            <b><?php echo $this->lang->line('grade_grades'); ?></b>
        </div>
    </div>
    <?php for($i = 1; $i <= 8; $i++) { ?>
        <div class="row">
            <div class="col-md-2">
                <b><?php echo $this->lang->line('grade_semester').' '.$i; ?></b>
            </div>
            <div class="col-md-2">
                <b class="<?php
                if(!empty($medians[$i])) {
                    if($medians[$i] < 4)
                        echo 'grade_bad';
                    elseif($medians[$i] >= 5)
                        echo 'grade_good';
                    else
                        echo 'grade_neutral';
                } ?>">
                    <?php echo $medians[$i]; ?>
                </b>
            </div>
            <div class="col-md-8">
                <?php foreach($grades[$i] as $grade) { ?>
                    <span class="<?php
                    if($grade->grade < 4)
                        echo 'grade_bad';
                    elseif($grade->grade >= 5)
                        echo 'grade_good';
                    else
                        echo 'grade_neutral';
                    ?>">
                        <?php echo $grade->grade;
                    ?></span>;
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-2">
            <b><?php echo $this->lang->line('grade_median_end'); ?></b>
        </div>
        <div class="col-md-2">
            <b class="<?php
                if(!empty($medians[0])) {
                    if($medians[0] < 4)
                        echo 'grade_bad';
                    elseif($medians[0] >= 5)
                        echo 'grade_good';
                    else
                        echo 'grade_neutral';
                } ?>">
                <?php echo $medians[0]; ?>
            </b>
        </div>
        <div class="col-md-8"></div>
    </div>
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