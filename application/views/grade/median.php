<div class="container">
    <h1><?php echo $this->lang->line('grade_list'); ?></h1>
    <a name="cancel" class="btn btn-primary" href="<?=base_url('/grade/list/'.$apprentice_formation->id)?>"><?=$this->lang->line('return')?></a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th><?php echo $this->lang->line('grade_median'); ?></th>
                <th style="min-width: 200px;"><?php echo $this->lang->line('grade_grades'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 1; $i <= 8; $i++) { ?>
                <tr>
                    <td><b><?php echo $this->lang->line('grade_semester').' '.$i; ?></b></td>
                    <td>
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
                    </td>
                    <td>
                        <?php foreach($grades[$i] as $grade) { ?>
                            <a href="<?php echo base_url('grade/edit_grade/'.$grade->id); ?>"
                            class="<?php
                            if($grade->grade < 4)
                                echo 'grade_bad';
                            elseif($grade->grade >= 5)
                                echo 'grade_good';
                            else
                                echo 'grade_neutral';
                            ?>">
                                <?php echo $grade->grade;
                            ?></a>;
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td><b><?php echo $this->lang->line('grade_median_end'); ?></b></td>
                <td>
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
                </td>
                <td></td>
            </tr>
        </tbody>
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