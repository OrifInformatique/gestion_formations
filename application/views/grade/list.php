<div class="container" style="max-width: 65%">
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
<!-- Grades table -->
<div class="container" style="max-width: 80%;">
    <!-- Header -->
    <div class="row row_plus">
        <div class="col-md-1"><b><?php echo $this->lang->line('module_group'); ?></b></div>
        <div class="col-md-6"><b><?php echo $this->lang->line('grade_module'); ?></b></div>
        <div class="col-md-1"><b><?php echo $this->lang->line('grade_median'); ?></b></div>
        <div class="col-md-3"><b><?php echo $this->lang->line('grade_grades'); ?></b></div>
        <div class="col-md-1"></div>
    </div>

    <!-- Each group gets its own togglable div -->
    <?php foreach($groups as $group) { ?>
        <div id="group_<?php echo $group->id; ?>_div" <?php echo 'style="border-top:double rgb(182, 186, 190) 1px;"'; ?>>
            <!-- Each module gets its own line -->
            <div class="row row_plus">
                <div class="col-md-12"><b><?php echo $group->name_group; ?></b></div>
            </div>
            <?php foreach($modules[$group->id] as $module) { ?>
                <div class="row row_plus row_hover">
                    <div class="col-md-1"></div>
                    <div class="col-md-6"><i><?php echo $module->title; ?></i></div>
                    <div class="col-md-1">
                        <b><a href="<?php echo base_url('grade/get_median/'.$apprentice_formation->id.'/'.$module->id); ?>"
                        class="<?php echo get_grade_class($medians[$module->id]); ?>">
                            <?php echo $medians[$module->id]; ?>
                        </a></b>
                    </div>
                    <div class="col-md-3">
                        <!-- Each grade is added -->
                        <?php foreach($grades[$module->id] as $grade) { ?>
                            <a href="<?php echo base_url('grade/edit_grade/'.$grade->id); ?>"
                            class="<?php echo get_grade_class($grade->grade); ?>">
                                <?php echo $grade->grade; ?><!--
                            --></a>;
                        <?php } ?>
                    </div>
                    <!-- Add and remove buttons -->
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
            <?php }

            // Median of the group
            if(!empty($group_medians[$group->id])) { ?>
            <div class="row row_plus">
                <div class="col-md-1"></div>
                <div class="col-md-6"><b><?php echo $this->lang->line('grade_median'); ?></b></div>
                <div class="col-md-1">
                    <b class="<?php echo get_grade_class($group_medians[$group->id]); ?>">
                        <?php echo $group_medians[$group->id]; ?>
                    </b>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-1"></div>
            </div>
            <?php } ?>
        </div>
    <?php }

    // The medians' median
    if(!empty($final_median)) { ?>
    <div class="row row_plus" style="border-top:double gray">
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <b><?php echo $this->lang->line('grade_median_end'); ?></b>
        </div>
        <div class="col-md-1">
                <b class="<?php echo get_grade_class($final_median); ?>">
                    <?php echo $final_median; ?>
                </b>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-1"></div>
        <?php } ?>
    </div>
</div>
<br>

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
        border-bottom: solid #EAEAEA 1px;
        padding: 2px 0;
        margin: 0;
    }
    .row_hover:hover {
        background-color: #F0F0F0;
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

    /**
     * Displays or hides the selected div
     *
     * @param {String} divId - the div to toggle
     */
    function toggleDiv(divId) {
        let index = buttonDivs.indexOf(divId);
        if(index == -1) {
            console.log(false);
            return;
        }
        let docPart = document.getElementById(buttonDivs[index]),
            button = document.getElementById(buttons[index]),
            hidden = !docPart.hidden,
            newText = buttonTexts[index][hidden*1]; // Converts boolean to integer for the array
        button.innerHTML = newText;
        docPart.hidden = hidden;
    }
</script>
<?php
/**
 * Returns the correct class depending on the grade.
 *
 * @param integer $grade
 *      The grade
 * @return string
 *      The class with the correct colors
 */
function get_grade_class($grade) {
    if (empty($grade)) {
        return '';
    } else if ($grade < 4) {
        return 'grade_bad';
    } elseif ($grade >= 5) {
        return 'grade_good';
    } else {
        return 'grade_neutral';
    }
}
?>