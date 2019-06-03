<div class="container">
    <h1><?php echo $this->lang->line('grade_list'); ?></h1>
    <a class="btn btn-primary" href="<?=base_url('apprentice/apprentice_formations/'.$apprentice_formation->fk_apprentice)?>"><?=$this->lang->line('return')?></a>
    <?php
    foreach ($groups as $group) { ?>
        <a class="btn btn-secondary" href="#" onclick="toggleDiv('group_<?php echo $group->id; ?>_div')"
            id="group_<?php echo $group->id; ?>_btn">
            <?php echo $this->lang->line('grade_group_hide').' '.$group->name_group; ?>
        </a>
    <?php } ?>
</div>
<br>
<div class="container" style="max-width: 90%; margin-bottom: 2%;">
    <div class="row">
        <div class="col-md-1"><b><?php echo $this->lang->line('module_group'); ?></b></div>
        <div class="col-md-5"><b><?php echo $this->lang->line('grade_module'); ?></b></div>
        <div class="col-md-1"><b><?php echo $this->lang->line('grade_median'); ?></b></div>
        <div class="col-md-4"><b><?php echo $this->lang->line('grade_grades'); ?></b></div>
        <div class="col-md-1"></div>
    </div>
    <?php foreach($groups as $group) {
        $first = TRUE; ?>
        <div id="group_<?php echo $group->id; ?>_div" <?php if($first) echo 'style="border-top:double rgb(182, 186, 190) 1px;"'; ?>>
            <?php foreach($modules[$group->id] as $module) { ?>
                <div class="row row_plus row_hover">
                    <div class="col-md-1">
                        <b><?php if ($first) echo $group->name_group; ?></b>
                    </div>
                    <div class="col-md-5"><i><?php echo $module->title; ?></i></div>
                    <div class="col-md-1">
                        <b><a href="<?php echo base_url('grade/get_median/'.$apprentice_formation->id.'/'.$module->id); ?>"
                        class="<?php
                        if(!empty($medians[$module->id])) {
                            if($medians[$module->id] < 4)
                                echo 'grade_bad';
                            elseif($medians[$module->id] >= 5)
                                echo 'grade_good';
                            else
                                echo 'grade_neutral';}
                        ?>">
                            <?php echo $medians[$module->id]; ?>
                        </a></b>
                    </div>
                    <div class="col-md-4">
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
                                <?php echo $grade->grade; ?><!--
                            --></a>;
                        <?php } ?>
                    </div>
                    <div class="col-md-1">
                        <a href="<?php echo base_url('grade/add_to_module/'.$apprentice_formation->id.'/'.$module->id); ?>"
                            class="btn btn-success">+</a>
                        <?php if(!empty($medians[$module->id])) { ?>
                            <a href="<?php echo base_url('grade/remove_from_module/'.$apprentice_formation->id.'/'.$module->id); ?>" class="btn btn-danger">
                                <span style="padding: 0 2px">-</span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php $first = FALSE; }
            if(!empty($group_medians[$group->id])) { ?>
            <div class="row row_plus">
                <div class="col-md-1"></div>
                <div class="col-md-5"><b><?php echo $this->lang->line('grade_median'); ?></b></div>
                <div class="col-md-1">
                    <b class="<?php
                    if($group_medians[$group->id] < 4)
                        echo 'grade_bad';
                    elseif($group_medians[$group->id] >= 5)
                        echo 'grade_good';
                    else
                        echo 'grade_neutral';
                    ?>">
                        <?php echo $group_medians[$group->id]; ?>
                    </b>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-1"></div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="row row_plus">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <b><?php echo $this->lang->line('grade_median_end'); ?></b>
        </div>
        <div class="col-md-1">
            <?php if(!empty($final_median)) { ?>
                <b class="<?php
                if($final_median < 4)
                    echo 'grade_bad';
                elseif($final_median >= 5)
                    echo 'grade_good';
                else
                    echo 'grade_neutral';
                ?>">
                    <?php echo $final_median; ?>
                </b>
            <?php } ?>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-1"></div>
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

    .row_plus {
        min-height: 40px;
        border-bottom: solid rgba(234,234,234,1) 1px;
        padding: 2px 0;
    }
    .row_hover:hover {
        background-color: rgba(240,240,240,1);
    }
</style>
<script type="text/javascript">

    // Contains the divs' ids
    let buttonDivs = [<?php
        foreach($groups as $group) {
            echo "`group_".$group->id."_div`,";} ?>];
        // Contains the buttons' texts
    let buttonTexts = [<?php
        foreach($groups as $group) {
            $text = "[`"; // Open js array

            $text .= $this->lang->line('grade_group_hide')." ".$group->name_group;
            $text .= "`,`"; // Separator
            $text .= $this->lang->line('grade_group_show')." ".$group->name_group;

            $text .= "`],"; // Close js array

            echo $text;}; ?>];
        // Contains the buttons' ids
    let buttons = [<?php
        foreach($groups as $group) {
            echo "`group_".$group->id."_btn`,";} ?>];

    // Toggles a tbody
    function toggleDiv(divId) {
        let index = buttonDivs.indexOf(divId);
        if(index == -1) {
            console.log(false);
            return;
        }
        let docPart = document.getElementById(buttonDivs[index]),
            button = document.getElementById(buttons[index]),
            hidden = !docPart.hidden,
            newText = buttonTexts[index][hidden*1];
        button.innerHTML = newText;
        docPart.hidden = hidden;
    }
</script>