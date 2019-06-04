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
            <?php for($i = 1; $i <= $semesters; $i++) { ?>
                <tr>
                    <td><b><?php echo $this->lang->line('grade_semester').' '.$i; ?></b></td>
                    <td>
                        <b class="<?php echo get_grade_class($medians[$i]); ?>">
                            <?php echo $medians[$i]; ?>
                        </b>
                    </td>
                    <td>
                        <?php foreach($grades[$i] as $grade) { ?>
                            <a href="<?php echo base_url('grade/edit_grade/'.$grade->id); ?>"
                            class="<?php echo get_grade_class($grade->grade); ?>">
                                <?php echo $grade->grade;
                            ?></a>;
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td><b><?php echo $this->lang->line('grade_median_end'); ?></b></td>
                <td>
                    <b class="<?php echo get_grade_class($medians[0]); ?>">
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