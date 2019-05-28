<div class="container">
    <h1><?php echo $this->lang->line('grade_list'); ?></h1>
    <a class="btn btn-primary" href="<?=base_url('apprentice/apprentice_formations/'.$apprentice_formation->fk_apprentice)?>"><?=$this->lang->line('return')?></a>
    <?php
    foreach ($groups as $group) { ?>
        <a class="btn btn-secondary" href="#" onclick="toggleDiv('group_<?php echo $group->id; ?>_div')"
            id="group_<?php echo $group->id; ?>_btn">
            <?php echo $this->lang->line('grade_group_show').' '.$group->name_group; ?>
        </a>
    <?php } ?>
</div>
<br>
<div class="container" style="max-width: 90%;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('module_group'); ?></th>
                <th><?php echo $this->lang->line('grade_module'); ?></th>
                <th><?php echo $this->lang->line('grade_median'); ?></th>
                <th><?php echo $this->lang->line('grade_grades'); ?></th>
                <th></th>
            </tr>
        </thead>
        <?php foreach($groups as $group) {
            $first = TRUE; ?>
            <tbody id="group_<?php echo $group->id; ?>_div">
                <?php foreach($modules[$group->id] as $module) { ?>
                    <tr>
                        <th><?php if ($first) echo $group->name_group; ?></th>
                        <td><i><?php echo $module->title; ?></i></td>
                        <td>
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
                        </td>
                        <td>
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
                        </td>
                        <td>
                            <a href="<?php echo base_url('grade/add_to_module/'.$apprentice_formation->id.'/'.$module->id); ?>"
                            class="btn btn-success">+</a>
                            <?php if(!empty($medians[$module->id])) { ?>
                                <a href="<?php echo base_url('grade/remove_from_module/'.$apprentice_formation->id.'/'.$module->id); ?>" class="btn btn-danger">
                                    <span style="padding: 0 2px">-</span>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php $first = FALSE; } ?>
                <tr style="border-bottom:double rgb(182, 186, 190) 1px;">
                    <td></td>
                    <th><?php echo $this->lang->line('grade_median'); ?></th>
                    <td>
                        <?php if(!empty($group_medians[$group->id])) { ?>
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
                        <?php } ?>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        <?php } ?>
        <tfoot>
            <tr>
                <td></td>
                <th><?php echo $this->lang->line('grade_median_end'); ?></th>
                <td>
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
                </td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
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
    Boolean.prototype.toInt=()=>{return this.valueOf()?1:0};

    let buttonDivs = [
        <?php foreach($groups as $group) {
            echo '"group_'.$group->id.'_div",';
        } ?>],
        buttonTexts = [
        <?php foreach($groups as $group) {
            $text = '["'.$this->lang->line('grade_group_show').' '.$group->name_group.'",';
            $text .= '"'.$this->lang->line('grade_group_hide').' '.$group->name_group.'"],';
            echo $text;
        }; ?>],
        buttons = [
        <?php foreach($groups as $group) {
            echo '"group_'.$group->id.'_btn",';
        } ?>];
    function toggleDiv(divId) {
        let index = buttonDivs.indexOf(divId);
        if(index == -1) console.log(false);
        let docPart = document.getElementById(buttonDivs[index]),
            button = document.getElementById(buttons[index]),
            hidden = !docPart.hidden,
            newText = buttonTexts[index][(hidden).toInt()];
        docPart.hidden = hidden;
    }
</script>