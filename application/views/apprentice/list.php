<div class="container">
    <h1><?php echo $this->lang->line('apprentice_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('apprentice/form')?>"><?=$this->lang->line('apprentice_new')?></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('apprentice_firstname'); ?></th>
                <th><?php echo $this->lang->line('apprentice_lastname'); ?></th>
                <th><?php echo $this->lang->line('apprentice_datebirth'); ?></th>
                <th><?php echo $this->lang->line('apprentice_teacher'); ?></th>
                <th><?php echo $this->lang->line('apprentice_formation'); ?></th>
                <th><?php echo $this->lang->line('apprentice_user'); ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($apprentices)) {
            foreach($apprentices as $apprentice) { ?>
                <tr>
                    <td><a href="<?php echo base_url().'apprentice/form/'.$apprentice->id; ?>"><?php echo $apprentice->firstname; ?></a></td>
                    <td><a href="<?php echo base_url().'apprentice/form/'.$apprentice->id; ?>"><?php echo $apprentice->last_name; ?></a></td>
                    <td><?php echo $apprentice->date_birth; ?></td>
                    <td><?php echo $teachers[$apprentice->fk_teacher]; ?></td>
                    <td>
                        <a href="<?php echo base_url().'apprentice/apprentice_formations/'.$apprentice->id; ?>">
                            <?php echo get_apprentice_formation($apprentice->C_App_Form, $formations, $this->lang->line('none')); ?>
                        </a>
                    </td>
                    <td><?php echo $users[$apprentice->fk_user]; ?></td>
                    <td><a href="<?php echo base_url().'apprentice/delete/'.$apprentice->id; ?>" class="btn btn-danger">x</a></td>
                </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>
<?php
function get_apprentice_formation($apprentice_app_for, $formations, $none = '') {
    foreach($apprentice_app_for as $app_for) {
        $f = $formations[$app_for->fk_formation];
        if($app_for->year + $f->duration >= date('Y')) {
            return $f->name_formation;
        }
    }
    return $none;
}
?>