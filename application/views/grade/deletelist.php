<div class="container">
    <h1><?php echo $this->lang->line('grade_list_delete'); ?></h1>
    <a name="cancel" class="btn btn-primary" href="<?=base_url('/grade/list/'.$apprentice_formation->id)?>"><?=$this->lang->line('return')?></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('grade_grade'); ?></th>
                <th><?php echo $this->lang->line('grade_semester'); ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($grades as $grade) { ?>
                <tr>
                    <td>
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
                    </td>
                    <td><?php echo $grade->semester; ?></td>
                    <td><a href="<?php echo base_url('grade/delete_grade/'.$grade->id); ?>">[x]</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<style type="text/css">
    .grade_bad, .grade_bad:hover {
        background-color: #ffc2c2;
        color: red;
        padding: 0 3px;
        margin: 0 -3px;
    }
    .grade_good, .grade_good:hover {
        color: #00c400;
    }
    .grade_neutral, .grade_neutral:hover {
        color: #007bff;
    }
</style>