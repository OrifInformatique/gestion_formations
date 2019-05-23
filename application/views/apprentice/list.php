<div class="container">
    <h1><?php echo $this->lang->line('apprentice_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('apprentice/form')?>"><?=$this->lang->line('apprentice_new')?></a>
    <div class="row">
        <div class="col-md-2"><b><?php echo $this->lang->line('apprentice_firstname'); ?></b></div>
        <div class="col-md-2"><b><?php echo $this->lang->line('apprentice_lastname'); ?></b></div>
        <div class="col-md-2"><b><?php echo $this->lang->line('apprentice_datebirth'); ?></b></div>
        <div class="col-md-2"><b><?php echo $this->lang->line('apprentice_teacher'); ?></b></div>
        <div class="col-md-2"><b><?php echo $this->lang->line('apprentice_formation'); ?></b></div>
        <div class="col-md-1"><b><?php echo $this->lang->line('apprentice_user'); ?></b></div>
        <div class="col-md-1"></div>
    </div>
    <?php if(isset($apprentices)) {
        foreach ($apprentices as $apprentice) { ?>
            <div class="row">
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->id; ?>"><?php echo $apprentice->firstname; ?></a></div>
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->id; ?>"><?php echo $apprentice->last_name; ?></a></div>
                <div class="col-md-2"><?php echo $apprentice->date_birth; ?></div>
                <div class="col-md-2"><?php echo $teachers[$apprentice->fk_teacher]; ?></div>
                <div class="col-md-2">
                    <a href="<?php echo base_url().'apprentice/apprentice_formations/'.$apprentice->id; ?>">
                        <?php echo get_apprentice_formation($apprentice->C_App_Form, $formations, $this->lang->line('none')); ?>
                    </a>
                </div>
                <div class="col-md-1"><?php echo $users[$apprentice->fk_user]; ?></div>
                <div class="col-md-1"><a href="<?php echo base_url().'apprentice/delete/'.$apprentice->id; ?>">[x]</a></div>
            </div>
    <?php } } ?>
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