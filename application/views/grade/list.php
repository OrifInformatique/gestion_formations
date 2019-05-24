<div class="container">
    <h1><?php echo $this->lang->line('grade_list'); ?></h1>
    <a class="btn btn-primary" href="<?=base_url('apprentice/apprentice_formations/'.$apprentice_formation->fk_apprentice)?>"><?=$this->lang->line('return')?></a>
    <div class="row">
        <div class="col-md-2"><b><?php echo $this->lang->line('grade_module'); ?></b></div>
        <div class="col-md-2"><b><?php echo $this->lang->line('grade_median'); ?></b></div>
        <div class="col-md-8"><b><?php echo $this->lang->line('grade_grades'); ?></b></div>
    </div>
    <?php foreach($modules as $module) {
        if(empty($medians[$module->id][0])) continue; ?>
        <div class="row">
            <div class="col-md-2"><i>
                <?php echo $module->title; ?>
            </i></div>
            <div class="col-md-2"><b>
                <a href="<?php echo base_url('grade/get_median/'.$apprentice_formation->id.'/'.$module->id); ?>"
                class="<?php if(!empty($medians[$module->id][0])) {
                        if ($medians[$module->id][0] < 4)
                            echo 'grade_bad';
                        elseif ($medians[$module->id][0] >= 5)
                            echo 'grade_good';
                        else
                            echo 'grade_neutral';} ?>">
                    <?php if(!empty($medians[$module->id][0]))
                        echo $medians[$module->id][0]; ?>
                </a>
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
    <hr>
    <a href="#" class="btn btn-secondary" id="noGradesButton" onclick="toggleNoGradesDisplay();" style="cursor: pointer;">
        <?php echo $this->lang->line('grade_no_grade_show'); ?>
    </a>
    <div id='noGradesDiv' hidden>
    <?php foreach($modules as $module) {
        if(!empty($medians[$module->id][0])) continue; ?>
        <div class="row">
            <div class="col-md-2"><i><?php echo $module->title; ?></i></div>
            <div class="col-md-9"></div>
            <div class="col-md-1">
                <a href="<?php echo base_url('grade/add_to_module/'.$apprentice_formation->id.'/'.$module->id); ?>">
                [+]</a>
            </div>
        </div>
    <?php } ?>
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
<script type="text/javascript">
    let text = [
        "<?php echo $this->lang->line('grade_no_grade_show'); ?>",
        "<?php echo $this->lang->line('grade_no_grade_hide'); ?>"
    ];

    Boolean.prototype.toInt=function(){return this.valueOf()?1:0};

    function toggleNoGradesDisplay() {
        let noGradesDiv = document.getElementById('noGradesDiv'),
        noGradesButton = document.getElementById('noGradesButton'),
        hidden = noGradesDiv.hidden;
        noGradesButton.innerText = text[hidden.toInt()];
        noGradesDiv.hidden = !hidden;
    };
</script>